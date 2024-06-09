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
		$SelectedEquipment = new \Fmis\Models\HarvestingEquipModel(); 
		$data['selected_equipment'] = $SelectedEquipment->where(['harvesting_id' => $data['row']->harvesting_id])->findColumn('harvest_equipment_id');
        session()->set('message', 'Προσοχή! Τα στοιχεία έχουν προσυμπληρωθεί με βάση την υφιστάμενη συμβουλή συγκομιδής.');
      }
	  else{
		$data['selected_equipment'] = $SelectedEquipment->where(['harvest_parcel_id' => $id])->findColumn('harvest_equipment_id');
	  }
    }
    return view('\Fmis\Views\Harvestparcel\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $item = new \Fmis\Entities\HarvestParcelEntity();
	$eq_selected = $postdata['harvest_equipment_id'];
	unset($postdata['harvest_equipment_id']);
    $item->fill($postdata);
    $item->parcel_id = session()->get('parcel_id');
    if(session()->get('harvest_parcel_id')){
      $item->id = session()->get('harvest_parcel_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        $equipment = new \Fmis\Models\HarvestParcelEquipModel();
        foreach($eq_selected As $key => $val){ 
         $equipment->insert(array('harvest_parcel_id' => $item_id, 'harvest_equipment_id' => $val)); 
        }
      }
      else {
        $item_id = $item->id;
        $equipment = new \Fmis\Models\HarvestParcelEquipModel();
        $equipment->where('harvest_parcel_id', $item_id)->delete();
        foreach($eq_selected As $key => $val){ 
         $equipment->insert(array('harvest_parcel_id' => $item_id, 'harvest_equipment_id' => $val)); 
        }
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
