<?php namespace Fmis\Controllers;

class IrrigationParcelController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\IrrigationParcelModel();
  }
  
  public function index()
  {    
    if(session()->get('parcel_id')){
      $data['rows'] = $this->model->modelList(['parcel_id' => session()->get('parcel_id')]);
      return view('\Fmis\Views\Irrigationparcel\list', $data);
    }
    return redirect()->back()->withInput()->with('error', "Παρακαλώ επιλέξτε αγροτεμάχιο!");
  }

  public function newItem()
  {    
    $UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		$IrrigationEquipment = new \Fmis\Models\IrrigationEquipmentModel(); 
    $data['unit_measurement'] = $UnitMeasurement->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['irrigation_equipment'] = $IrrigationEquipment->findAll(); 
    session()->remove('irrigation_parcel_id');
    return view('\Fmis\Views\Irrigationparcel\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		$IrrigationEquipment = new \Fmis\Models\IrrigationEquipmentModel(); 
    $Irrigation = new \Fmis\Models\IrrigationModel();
    $data['unit_measurement'] = $UnitMeasurement->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['irrigation_equipment'] = $IrrigationEquipment->findAll(); 
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('irrigation_parcel_id', $id);
      $dirData = $Irrigation->find($data['row']->irrigation_id);
      if($dirData){
        $data['directive'] = $dirData;
		if (!$data['row']->irrigation_date){  
        	session()->set('message', 'Προσοχή! Τα στοιχεία έχουν προσυμπληρωθεί με βάση την υφιστάμενη συμβουλή άρδευσης.');
		}
      }
    }
    return view('\Fmis\Views\Irrigationparcel\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $item = new \Fmis\Entities\IrrigationParcelEntity();
    $item->fill($postdata);
    $item->parcel_id = session()->get('parcel_id');
    if(session()->get('irrigation_parcel_id')){
      $item->id = session()->get('irrigation_parcel_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
      }
      else {
        $item_id = $item->id;
      }
      return redirect()->to('fmis/parcel/'.session()->get('parcel_id'))->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Irrigationparcel\list');
  }
}
