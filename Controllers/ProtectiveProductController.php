<?php namespace Fmis\Controllers;

class ProtectiveProductController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\ProtectiveProductModel();
  }
  
  public function index()
  {    
    $data['rows'] = $this->model->findAll();
    return view('\Fmis\Views\Protectiveproduct\list', $data);
  }

  public function newItem()
  {    
    session()->remove('protective_product_id');
    $activeModel = new \Fmis\Models\ActiveSubstanceModel();
    $data['activesubstance'] = $activeModel->findAll();
    return view('\Fmis\Views\Protectiveproduct\add', $data ?? array());
  }

  public function showItem($id)
  {    
    
    
    $activeModel = new \Fmis\Models\ProductActiveModel();
    $data['activesubstance'] = $activeModel->modelList(['product_id' => $id]);
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('protective_product_id', $id);
    }
    return view('\Fmis\Views\Protectiveproduct\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\ProtectiveProductEntity();
    $item->fill($postdata);
    if(session()->get('protective_product_id')){
      $item->id = session()->get('protective_product_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        
        
      }
      else {
        $item_id = $item->id;
        
        
        
      }
      
      return redirect()->to('fmis/protective-product/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Protectiveproduct\list');
  }
  
  public function deleteActive()
  {    
    $postdata = $this->request->getPost();
    $activeModel = new \Fmis\Models\ProductActiveModel();
    if ($activeModel->delete($this->request->getPost('id'))){
      echo 1;
    }
    else {
      echo 0;
    }
  }
  
}
