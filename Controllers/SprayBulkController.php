<?php namespace Fmis\Controllers;

class SprayBulkController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session', 'date']);
  }
  
  public function newItem()
  {    
    $ProtectiveProduct = new \Fmis\Models\ProtectiveProductModel(); 
	$UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
	$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
	$SprayEquipment = new \Fmis\Models\SprayEquipmentModel(); 
		
    $data['protective_product'] = $ProtectiveProduct->findAll(); 
	$data['unit_measurement'] = $UnitMeasurement->where("practice = 'protection'")->findAll(); 
	$data['farming_stage'] = $FarmingStage->findAll(); 
	$data['spray_equipment'] = $SprayEquipment->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
	$data['crops'] = $crops->getShortList(['farmer_id' => session()->get('farmer_id')]);
    session()->remove('spray_id');
    return view('\Fmis\Views\Sprayparcel\add_bulk', $data ?? array());
  }
  
  public function showItem($id)
  {    
    $Spray = new \Fmis\Models\SprayModel();
    $ProtectiveProduct = new \Fmis\Models\ProtectiveProductModel(); 
	$UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
	$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
	$SprayEquipment = new \Fmis\Models\SprayEquipmentModel(); 
		
    $data['protective_product'] = $ProtectiveProduct->findAll(); 
	$data['unit_measurement'] = $UnitMeasurement->where("practice = 'protection'")->findAll(); 
	$data['farming_stage'] = $FarmingStage->findAll(); 
	$data['spray_equipment'] = $SprayEquipment->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
	$data['crops'] = $Spray->parcelList(session()->get('farmer_id'), $id);
    $data['row'] = $Spray->find($id);
    if($data['row']){
      session()->set('spray_id', $id);
	  $data['parcel_quantity'] = false;
	  $protective_product = $ProtectiveProduct->find($data['row']->protective_product_id);
	  if($protective_product->ecoscheme_id == ''){
		  $data['parcel_quantity'] = true;
	  }
    }
	$data['disabled'] = 'disabled';
    return view('\Fmis\Views\SprayParcel\update_bulk_dir', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();

    $Spray = new \Fmis\Models\SprayModel();
	$dirData = $Spray->find(session()->get('spray_id'))->toArray();
	unset($dirData['id']);

    $SprayParcel = new \Fmis\Models\SprayParcelModel();
	$parcelData = $SprayParcel->where('spray_id = '.session()->get('spray_id').' AND spray_date IS NULL')->findAll();

	foreach($parcelData As $p){
		$p->fill($dirData);
		$p->spray_date = randomDate($postdata['start_date'], $postdata['end_date']);
		if(!$SprayParcel->save($p)){
			return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο ".$p->parcel_id);
		}
	}
	return redirect()->to('fmis/farmer/pending')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
   }

	public function saveBulk()
	{   
		$SprayParcel = new \Fmis\Models\SprayParcelModel();
		$Parcel = new \Fmis\Models\ParcelModel(); 
		$postdata = $this->request->getPost();
		$fi_selected = $postdata['fi_selected']; 
		unset($postdata['fi_selected']);
		$item = new \Fmis\Entities\SprayParcelEntity();
		$item->fill($postdata);
		foreach($fi_selected As $key => $val){
			$item->parcel_id = $val;
			$item->spray_date = randomDate($postdata['start_date'], $postdata['end_date']);
			$parcel_data = $Parcel->find($item->parcel_id);
			if(!$SprayParcel->save($item)){
				return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο ".$parcel_data->code);
			}
		}		
		return redirect()->to('fmis/farmer/pending')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
	}

}
