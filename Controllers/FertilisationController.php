<?php namespace Fmis\Controllers;

class FertilisationController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\FertilisationModel();
  }
  
  public function index()
  {    
    $data['rows'] = $this->model->modelList(['farmer_id' => session()->get('farmer_id')]);
    return view('\Fmis\Views\Fertilisation\list', $data);
  }

  public function newItem()
  {    
    $Fertiliser = new \Fmis\Models\FertiliserModel(); 
    $UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
    $FertiliserApplication = new \Fmis\Models\FertiliserApplicationModel(); 
    $FarmingStage = new \Fmis\Models\FarmingStageModel(); 
    $FertiliseEquipment = new \Fmis\Models\FertiliseEquipmentModel(); 
    $SpecialisedFertiliser = new \Fmis\Models\SpecialisedFertiliserModel(); 
		
    $data['fertiliser'] = $Fertiliser->modelList(); 
    $data['unit_measurement'] = $UnitMeasurement->where(['practice' => 'fertilisation'])->findAll(); 
    $data['fertiliser_application'] = $FertiliserApplication->findAll(); 
    $data['farming_stage'] = $FarmingStage->findAll(); 
    $data['fertilise_equipment'] = $FertiliseEquipment->findAll(); 
    $data['specialised_fertiliser'] = $SpecialisedFertiliser->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
		$data['crops'] = $crops->getShortList(['farmer_id' => session()->get('farmer_id')]);
    session()->remove('fertilisation_id');
    return view('\Fmis\Views\Fertilisation\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $Fertiliser = new \Fmis\Models\FertiliserModel(); 
    $UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
    $FertiliserApplication = new \Fmis\Models\FertiliserApplicationModel(); 
    $FarmingStage = new \Fmis\Models\FarmingStageModel(); 
    $FertiliseEquipment = new \Fmis\Models\FertiliseEquipmentModel(); 
    $SpecialisedFertiliser = new \Fmis\Models\SpecialisedFertiliserModel();
    $Parcel = new \Fmis\Models\ParcelModel(); 
    
    $data['fertiliser'] = $Fertiliser->modelList(); 
    $data['unit_measurement'] = $UnitMeasurement->findAll(); 
    $data['fertiliser_application'] = $FertiliserApplication->findAll(); 
    $data['farming_stage'] = $FarmingStage->findAll(); 
    $data['fertilise_equipment'] = $FertiliseEquipment->findAll(); 
    $data['specialised_fertiliser'] = $SpecialisedFertiliser->findAll(); 
    $data['disabled'] = '';	
    
    $crops = new \Fmis\Models\FertilisationParcelModel(); 
    $crops_data = $crops->modelList(['farmer_id' => session()->get('farmer_id'), 'fertilisation_id' => $id]);
    $existing_crops_ids = array_column($crops_data, 'parcel_id');
    $parcels_data = $Parcel->getShortList(['farmer_id' => session()->get('farmer_id')]);
    foreach ($parcels_data as $parcel) {
      $parcel->fertilisation_parcel_id = 0;
      if (in_array($parcel->id, $existing_crops_ids)) {
        // Find the matching crop data to get fertilisation_parcel_id
        foreach ($crops_data as $crop) {
          if ($crop->parcel_id == $parcel->id) {
            $parcel->fertilisation_parcel_id = $crop->fertilisation_parcel_id;
            break;
          }
        }
      }
    }
    $data['crops'] = $parcels_data;
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('fertilisation_id', $id);
    }
    return view('\Fmis\Views\Fertilisation\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $fi_selected = $postdata['fi_selected']; 
		unset($postdata['fi_selected']);
    $item = new \Fmis\Entities\FertilisationEntity();
    $item->fill($postdata);
    $item->farmer_id = session()->get('farmer_id');
    if(session()->get('fertilisation_id')){
      $item->id = session()->get('fertilisation_id');
    }
    if($this->model->save($item)){
      $parcel = new \Fmis\Models\FertilisationParcelModel();
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
      }
      else {
        $item_id = $item->id;
      }
        
      // Get existing parcel relationships for this fertilisation
      $existing_parcels = $parcel->where('fertilisation_id', $item_id)->findAll();
      $existing_parcel_ids = array_column($existing_parcels, 'parcel_id');
      
      // Handle each selected parcel
      foreach($fi_selected as $val) {
          if (in_array($val, $existing_parcel_ids)) {
              // Update existing record
              $parcel->where(['fertilisation_id' => $item_id, 'parcel_id' => $val])
                    ->set(['fertilisation_id' => $item_id])
                    ->update();
          } else {
              // Insert new record
              $parcel->insert(['fertilisation_id' => $item_id, 'parcel_id' => $val]);
          }
      }
      
      // Delete records for parcels that are no longer selected
      $parcels_to_delete = array_diff($existing_parcel_ids, $fi_selected);
      if (!empty($parcels_to_delete)) {
          $parcel->whereIn('parcel_id', $parcels_to_delete)
                ->where('fertilisation_id', $item_id)
                ->delete();
      }
      
      return redirect()->to('fmis/fertilisation/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }
   }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Fertilisation\list');
  }

  public function createDirectiveFromParcel($parcel_id)
  {    
    // Initialize models
    $FertilisationParcel = new \Fmis\Models\FertilisationParcelModel();
    $Fertiliser = new \Fmis\Models\FertiliserModel(); 
    $UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
    $FertiliserApplication = new \Fmis\Models\FertiliserApplicationModel(); 
    $FarmingStage = new \Fmis\Models\FarmingStageModel(); 
    $FertiliseEquipment = new \Fmis\Models\FertiliseEquipmentModel(); 
    $SpecialisedFertiliser = new \Fmis\Models\SpecialisedFertiliserModel(); 
    
    // Get the parcel implementation
    $parcel_implementation = $FertilisationParcel->find($parcel_id);
    
    if (!$parcel_implementation) {
      return redirect()->back()->with('error', 'Η καταγραφή λίπανσης δεν βρέθηκε.');
    }
    
    // Create new fertilisation entity
    $item = new \Fmis\Entities\FertilisationEntity();
    
    // Copy relevant fields from parcel implementation
    $item->farmer_id = session()->get('farmer_id');
    $item->fertiliser_id = $parcel_implementation->fertiliser_id;
    $item->quantity = $parcel_implementation->quantity_description;
    $item->unit_measurement_id = $parcel_implementation->unit_measurement_id;
    $item->fertiliser_application_id = $parcel_implementation->fertiliser_application_id;
    $item->farming_stage_id = $parcel_implementation->farming_stage_id;
    $item->fertilise_equipment_id = $parcel_implementation->fertilise_equipment_id;
    $item->specialised_fertiliser_id = $parcel_implementation->specialised_fertiliser_id;

    // Set directive date 15 days before fertilisation date
    $item->dir_date = $parcel_implementation->fertilisation_date->modify('-15 days')->toLocalizedString('d/M/Y');
    
    // Save the new directive
    if ($this->model->save($item)) {
      $new_directive_id = $this->model->getInsertID();
      session()->set('fertilisation_id', $new_directive_id);
      
      // Link the new directive to this parcel
      $parcel_item = new \Fmis\Entities\FertilisationParcelEntity();
      $parcel_item->id = $parcel_id;
      $parcel_item->fertilisation_id = $new_directive_id;
      $FertilisationParcel->save($parcel_item);
      
      //Show the new directive so it can be modified
      return redirect()->to('fmis/fertilisation/'.$new_directive_id)->with('message', 'Η οδηγία δημιουργήθηκε με επιτυχία και έχει αποθηκευθεί με βάση τα στοιχεία της καταγραφής.');
      //return redirect()->back()->with('message', 'Η οδηγία δημιουργήθηκε με επιτυχία!');
    }
    
    return redirect()->back()->with('error', 'Σφάλμα κατά τη δημιουργία της νέας συμβουλής λίπανσης.');
  }
}
