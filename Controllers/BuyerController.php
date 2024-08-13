<?php namespace Fmis\Controllers;

class BuyerController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\BuyerModel();
  }
  
  public function index()
  {    
    if(session()->get('buyer_where')){
      $data['rows'] = $this->model->modelList(['buyer_where' => session()->get('buyer_where')]);
    }
    else{
      $data['rows'] = $this->model->findAll();
    }
    return view('\Fmis\Views\Buyer\list', $data);
  }

  public function newItem()
  {    
    
    
    
    session()->remove('buyer_id');
    return view('\Fmis\Views\Buyer\add', $data ?? array());
  }

  public function showItem($id)
  {    
    
    
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('buyer_id', $id);
    }
    return view('\Fmis\Views\Buyer\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\BuyerEntity();
    $item->fill($postdata);
    if(session()->get('buyer_id')){
      $item->id = session()->get('buyer_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        
        
      }
      else {
        $item_id = $item->id;
        
        
        
      }
      
      return redirect()->to('fmis/buyer/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Buyer\list');
  }
}
