<?php namespace Fmis\Controllers;

class HarvestParcelController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\HarvestParcelModel();
  }
  
  public function index()
  {    
    if(session()->get('parcel_id')){
      $data['rows'] = $this->model->modelList(['parcel_id' => session()->get('parcel_id')]);
      return view('\Fmis\Views\Harvestparcel\list', $data);
    }
    return redirect()->back()->withInput()->with('error', "Παρακαλώ επιλέξτε αγροτεμάχιο!");
  }

  public function newItem()
  {    
    $HarvestEquipment = new \Fmis\Models\HarvestEquipmentModel(); 
    $data['harvest_equipment'] = $HarvestEquipment->findAll(); 
    session()->remove('harvest_parcel_id');
    return view('\Fmis\Views\Harvestparcel\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $HarvestEquipment = new \Fmis\Models\HarvestEquipmentModel(); 
    $Harvesting = new \Fmis\Models\HarvestingModel();
    $data['harvest_equipment'] = $HarvestEquipment->findAll(); 
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('harvest_parcel_id', $id);
      $dirData = $Harvesting->find($data['row']->harvesting_id);
      if($dirData && !$data['row']->harvesting_date){
        $data['directive'] = $dirData;
        session()->set('message', 'Προσοχή! Τα στοιχεία έχουν προσυμπληρωθεί με βάση την υφιστάμενη συμβουλή συγκομιδής.');
      }
    }
    return view('\Fmis\Views\Harvestparcel\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $item = new \Fmis\Entities\HarvestParcelEntity();
    $item->fill($postdata);
    $item->parcel_id = session()->get('parcel_id');
    if(session()->get('harvest_parcel_id')){
      $item->id = session()->get('harvest_parcel_id');
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
     return view('\Fmis\Views\Harvestparcel\list');
  }
}
