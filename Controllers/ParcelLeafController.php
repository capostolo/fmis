<?php namespace Fmis\Controllers;

class ParcelLeafController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\ParcelLeafModel();
  }
  
  public function index()
  {    
    if(session()->get('parcel_leaf_where')){
      $data['rows'] = $this->model->modelList(['parcel_leaf_where' => session()->get('parcel_leaf_where')]);
    }
    else{
      $data['rows'] = $this->model->findAll();
    }
    return view('\Fmis\Views\Parcelleaf\list', $data);
  }

  public function newItem()
  {    
    
    
    
    session()->remove('parcel_leaf_id');
    return view('\Fmis\Views\Parcelleaf\add', $data ?? array());
  }

  public function showItem($id)
  {    
    
    
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('parcel_leaf_id', $id);
    }
    return view('\Fmis\Views\Parcelleaf\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\ParcelLeafEntity();
    $item->fill($postdata);
    $item->parcel_id = session()->get('parcel_id');
    if(session()->get('parcel_leaf_id')){
      $item->id = session()->get('parcel_leaf_id');
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
     return view('\Fmis\Views\Parcelleaf\list');
  }
}
