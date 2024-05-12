<?php namespace Fmis\Controllers;

class PruningController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\PruningModel();
  }
  
  public function index()
  {    
    $data['rows'] = $this->model->modelList(['farmer_id' => session()->get('farmer_id')]);
    return view('\Fmis\Views\Pruning\list', $data);
  }

  public function newItem()
  {    
    $PruningType = new \Fmis\Models\PruningTypeModel(); 
		$PruningEquipment = new \Fmis\Models\PruningEquipmentModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		
    $data['pruning_type'] = $PruningType->findAll(); 
		$data['pruning_equipment'] = $PruningEquipment->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
		$data['crops'] = $crops->getShortList(['farmer_id' => session()->get('farmer_id')]);
    session()->remove('pruning_id');
    return view('\Fmis\Views\Pruning\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $PruningType = new \Fmis\Models\PruningTypeModel(); 
		$PruningEquipment = new \Fmis\Models\PruningEquipmentModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		
    $data['pruning_type'] = $PruningType->findAll(); 
		$data['pruning_equipment'] = $PruningEquipment->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
		$data['crops'] = $this->model->parcelList(session()->get('farmer_id'), $id);
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('pruning_id', $id);
    }
    return view('\Fmis\Views\Pruning\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $fi_selected = $postdata['fi_selected']; 
		unset($postdata['fi_selected']);
    $item = new \Fmis\Entities\PruningEntity();
    $item->fill($postdata);
    $item->farmer_id = session()->get('farmer_id');
    if(session()->get('pruning_id')){
      $item->id = session()->get('pruning_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        $parcel = new \Fmis\Models\PruningParcelModel();
        foreach($fi_selected As $key => $val){ 
         $parcel->insert(array('pruning_id' => $item_id, 'parcel_id' => $val)); 
        }
      }
      else {
        $item_id = $item->id;
        $parcel = new \Fmis\Models\PruningParcelModel();
        $parcel->where('pruning_id', $item_id)->delete();
        foreach($fi_selected As $key => $val){ 
         $parcel->insert(array('pruning_id' => $item_id, 'parcel_id' => $val)); 
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
     return view('\Fmis\Views\Pruning\list');
  }
}
