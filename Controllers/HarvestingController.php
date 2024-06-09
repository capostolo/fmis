<?php namespace Fmis\Controllers;

class HarvestingController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\HarvestingModel();
  }
  
  public function index()
  {    
    $data['rows'] = $this->model->where(['farmer_id' => session()->get('farmer_id')])->findAll();
    return view('\Fmis\Views\Harvesting\list', $data);
  }

  public function newItem()
  {    
    $HarvestEquipment = new \Fmis\Models\HarvestEquipmentModel(); 
		
    $data['harvest_equipment'] = $HarvestEquipment->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
		$data['crops'] = $crops->getShortList(['farmer_id' => session()->get('farmer_id')]);
    session()->remove('harvesting_id');
    return view('\Fmis\Views\Harvesting\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $HarvestEquipment = new \Fmis\Models\HarvestEquipmentModel(); 
    $SelectedEquipment = new \Fmis\Models\HarvestingEquipModel(); 
		
    $data['harvest_equipment'] = $HarvestEquipment->findAll();
	$data['selected_equipment'] = $SelectedEquipment->where(['harvesting_id' => $id])->findColumn('harvest_equipment_id');
		
    $crops = new \Fmis\Models\ParcelModel(); 
		$data['crops'] = $this->model->parcelList(session()->get('farmer_id'), $id);
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('harvesting_id', $id);
    }
    return view('\Fmis\Views\Harvesting\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $fi_selected = $postdata['fi_selected']; 
	unset($postdata['fi_selected']);
	$eq_selected = $postdata['harvest_equipment_id'];
	unset($postdata['harvest_equipment_id']);
    $item = new \Fmis\Entities\HarvestingEntity();
    $item->fill($postdata);
    $item->farmer_id = session()->get('farmer_id');
    if(session()->get('harvesting_id')){
      $item->id = session()->get('harvesting_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        $parcel = new \Fmis\Models\HarvestParcelModel();
        foreach($fi_selected As $key => $val){ 
         $parcel->insert(array('harvesting_id' => $item_id, 'parcel_id' => $val)); 
        }
        $equipment = new \Fmis\Models\HarvestingEquipModel();
        foreach($eq_selected As $key => $val){ 
         $equipment->insert(array('harvesting_id' => $item_id, 'harvest_equipment_id' => $val)); 
        }
      }
      else {
        $item_id = $item->id;
        $parcel = new \Fmis\Models\HarvestParcelModel();
        $parcel->where('harvesting_id', $item_id)->delete();
        foreach($fi_selected As $key => $val){ 
    		 $parcel->insert(array('harvesting_id' => $item_id, 'parcel_id' => $val)); 
    	}
        $equipment = new \Fmis\Models\HarvestingEquipModel();
        $equipment->where('harvesting_id', $item_id)->delete();
        foreach($eq_selected As $key => $val){ 
         $equipment->insert(array('harvesting_id' => $item_id, 'harvest_equipment_id' => $val)); 
        }
      }
      
      return redirect()->to('fmis/farmer/'.session()->get('farmer_id'))->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Harvesting\list');
  }
}
