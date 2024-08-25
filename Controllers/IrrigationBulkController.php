<?php namespace Fmis\Controllers;

class IrrigationBulkController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session', 'date']);
  }
 
  public function newItem()
  {    
    $UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
	$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
	$IrrigationEquipment = new \Fmis\Models\IrrigationEquipmentModel(); 
		
    $data['unit_measurement'] = $UnitMeasurement->findAll(); 
	$data['farming_stage'] = $FarmingStage->findAll(); 
	$data['irrigation_equipment'] = $IrrigationEquipment->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
	$data['crops'] = $crops->getShortList(['farmer_id' => session()->get('farmer_id')]);
    session()->remove('irrigation_id');
    return view('\Fmis\Views\IrrigationParcel\add_bulk', $data ?? array());
  } 

  public function showItem($id)
  {    
    $Irrigation = new \Fmis\Models\IrrigationModel();
    $UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
	$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
	$IrrigationEquipment = new \Fmis\Models\IrrigationEquipmentModel(); 
		
    $data['unit_measurement'] = $UnitMeasurement->findAll(); 
	$data['farming_stage'] = $FarmingStage->findAll(); 
	$data['irrigation_equipment'] = $IrrigationEquipment->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
	$data['crops'] = $Irrigation->parcelList(session()->get('farmer_id'), $id);
    $data['row'] = $Irrigation->find($id);
    if($data['row']){
      session()->set('irrigation_id', $id);
    }
	$data['disabled'] = 'disabled';
    return view('\Fmis\Views\IrrigationParcel\update_bulk_dir', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();

    $Irrigation = new \Fmis\Models\IrrigationModel();
	$dirData = $Irrigation->find(session()->get('irrigation_id'))->toArray();
	unset($dirData['id']);

    $IrrigationParcel = new \Fmis\Models\IrrigationParcelModel();
	$parcelData = $IrrigationParcel->where('irrigation_id = '.session()->get('irrigation_id').' AND irrigation_date IS NULL')->findAll();

	foreach($parcelData As $p){
		$p->fill($dirData);
		$p->irrigation_date = randomDate($postdata['start_date'], $postdata['end_date']);
		if(!$IrrigationParcel->save($p)){
			return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο ".$p->parcel_id);
		}
	}
	return redirect()->to('fmis/farmer/pending')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
   }

	public function saveBulk()
	{   
		$IrrigationParcel = new \Fmis\Models\IrrigationParcelModel();
		$Parcel = new \Fmis\Models\ParcelModel(); 
		$postdata = $this->request->getPost();
		$fi_selected = $postdata['fi_selected']; 
		unset($postdata['fi_selected']);
		$item = new \Fmis\Entities\IrrigationParcelEntity();
		$item->fill($postdata);
		foreach($fi_selected As $key => $val){
			$item->parcel_id = $val;
			$item->irrigation_date = randomDate($postdata['start_date'], $postdata['end_date']);
			$parcel_data = $Parcel->find($item->parcel_id);
			if(!$IrrigationParcel->save($item)){
				return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο ".$parcel_data->code);
			}
		}		
		return redirect()->to('fmis/farmer/pending')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
	}

}
