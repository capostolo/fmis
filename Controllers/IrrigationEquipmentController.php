<?php namespace Fmis\Controllers;

class IrrigationEquipmentController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\IrrigationEquipmentModel();
  }
  
  public function index()
  {    
    if(session()->get('irrigation_equipment_where')){
      $data['rows'] = $this->model->modelList(['irrigation_equipment_where' => session()->get('irrigation_equipment_where')]);
    }
    else{
      $data['rows'] = $this->model->findAll();
    }
    return view('\Fmis\Views\Irrigationequipment\list', $data);
  }

  public function newItem()
  {    
    
    
    
    session()->remove('irrigation_equipment_id');
    return view('\Fmis\Views\Irrigationequipment\add', $data ?? array());
  }

  public function showItem($id)
  {    
    
    
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('irrigation_equipment_id', $id);
    }
    return view('\Fmis\Views\Irrigationequipment\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\IrrigationEquipmentEntity();
    $item->fill($postdata);
    if(session()->get('irrigation_equipment_id')){
      $item->id = session()->get('irrigation_equipment_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        
        
      }
      else {
        $item_id = $item->id;
        
        
        
      }
      
      return redirect()->to('irrigation-equipment/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Irrigationequipment\list');
  }
}
