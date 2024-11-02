<?php namespace Fmis\Controllers;

class SpecialisedFertiliserController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\SpecialisedFertiliserModel();
  }
  
  public function index()
  {    
    if(session()->get('specialised_fertiliser_where')){
      $data['rows'] = $this->model->modelList(['specialised_fertiliser_where' => session()->get('specialised_fertiliser_where')]);
    }
    else{
      $data['rows'] = $this->model->findAll();
    }
    return view('\Fmis\Views\Specialisedfertiliser\list', $data);
  }

  public function newItem()
  {    
    
    
    
    session()->remove('specialised_fertiliser_id');
    return view('\Fmis\Views\Specialisedfertiliser\add', $data ?? array());
  }

  public function showItem($id)
  {    
    
    
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('specialised_fertiliser_id', $id);
    }
    return view('\Fmis\Views\Specialisedfertiliser\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\SpecialisedFertiliserEntity();
    $item->fill($postdata);
    if(session()->get('specialised_fertiliser_id')){
      $item->id = session()->get('specialised_fertiliser_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        
        
      }
      else {
        $item_id = $item->id;
        
        
        
      }
      
      return redirect()->to('fmis/specialised-fertiliser/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Specialisedfertiliser\list');
  }
}
