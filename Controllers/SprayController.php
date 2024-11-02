<?php namespace Fmis\Controllers;

class SprayController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\SprayModel();
  }
  
  public function index()
  {    
    $data['rows'] = $this->model->modelList(['farmer_id' => session()->get('farmer_id')]);
    return view('\Fmis\Views\Spray\list', $data);
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
    return view('\Fmis\Views\Spray\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $ProtectiveProduct = new \Fmis\Models\ProtectiveProductModel(); 
		$UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		$SprayEquipment = new \Fmis\Models\SprayEquipmentModel(); 
		
    $data['protective_product'] = $ProtectiveProduct->findAll(); 
		$data['unit_measurement'] = $UnitMeasurement->where("practice = 'protection'")->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['spray_equipment'] = $SprayEquipment->findAll(); 
	$data['disabled'] = '';	
		
    $crops = new \Fmis\Models\ParcelModel(); 
		$data['crops'] = $this->model->parcelList(session()->get('farmer_id'), $id);
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('spray_id', $id);
    }
    return view('\Fmis\Views\Spray\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $fi_selected = $postdata['fi_selected']; 
		unset($postdata['fi_selected']);
    $item = new \Fmis\Entities\SprayEntity();
    $item->fill($postdata);
    $item->farmer_id = session()->get('farmer_id');
    if(session()->get('spray_id')){
      $item->id = session()->get('spray_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        $parcel = new \Fmis\Models\SprayParcelModel();
        foreach($fi_selected As $key => $val){ 
          $parcel->insert(array('spray_id' => $item_id, 'parcel_id' => $val)); 
        }
      }
      else {
        $item_id = $item->id;
        $parcel = new \Fmis\Models\SprayParcelModel();
        $parcel->where('spray_id', $item_id)->delete();
        foreach($fi_selected As $key => $val){ 
          $parcel->insert(array('spray_id' => $item_id, 'parcel_id' => $val)); 
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
     return view('\Fmis\Views\Spray\list');
  }
}
