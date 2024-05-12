<?php namespace Fmis\Controllers;

class IrrigationController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\IrrigationModel();
  }
  
  public function index()
  {    
    $data['rows'] = $this->model->modelList(['farmer_id' => session()->get('farmer_id')]);
    return view('\Fmis\Views\Irrigation\list', $data);
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
    return view('\Fmis\Views\Irrigation\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		$IrrigationEquipment = new \Fmis\Models\IrrigationEquipmentModel(); 
		
    $data['unit_measurement'] = $UnitMeasurement->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['irrigation_equipment'] = $IrrigationEquipment->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
		$data['crops'] = $this->model->parcelList(session()->get('farmer_id'), $id);
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('irrigation_id', $id);
    }
    return view('\Fmis\Views\Irrigation\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $fi_selected = $postdata['fi_selected']; 
		unset($postdata['fi_selected']);
    $item = new \Fmis\Entities\IrrigationEntity();
    $item->fill($postdata);
    $item->farmer_id = session()->get('farmer_id');
    if(session()->get('irrigation_id')){
      $item->id = session()->get('irrigation_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        $parcel = new \Fmis\Models\IrrigationParcelModel();
        foreach($fi_selected As $key => $val){ 
         $parcel->insert(array('irrigation_id' => $item_id, 'parcel_id' => $val)); 
       }
      }
      else {
        $item_id = $item->id;
        $parcel = new \Fmis\Models\IrrigationParcelModel();
        $parcel->where('irrigation_id', $item_id)->delete();
        foreach($fi_selected As $key => $val){ 
         $parcel->insert(array('irrigation_id' => $item_id, 'parcel_id' => $val)); 
        }
      }
      return redirect()->to('fmis/farmer/'.session()->get('farmer_id'))->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Irrigation\list');
  }
}
