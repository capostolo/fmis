<?php namespace Fmis\Controllers;

class PlantSpeciesSowController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\PlantSpeciesSowModel();
  }
  
  public function index()
  {    
    if(session()->get('plant_species_sow_where')){
      $data['rows'] = $this->model->modelList(['plant_species_sow_where' => session()->get('plant_species_sow_where')]);
    }
    else{
      $data['rows'] = $this->model->findAll();
    }
    return view('\Fmis\Views\Plantspeciessow\list', $data);
  }

  public function newItem()
  {    
    
    
    
    session()->remove('plant_species_sow_id');
    return view('\Fmis\Views\Plantspeciessow\add', $data ?? array());
  }

  public function showItem($id)
  {    
    
    
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('plant_species_sow_id', $id);
    }
    return view('\Fmis\Views\Plantspeciessow\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\PlantSpeciesSowEntity();
    $item->fill($postdata);
    if(session()->get('plant_species_sow_id')){
      $item->id = session()->get('plant_species_sow_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        
        
      }
      else {
        $item_id = $item->id;
        
        
        
      }
      
      return redirect()->to('plant-species-sow/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Plantspeciessow\list');
  }
}
