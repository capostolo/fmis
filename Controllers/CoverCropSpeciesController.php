<?php namespace Fmis\Controllers;

class CoverCropSpeciesController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\CoverCropSpeciesModel();
  }
  
  public function index()
  {    
    if(session()->get('cover_crop_species_where')){
      $data['rows'] = $this->model->modelList(['cover_crop_species_where' => session()->get('cover_crop_species_where')]);
    }
    else{
      $data['rows'] = $this->model->findAll();
    }
    return view('\Fmis\Views\Covercropspecies\list', $data);
  }

  public function newItem()
  {    
    
    
    
    session()->remove('cover_crop_species_id');
    return view('\Fmis\Views\Covercropspecies\add', $data ?? array());
  }

  public function showItem($id)
  {    
    
    
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('cover_crop_species_id', $id);
    }
    return view('\Fmis\Views\Covercropspecies\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\CoverCropSpeciesEntity();
    $item->fill($postdata);
    if(session()->get('cover_crop_species_id')){
      $item->id = session()->get('cover_crop_species_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        
        
      }
      else {
        $item_id = $item->id;
        
        
        
      }
      
      return redirect()->to('fmis/cover-crop-species/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Covercropspecies\list');
  }
}
