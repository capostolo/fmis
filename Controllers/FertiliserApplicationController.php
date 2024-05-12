<?php namespace Fmis\Controllers;

class FertiliserApplicationController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\FertiliserApplicationModel();
  }
  
  public function index()
  {    
    if(session()->get('fertiliser_application_where')){
      $data['rows'] = $this->model->modelList(['fertiliser_application_where' => session()->get('fertiliser_application_where')]);
    }
    else{
      $data['rows'] = $this->model->findAll();
    }
    return view('\Fmis\Views\Fertiliserapplication\list', $data);
  }

  public function newItem()
  {    
    
    
    
    session()->remove('fertiliser_application_id');
    return view('\Fmis\Views\Fertiliserapplication\add', $data ?? array());
  }

  public function showItem($id)
  {    
    
    
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('fertiliser_application_id', $id);
    }
    return view('\Fmis\Views\Fertiliserapplication\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\FertiliserApplicationEntity();
    $item->fill($postdata);
    if(session()->get('fertiliser_application_id')){
      $item->id = session()->get('fertiliser_application_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        
        
      }
      else {
        $item_id = $item->id;
        
        
        
      }
      
      return redirect()->to('fertiliser-application/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Fertiliserapplication\list');
  }
}
