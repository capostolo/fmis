<?php namespace Fmis\Controllers;

class PoController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\PoModel();
  }
  
  public function index()
  {    
    if(session()->get('po_where')){
      $data['rows'] = $this->model->modelList(['po_where' => session()->get('po_where')]);
    }
    else{
      $data['rows'] = $this->model->findAll();
    }
    return view('\Fmis\Views\Po\list', $data);
  }

  public function newItem()
  {    
    
    
    
    session()->remove('po_id');
    return view('\Fmis\Views\Po\add', $data ?? array());
  }

  public function showItem($id)
  {    
    
    
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('po_id', $id);
    }
    return view('\Fmis\Views\Po\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\PoEntity();
    $item->fill($postdata);
    if(session()->get('po_id')){
      $item->id = session()->get('po_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        
        
      }
      else {
        $item_id = $item->id;
        
        
        
      }
      
      return redirect()->to('fmis/po/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Po\list');
  }
}
