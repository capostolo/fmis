<?php namespace Fmis\Controllers;

class UnitMeasurementController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\UnitMeasurementModel();
  }
  
  public function index()
  {    
    if(session()->get('unit_measurement_where')){
      $data['rows'] = $this->model->modelList(['unit_measurement_where' => session()->get('unit_measurement_where')]);
    }
    else{
      $data['rows'] = $this->model->findAll();
    }
    return view('\Fmis\Views\Unitmeasurement\list', $data);
  }

  public function newItem()
  {    
    
    
    
    session()->remove('unit_measurement_id');
    return view('\Fmis\Views\Unitmeasurement\add', $data ?? array());
  }

  public function showItem($id)
  {    
    
    
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('unit_measurement_id', $id);
    }
    return view('\Fmis\Views\Unitmeasurement\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\UnitMeasurementEntity();
    $item->fill($postdata);
    if(session()->get('unit_measurement_id')){
      $item->id = session()->get('unit_measurement_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        
        
      }
      else {
        $item_id = $item->id;
        
        
        
      }
      
      return redirect()->to('unit-measurement/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Unitmeasurement\list');
  }
}
