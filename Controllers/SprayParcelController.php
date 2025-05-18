<?php namespace Fmis\Controllers;

class SprayParcelController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\SprayParcelModel();
  }
  
  public function index()
  {    
    if(session()->get('parcel_id')){
      $data['rows'] = $this->model->modelList(['parcel_id' => session()->get('parcel_id')]);
      return view('\Fmis\Views\Sprayparcel\list', $data);
    }
    return redirect()->back()->withInput()->with('error', "Παρακαλώ επιλέξτε αγροτεμάχιο!");
  }

  public function newItem()
  {    
    $ProtectiveProduct = new \Fmis\Models\ProtectiveProductModel(); 
		$UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		$SprayEquipment = new \Fmis\Models\SprayEquipmentModel(); 
    $data['protective_product'] = $ProtectiveProduct->getPpList(); 
		$data['unit_measurement'] = $UnitMeasurement->where("practice = 'protection'")->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['spray_equipment'] = $SprayEquipment->modelList(); 
    session()->remove('spray_parcel_id');
    return view('\Fmis\Views\Sprayparcel\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $ProtectiveProduct = new \Fmis\Models\ProtectiveProductModel(); 
		$UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		$SprayEquipment = new \Fmis\Models\SprayEquipmentModel(); 
    $Spray = new \Fmis\Models\SprayModel();
    $data['protective_product'] = $ProtectiveProduct->getPpList(); 
		$data['unit_measurement'] = $UnitMeasurement->where("practice = 'protection'")->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['spray_equipment'] = $SprayEquipment->modelList(); 
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('spray_parcel_id', $id);
      $dirData = $Spray->find($data['row']->spray_id);
      if($dirData){
        $data['directive'] = $dirData;
		if (!$data['row']->spray_date){
        	session()->set('message', 'Προσοχή! Τα στοιχεία έχουν προσυμπληρωθεί με βάση την υφιστάμενη συμβουλή φυτοπροστασίας.');
		}
      }
    }
    return view('\Fmis\Views\Sprayparcel\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $item = new \Fmis\Entities\SprayParcelEntity();
    $item->fill($postdata);
    $item->parcel_id = session()->get('parcel_id');
    if(session()->get('spray_parcel_id')){
      $item->id = session()->get('spray_parcel_id');
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
    $item_id = $this->request->getPost('item_id');
    $item_data = $this->model->find($item_id);
    
    if(!$item_data->spray_id){
        $this->model->delete($item_id);
    }
    else {
        $item = new \Fmis\Entities\SprayParcelEntity();
        $item->id = $item_id;
        $item->spray_date = null;
        $item->protective_product_id = null;
        $item->dose = null;
        $item->unit_measurement_id = null;
        $item->parcel_quantity = null;
        $item->target = null;
        $item->conditions = null;
        $item->days_before_harvest = null;
        $item->farming_stage_id = null;
        $item->spray_equipment_id = null;
        $this->model->save($item);
    }

    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'Η διαγραφή ολοκληρώθηκε με επιτυχία'
    ]);
  }
}
