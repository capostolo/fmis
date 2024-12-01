<?php namespace Fmis\Controllers;

class SoilManagementParcelController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\SoilManagementParcelModel();
  }
  
  public function index()
  {    
    if(session()->get('parcel_id')){
      $data['rows'] = $this->model->modelList(['parcel_id' => session()->get('parcel_id')]);
      return view('\Fmis\Views\Soilmanagementparcel\list', $data);
    }
    return redirect()->back()->withInput()->with('error', "Παρακαλώ επιλέξτε αγροτεμάχιο!");
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
    session()->remove('soil_management_parcel_id');
    return view('\Fmis\Views\Soilmanagementparcel\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $WorkType = new \Fmis\Models\WorkTypeModel(); 
		$PlantSpeciesSow = new \Fmis\Models\PlantSpeciesSowModel(); 
		$CoverCropSpecies = new \Fmis\Models\CoverCropSpeciesModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		$PloughEquipment = new \Fmis\Models\PloughEquipmentModel();
    $SoilManagement = new \Fmis\Models\SoilManagementModel();
    $data['work_type'] = $WorkType->findAll(); 
		$data['plant_species_sow'] = $PlantSpeciesSow->findAll(); 
		$data['cover_crop_species'] = $CoverCropSpecies->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['plough_equipment'] = $PloughEquipment->findAll();
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('soil_management_parcel_id', $id);
      $dirData = $SoilManagement->find($data['row']->soil_management_id);
      if($dirData){
        $data['directive'] = $dirData;
		if (!$data['row']->soil_management_date){  
        	session()->set('message', 'Προσοχή! Τα στοιχεία έχουν προσυμπληρωθεί με βάση την υφιστάμενη συμβουλή διαχείρισης εδάφους.');
		}
      }
    }
    return view('\Fmis\Views\Soilmanagementparcel\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $item = new \Fmis\Entities\SoilManagementParcelEntity();
    $item->fill($postdata);
    $item->parcel_id = session()->get('parcel_id');
    if(session()->get('soil_management_parcel_id')){
      $item->id = session()->get('soil_management_parcel_id');
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
    $item_id = $this->request->getPost('item_id');
    $item_data = $this->model->find($item_id);
    
    if(!$item_data->soil_management_id){
        $this->model->delete($item_id);
    }
    else {
        $item = new \Fmis\Entities\SoilManagementParcelEntity();
        $item->id = $item_id;
        $item->soil_management_date = null;
        $item->work_type_id = null;
        $item->purpose_description = null;
        $item->biodiversity_zone = null;
        $item->plant_species_sow_id = null;
        $item->seed_needed = null;
        $item->cover_crop_species_id = null;
        $item->cover_crop_seed = null;
        $item->farming_stage_id = null;
        $item->plough_equipment_id = null;
        $this->model->save($item);
    }

    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'Η διαγραφή ολοκληρώθηκε με επιτυχία'
    ]);
  }
}
