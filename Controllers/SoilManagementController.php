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
		
    $data['work_type'] = $WorkType->modelList(); 
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
    $Parcel = new \Fmis\Models\ParcelModel(); 
    $WorkType = new \Fmis\Models\WorkTypeModel(); 
		$PlantSpeciesSow = new \Fmis\Models\PlantSpeciesSowModel(); 
		$CoverCropSpecies = new \Fmis\Models\CoverCropSpeciesModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		$PloughEquipment = new \Fmis\Models\PloughEquipmentModel(); 
		
    $data['work_type'] = $WorkType->modelList(); 
		$data['plant_species_sow'] = $PlantSpeciesSow->findAll(); 
		$data['cover_crop_species'] = $CoverCropSpecies->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['plough_equipment'] = $PloughEquipment->findAll(); 
    $data['disabled'] = '';	
    
    $crops = new \Fmis\Models\SoilManagementParcelModel(); 
    $crops_data = $crops->modelList(['farmer_id' => session()->get('farmer_id'), 'soil_management_id' => $id]);
    $existing_crops_ids = array_column($crops_data, 'parcel_id');
    $parcels_data = $Parcel->getShortList(['farmer_id' => session()->get('farmer_id')]);
    foreach ($parcels_data as $parcel) {
      $parcel->soil_management_parcel_id = 0;
      if (in_array($parcel->id, $existing_crops_ids)) {
        // Find the matching crop data to get soil_management_parcel_id
        foreach ($crops_data as $crop) {
          if ($crop->parcel_id == $parcel->id) {
            $parcel->soil_management_parcel_id = $crop->soil_management_parcel_id;
            break;
          }
        }
      }
    }
    $data['crops'] = $parcels_data;
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
      $parcel = new \Fmis\Models\SoilManagementParcelModel();
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
      }
      else {
        $item_id = $item->id;
      }
        
      // Get existing parcel relationships for this soil management
      $existing_parcels = $parcel->where('soil_management_id', $item_id)->findAll();
      $existing_parcel_ids = array_column($existing_parcels, 'parcel_id');
      
      // Handle each selected parcel
      foreach($fi_selected as $val) {
          if (in_array($val, $existing_parcel_ids)) {
              // Update existing record
              $parcel->where(['soil_management_id' => $item_id, 'parcel_id' => $val])
                    ->set(['soil_management_id' => $item_id])
                    ->update();
          } else {
              // Insert new record
              $parcel->insert(['soil_management_id' => $item_id, 'parcel_id' => $val]);
          }
      }
      
      // Delete records for parcels that are no longer selected
      $parcels_to_delete = array_diff($existing_parcel_ids, $fi_selected);
      if (!empty($parcels_to_delete)) {
          $parcel->whereIn('parcel_id', $parcels_to_delete)
                ->where('soil_management_id', $item_id)
                ->delete();
      }
      
      return redirect()->to('fmis/soil-management/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }
  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Soilmanagement\list');
  }

  public function createDirectiveFromParcel($parcel_id)
  {    
    // Initialize models
    $SoilManagementParcel = new \Fmis\Models\SoilManagementParcelModel();
    $PloughEquipment = new \Fmis\Models\PloughEquipmentModel(); 
    
    // Get the parcel implementation
    $parcel_implementation = $SoilManagementParcel->find($parcel_id);
    
    if (!$parcel_implementation) {
      return redirect()->back()->with('error', 'Η καταγραφή διαχείρισης εδάφους δεν βρέθηκε.');
    }
    
    // Create new soil management entity
    $item = new \Fmis\Entities\SoilManagementEntity();
    
    // Copy relevant fields from parcel implementation
    $item->farmer_id = session()->get('farmer_id');
    $item->plough_equipment_id = $parcel_implementation->plough_equipment_id;

    // Set directive date 15 days before soil management date
    $item->dir_date = $parcel_implementation->soil_management_date->modify('-15 days')->toLocalizedString('d/M/Y');
    
    // Save the new directive
    if ($this->model->save($item)) {
      $new_directive_id = $this->model->getInsertID();
      session()->set('soil_management_id', $new_directive_id);
      
      // Link the new directive to this parcel
      $parcel_item = new \Fmis\Entities\SoilManagementParcelEntity();
      $parcel_item->id = $parcel_id;
      $parcel_item->soil_management_id = $new_directive_id;
      $SoilManagementParcel->save($parcel_item);
      
      //Show the new directive so it can be modified
      return redirect()->to('fmis/soil-management/'.$new_directive_id)->with('message', 'Η οδηγία δημιουργήθηκε με επιτυχία και έχει αποθηκευθεί με βάση τα στοιχεία της καταγραφής.');
    }
    
    return redirect()->back()->with('error', 'Σφάλμα κατά τη δημιουργία της νέας συμβουλής διαχείρισης εδάφους.');
  }
}
