<?php namespace Fmis\Controllers;

class PruningParcelController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\PruningParcelModel();
  }
  
  public function index()
  {    
    if(session()->get('parcel_id')){
      $data['rows'] = $this->model->modelList(['parcel_id' => session()->get('parcel_id')]);
      return view('\Fmis\Views\Pruningparcel\list', $data);
    }
    return redirect()->back()->withInput()->with('error', "Παρακαλώ επιλέξτε αγροτεμάχιο!");
  }

  public function newItem()
  {    
    $PruningType = new \Fmis\Models\PruningTypeModel(); 
		$PruningEquipment = new \Fmis\Models\PruningEquipmentModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
    $data['pruning_type'] = $PruningType->findAll(); 
		$data['pruning_equipment'] = $PruningEquipment->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
    session()->remove('pruning_parcel_id');
    return view('\Fmis\Views\Pruningparcel\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $PruningType = new \Fmis\Models\PruningTypeModel(); 
		$PruningEquipment = new \Fmis\Models\PruningEquipmentModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
    $Pruning = new \Fmis\Models\PruningModel();
    $data['pruning_type'] = $PruningType->findAll(); 
		$data['pruning_equipment'] = $PruningEquipment->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('pruning_parcel_id', $id);
      $dirData = $Pruning->find($data['row']->pruning_id);
      if($dirData){
        $data['directive'] = $dirData;
		if (!$data['row']->pruning_date){
        	session()->set('message', 'Προσοχή! Τα στοιχεία έχουν προσυμπληρωθεί με βάση την υφιστάμενη συμβουλή κλαδέματος.');
		}
      }
    }
    return view('\Fmis\Views\Pruningparcel\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $item = new \Fmis\Entities\PruningParcelEntity();
    $item->fill($postdata);
    $item->parcel_id = session()->get('parcel_id');
    if(session()->get('pruning_parcel_id')){
      $item->id = session()->get('pruning_parcel_id');
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
    
    if(!$item_data->pruning_id){
        $this->model->delete($item_id);
    }
    else {
        $item = new \Fmis\Entities\PruningParcelEntity();
        $item->id = $item_id;
        $item->pruning_date = null;
        $item->pruning_type_id = null;
        $item->pruning_equipment_id = null;
        $item->farming_stage_id = null;
        $this->model->save($item);
    }
    
    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'Η διαγραφή ολοκληρώθηκε με επιτυχία'
    ]);
  }
}
