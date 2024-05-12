<?php namespace Fmis\Controllers;

class FarmingStageController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\FarmingStageModel();
  }
  
  public function index()
  {    
    if(session()->get('farming_stage_where')){
      $data['rows'] = $this->model->modelList(['farming_stage_where' => session()->get('farming_stage_where')]);
    }
    else{
      $data['rows'] = $this->model->findAll();
    }
    return view('\Fmis\Views\Farmingstage\list', $data);
  }

  public function newItem()
  {    
    
    
    
    session()->remove('farming_stage_id');
    return view('\Fmis\Views\Farmingstage\add', $data ?? array());
  }

  public function showItem($id)
  {    
    
    
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('farming_stage_id', $id);
    }
    return view('\Fmis\Views\Farmingstage\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\FarmingStageEntity();
    $item->fill($postdata);
    if(session()->get('farming_stage_id')){
      $item->id = session()->get('farming_stage_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        
        
      }
      else {
        $item_id = $item->id;
        
        
        
      }
      
      return redirect()->to('farming-stage/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Farmingstage\list');
  }
}
