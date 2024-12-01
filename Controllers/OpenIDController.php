<?php namespace Fmis\Controllers;

use Jumbojett\OpenIDConnectClient;


class OpenIDController extends BaseController
{
  public function __construct()
  {
    helper(['form', 'url', 'session']);
  }
  
  public function index()
  {
	$issuer = 'https://accounts.opekepe.gr/realms/eco-schemes';
	$provider = 'https://accounts.opekepe.gr/realms/eco-schemes';
	$cid = 'schemis';
	$secret = '04C6n2ZtfuoL82cFG9Ql5IF55olSV98x';
	$oidc = new \Jumbojett\OpenIDConnectClient($cid, $secret, $issuer, $provider);
	//$oidc->setVerifyHost(false);
	//$oidc->setVerifyPeer(false);
	$oidc->setCertPath('/var/www/vhosts/quercus.com.gr/_ci_core/fmis_app/app/Modules/Fmis/Certificates/opekepe_bundle.cer');

	$oidc->authenticate();
	$oidc->requestUserInfo();
	$token = $oidc->getAccessToken();
	$idtoken = $oidc->getIdToken();
	$afm = $oidc->getVerifiedClaims('tin');
	  
	$options = [
		'baseURI' => 'https://eae.opekepe.gr/api/v1/',
		'headers' => [
			'Authorization' => 'Bearer '. $token,
		],
		'query' => [
			'tin' => $afm, 
			'year' => '2024', 
			'initial' => 'false'
		],		
	];
	$client = service('curlrequest', $options);
	$response = $client->get('applications');
	$data = json_decode($response->getBody());
	//Create new farmer
	$farmerModel = new \Fmis\Models\FarmerModel();
	$existing_farmer = $farmerModel->where(['farmer_afm' => $data->tin, 'advisor_id' => user_id()])->first();
	$farmer = new \Fmis\Entities\FarmerEntity(); 
	$farmer_id = 0;
	if ($existing_farmer){
		$farmer->id = $existing_farmer->id;
		$farmer_id = $existing_farmer->id;
	}
	$farmer->farmer_afm = $data->tin;
	$farmer->farmer_firstname = $data->applicant_detail->first_name;
	$farmer->farmer_lastname = $data->applicant_detail->last_name;
	$farmer->farmer_fathername = $data->applicant_detail->father_name;
	$farmer->farmer_mobile = $data->applicant_detail->mobile_phone_number;
	$farmer->farmer_email = $data->applicant_detail->email;
	$farmer->farmer_dtebirth = $data->applicant_detail->birth_date;
	$farmer->advisor_id = user_id();
	$farmerModel->save($farmer);
	if($farmer_id == 0){	
		$farmer_id = $farmerModel->getInsertID();
	}
	
	//Create new parcel
	$parcelModel = new \Fmis\Models\ParcelModel();
	$parcelSchemeModel = new \Fmis\Models\ParcelSchemeModel();
	$parcel = new \Fmis\Entities\ParcelEntity(); 
	$parcel_scheme = new \Fmis\Entities\ParcelEntity(); 
	$existing_parcel = $parcelModel->where(['farmer_id' => $farmer_id, 'iacs_year' => 2024])->first();
	if($existing_parcel){
		session()->setFlashdata("error", "Η διαδικασία εισαγωγής δεδομένων ματαιώθηκε. Υπάρχουν ήδη δεδομένα για τον παραγωγό με τον ΑΦΜ ".$data->tin." και το έτος 2024.");
		$oidc->signOut($idtoken, "https://schemis.agrenaos.gr/fmis/farmer");
	}
	else{
		$parcel->farmer_id = $farmer_id;
		$parcel->iacs_year = 2024;
		foreach ($data->field_list as $p) {
			$parcel->aa = $p->code;
			$parcel->code = $p->field_geospatial_data->cartographic_background;
			$parcel->location = $p->field_info->location;
			$parcel->geomwkt = $p->field_geospatial_data->geom;
			$parcel->community_code = $p->field_geospatial_data->community_code;
			$parcel->co_ownership_percent = $p->field_info->co_ownership_percent;	
			foreach($p->field_cultivation_list as $c){
				$parcel->total_area = $c->total_area;
				$parcel->cultivation_code = $c->cultivation_code;
				$parcel->cultivar_code = $c->cultivar_code;
				$parcel->is_irrigated = $c->is_irrigated;
				$parcel->irrigation_method_code = $c->irrigation_method_code;
				$parcel->trees_number_ge4_years = $c->trees_number_ge4_years;
				$parcel->trees_number_l4_years = $c->trees_number_l4_years;
				$parcel->is_cultivation_ge3_years = $c->is_cultivation_ge3_years;
				$parcelModel->insert($parcel);
				$parcel_id = $parcelModel->getInsertID();
				foreach ($p->field_ecoscheme_subsidy_list as $e) {
					$parcel_scheme->parcel_id = $parcel_id;
					$parcel_scheme->ecoscheme_subsidy_code = $e->ecoscheme_subsidy_code;
					$parcelSchemeModel->insert($parcel_scheme);
				}
			}
		}
		session()->setFlashdata("message", "Τα δεδομένα του παραγωγού με τον ΑΦΜ ".$data->tin." και το έτος 2024 καταχωρίστηκαν!");
		$oidc->signOut($idtoken, "https://schemis.agrenaos.gr/fmis/farmer");  
	}
  }
}
