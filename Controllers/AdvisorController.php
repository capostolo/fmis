<?php namespace Fmis\Controllers;

class AdvisorController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\AdvisorModel();
  }
  
  public function index()
  {    
    if(session()->get('advisor_where')){
      $data['rows'] = $this->model->modelList(['advisor_where' => session()->get('advisor_where')]);
    }
    else{
      $data['rows'] = $this->model->findAll();
    }
    return view('\Fmis\Views\Advisor\list', $data);
  }

  public function newItem()
  {    
    session()->remove('advisor_id');
    return view('\Fmis\Views\Advisor\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('advisor_id', $id);
    }
    return view('\Fmis\Views\Advisor\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $item = new \Fmis\Entities\AdvisorEntity();
    $item->fill($postdata);
	$item->parent_id = user_id();  
    if(session()->get('advisor_id')){
      $item->id = session()->get('advisor_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
      }
      else {
        $item_id = $item->id;
      }
      return redirect()->to('fmis/advisor/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Advisor\list');
  }
}
