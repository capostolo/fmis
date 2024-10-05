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
	$farmer = new \Fmis\Entities\FarmerEntity(); 
	$farmer->farmer_afm = $data->tin;
	$farmer->farmer_firstname = $data->applicant_detail->first_name;
	$farmer->farmer_lastname = $data->applicant_detail->last_name;
	$farmer->farmer_fathername = $data->applicant_detail->father_name;
	$farmer->farmer_mobile = $data->applicant_detail->mobile_phone_number;
	$farmer->farmer_email = $data->applicant_detail->email;
	$farmer->farmer_dtebirth = $data->applicant_detail->birth_date;
	$farmer->advisor_id = user_id();
	$farmerModel = new \Fmis\Models\FarmerModel();
	$farmerModel->save($farmer);
	$farmer_id = $farmerModel->getInsertID();
	
	//Create new parcel
	$parcel = new \Fmis\Entities\ParcelEntity(); 
	$parcel->farmer_id = $farmer_id;
	$parcel->iacs_year = 2024;
	foreach ($data->field_list as $p) {
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
		}
		$parcelModel = new \Fmis\Models\ParcelModel();
		$parcelModel->insert($parcel);
	}
	$oidc->signOut($idtoken, "https://schemis.agrenaos.gr/fmis/farmer");  
  }
}
