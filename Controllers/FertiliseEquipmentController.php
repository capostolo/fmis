<?php namespace Fmis\Controllers;

class FertiliseEquipmentController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\FertiliseEquipmentModel();
  }
  
  public function index()
  {    
    if(session()->get('fertilise_equipment_where')){
      $data['rows'] = $this->model->modelList(['fertilise_equipment_where' => session()->get('fertilise_equipment_where')]);
    }
    else{
      $data['rows'] = $this->model->findAll();
    }
    return view('\Fmis\Views\Fertiliseequipment\list', $data);
  }

  public function newItem()
  {    
    
    
    
    session()->remove('fertilise_equipment_id');
    return view('\Fmis\Views\Fertiliseequipment\add', $data ?? array());
  }

  public function showItem($id)
  {    
    
    
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('fertilise_equipment_id', $id);
    }
    return view('\Fmis\Views\Fertiliseequipment\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\FertiliseEquipmentEntity();
    $item->fill($postdata);
    if(session()->get('fertilise_equipment_id')){
      $item->id = session()->get('fertilise_equipment_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        
        
      }
      else {
        $item_id = $item->id;
        
        
        
      }
      
      return redirect()->to('fertilise-equipment/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Fertiliseequipment\list');
  }
}
