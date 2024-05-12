<?php namespace Fmis\Controllers;

class ProductActiveController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\ProductActiveModel();
  }
  
  public function newItem()
  {    
    session()->remove('product_active_id');
    $activeModel = new \Fmis\Models\ActiveSubstanceModel();
    $data['activesubstance'] = $activeModel->findAll();
    return view('\Fmis\Views\Productactive\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $activeModel = new \Fmis\Models\ActiveSubstanceModel();
    $data['activesubstance'] = $activeModel->findAll();
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('product_active_id', $id);
    }
    return view('\Fmis\Views\Productactive\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\ProtectiveProductEntity();
    $item->fill($postdata);
    if(session()->get('product_active_id')){
      $item->id = session()->get('product_active_id');
    }
    $item->protective_product_id = session()->get('protective_product_id');
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
      }
      else {
        $item_id = $item->id;
      }
      
      return redirect()->to('fmis/protective-product/'.session()->get('protective_product_id'))->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }
  
  public function deleteItem()
  {    
    $postdata = $this->request->getPost();
    if ($this-model->delete($this->request->getPost('id'))){
      echo 1;
    }
    else {
      echo 0;
    }
  }
  
}
