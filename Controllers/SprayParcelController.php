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
    $data['protective_product'] = $ProtectiveProduct->findAll(); 
		$data['unit_measurement'] = $UnitMeasurement->where("practice = 'protection'")->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['spray_equipment'] = $SprayEquipment->findAll(); 
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
    $data['protective_product'] = $ProtectiveProduct->findAll(); 
		$data['unit_measurement'] = $UnitMeasurement->where("practice = 'protection'")->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['spray_equipment'] = $SprayEquipment->findAll(); 
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('spray_parcel_id', $id);
      $dirData = $Spray->find($data['row']->spray_id);
      if($dirData && !$data['row']->spray_date){
        $data['directive'] = $dirData;
        session()->set('message', 'Προσοχή! Τα στοιχεία έχουν προσυμπληρωθεί με βάση την υφιστάμενη συμβουλή φυτοπροστασίας.');
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
     return view('\Fmis\Views\Sprayparcel\list');
  }
}
