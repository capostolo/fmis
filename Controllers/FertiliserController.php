<?php namespace Fmis\Controllers;

class FertiliserController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\FertiliserModel();
  }
  
  public function index()
  {    
    if(session()->get('fertiliser_where')){
      $data['rows'] = $this->model->modelList(['fertiliser_where' => session()->get('fertiliser_where')]);
    }
    else{
      $data['rows'] = $this->model->findAll();
    }
    return view('\Fmis\Views\Fertiliser\list', $data);
  }

  public function newItem()
  {    
    
    
    
    session()->remove('fertiliser_id');
    $Ecoscheme = new \Fmis\Models\EcoschemeModel();
	$data['ecoscheme'] = $Ecoscheme->findAll();
    return view('\Fmis\Views\Fertiliser\add', $data ?? array());
  }

  public function showItem($id)
  {    
    
    
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('fertiliser_id', $id);
    }
    $Ecoscheme = new \Fmis\Models\EcoschemeModel();
	$data['ecoscheme'] = $Ecoscheme->findAll();
    return view('\Fmis\Views\Fertiliser\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\FertiliserEntity();
    $item->fill($postdata);
    if(session()->get('fertiliser_id')){
      $item->id = session()->get('fertiliser_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        
        
      }
      else {
        $item_id = $item->id;
        
        
        
      }
      
      return redirect()->to('fmis/fertiliser/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Fertiliser\list');
  }
}
