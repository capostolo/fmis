<?php namespace Fmis\Controllers;

class SoilManagementController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\SoilManagementModel();
  }
  
  public function index()
  {    
    $data['rows'] = $this->model->modelList(['farmer_id' => session()->get('farmer_id')]);
    return view('\Fmis\Views\Soilmanagement\list', $data);
  }

  public function newItem()
  {    
    $WorkType = new \Fmis\Models\WorkTypeModel(); 
		$PlantSpeciesSow = new \Fmis\Models\PlantSpeciesSowModel(); 
		$CoverCropSpecies = new \Fmis\Models\CoverCropSpeciesModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		$PloughEquipment = new \Fmis\Models\PloughEquipmentModel(); 
		
    $data['work_type'] = $WorkType->findAll(); 
		$data['plant_species_sow'] = $PlantSpeciesSow->findAll(); 
		$data['cover_crop_species'] = $CoverCropSpecies->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['plough_equipment'] = $PloughEquipment->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
		$data['crops'] = $crops->getShortList(['farmer_id' => session()->get('farmer_id')]);
    session()->remove('soil_management_id');
    return view('\Fmis\Views\Soilmanagement\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $WorkType = new \Fmis\Models\WorkTypeModel(); 
		$PlantSpeciesSow = new \Fmis\Models\PlantSpeciesSowModel(); 
		$CoverCropSpecies = new \Fmis\Models\CoverCropSpeciesModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		$PloughEquipment = new \Fmis\Models\PloughEquipmentModel(); 
		
    $data['work_type'] = $WorkType->findAll(); 
		$data['plant_species_sow'] = $PlantSpeciesSow->findAll(); 
		$data['cover_crop_species'] = $CoverCropSpecies->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['plough_equipment'] = $PloughEquipment->findAll(); 
	$data['disabled'] = '';	
		
    $crops = new \Fmis\Models\ParcelModel(); 
		$data['crops'] = $this->model->parcelList(session()->get('farmer_id'), $id);
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('soil_management_id', $id);
    }
    return view('\Fmis\Views\Soilmanagement\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $fi_selected = $postdata['fi_selected']; 
		 unset($postdata['fi_selected']);
    $item = new \Fmis\Entities\SoilManagementEntity();
    $item->fill($postdata);
    $item->farmer_id = session()->get('farmer_id');
    if(session()->get('soil_management_id')){
      $item->id = session()->get('soil_management_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        $parcel = new \Fmis\Models\SoilManagementParcelModel();
        foreach($fi_selected As $key => $val){ 
         $parcel->insert(array('soil_management_id' => $item_id, 'parcel_id' => $val)); 
        }
      }
      else {
        $item_id = $item->id;
        $parcel = new \Fmis\Models\SoilManagementParcelModel();
        $parcel->where('soil_management_id', $item_id)->delete();
        foreach($fi_selected As $key => $val){ 
         $parcel->insert(array('soil_management_id' => $item_id, 'parcel_id' => $val)); 
        }
      }
      
      //return redirect()->to('fmis/soil-management/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
      return redirect()->to('fmis/farmer/'.session()->get('farmer_id'))->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Soilmanagement\list');
  }
}
