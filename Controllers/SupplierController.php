<?php namespace Fmis\Controllers;

class SupplierController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\SupplierModel();
  }
  
  public function index()
  {    
    if(session()->get('supplier_where')){
      $data['rows'] = $this->model->modelList(['supplier_where' => session()->get('supplier_where')]);
    }
    else{
      $data['rows'] = $this->model->findAll();
    }
    return view('\Fmis\Views\Supplier\list', $data);
  }

  public function newItem()
  {    
    
    
    
    session()->remove('supplier_id');
    return view('\Fmis\Views\Supplier\add', $data ?? array());
  }

  public function showItem($id)
  {    
    
    
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('supplier_id', $id);
    }
    return view('\Fmis\Views\Supplier\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\SupplierEntity();
    $item->fill($postdata);
    if(session()->get('supplier_id')){
      $item->id = session()->get('supplier_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        
        
      }
      else {
        $item_id = $item->id;
        
        
        
      }
      
      return redirect()->to('fmis/supplier/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Supplier\list');
  }
}
