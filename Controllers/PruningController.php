<?php namespace Fmis\Controllers;

class PruningController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\PruningModel();
  }
  
  public function index()
  {    
    $data['rows'] = $this->model->modelList(['farmer_id' => session()->get('farmer_id')]);
    return view('\Fmis\Views\Pruning\list', $data);
  }

  public function newItem()
  {    
    $PruningType = new \Fmis\Models\PruningTypeModel(); 
		$PruningEquipment = new \Fmis\Models\PruningEquipmentModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		
    $data['pruning_type'] = $PruningType->modelList(); 
		$data['pruning_equipment'] = $PruningEquipment->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
		$data['crops'] = $crops->getShortList(['farmer_id' => session()->get('farmer_id')]);
    session()->remove('pruning_id');
    return view('\Fmis\Views\Pruning\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $PruningType = new \Fmis\Models\PruningTypeModel(); 
		$PruningEquipment = new \Fmis\Models\PruningEquipmentModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel();
    $Parcel = new \Fmis\Models\ParcelModel(); 
		
    $data['pruning_type'] = $PruningType->modelList(); 
		$data['pruning_equipment'] = $PruningEquipment->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
	  $data['disabled'] = '';	
		
    $crops = new \Fmis\Models\PruningParcelModel(); 
		$crops_data = $crops->modelList(['farmer_id' => session()->get('farmer_id'), 'pruning_id' => $id]);
    $existing_crops_ids = array_column($crops_data, 'parcel_id');
    $parcels_data = $Parcel->getShortList(['farmer_id' => session()->get('farmer_id')]);
    foreach ($parcels_data as $parcel) {
      $parcel->pruning_parcel_id = 0;
      if (in_array($parcel->id, $existing_crops_ids)) {
        // Find the matching crop data to get pruning_parcel_id
        foreach ($crops_data as $crop) {
          if ($crop->parcel_id == $parcel->id) {
            $parcel->pruning_parcel_id = $crop->pruning_parcel_id;
            break;
          }
        }
      }
    }
    $data['crops'] = $parcels_data;
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('pruning_id', $id);
    }
    return view('\Fmis\Views\Pruning\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $fi_selected = $postdata['fi_selected']; 
		unset($postdata['fi_selected']);
    $item = new \Fmis\Entities\PruningEntity();
    $item->fill($postdata);
    $item->farmer_id = session()->get('farmer_id');
    if(session()->get('pruning_id')){
      $item->id = session()->get('pruning_id');
    }
    if($this->model->save($item)){
      $parcel = new \Fmis\Models\PruningParcelModel();
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
      }
      else {
        $item_id = $item->id;
      }
        
      // Get existing parcel relationships for this pruning
      $existing_parcels = $parcel->where('pruning_id', $item_id)->findAll();
      $existing_parcel_ids = array_column($existing_parcels, 'parcel_id');
      
      // Handle each selected parcel
      foreach($fi_selected as $val) {
          if (in_array($val, $existing_parcel_ids)) {
              // Update existing record
              $parcel->where(['pruning_id' => $item_id, 'parcel_id' => $val])
                    ->set(['pruning_id' => $item_id])
                    ->update();
          } else {
              // Insert new record
              $parcel->insert(['pruning_id' => $item_id, 'parcel_id' => $val]);
          }
      }
      
      // Delete records for parcels that are no longer selected
      $parcels_to_delete = array_diff($existing_parcel_ids, $fi_selected);
      if (!empty($parcels_to_delete)) {
          $parcel->whereIn('parcel_id', $parcels_to_delete)
                ->where('pruning_id', $item_id)
                ->delete();
      }
      
      return redirect()->to('fmis/pruning/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }
  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Pruning\list');
  }

  public function createDirectiveFromParcel($parcel_id)
  {    
    // Initialize models
    $PruningParcel = new \Fmis\Models\PruningParcelModel();
    $PruningType = new \Fmis\Models\PruningTypeModel(); 
    $PruningEquipment = new \Fmis\Models\PruningEquipmentModel(); 
    
    // Get the parcel implementation
    $parcel_implementation = $PruningParcel->find($parcel_id);
    
    if (!$parcel_implementation) {
      return redirect()->back()->with('error', 'Η καταγραφή κλάδευσης δεν βρέθηκε.');
    }
    
    // Create new pruning entity
    $item = new \Fmis\Entities\PruningEntity();
    
    // Copy relevant fields from parcel implementation
    $item->farmer_id = session()->get('farmer_id');
    $item->pruning_type_id = $parcel_implementation->pruning_type_id;
    $item->pruning_equipment_id = $parcel_implementation->pruning_equipment_id;
    $item->farming_stage_id = $parcel_implementation->farming_stage_id;

    // Set directive date 15 days before pruning date
    $item->dir_date = $parcel_implementation->pruning_date->modify('-15 days')->toLocalizedString('d/M/Y');
    
    // Save the new directive
    if ($this->model->save($item)) {
      $new_directive_id = $this->model->getInsertID();
      session()->set('pruning_id', $new_directive_id);
      
      // Link the new directive to this parcel
      $parcel_item = new \Fmis\Entities\PruningParcelEntity();
      $parcel_item->id = $parcel_id;
      $parcel_item->pruning_id = $new_directive_id;
      $PruningParcel->save($parcel_item);
      
      //Show the new directive so it can be modified
      return redirect()->to('fmis/pruning/'.$new_directive_id)->with('message', 'Η οδηγία δημιουργήθηκε με επιτυχία και έχει αποθηκευθεί με βάση τα στοιχεία της καταγραφής.');
    }
    
    return redirect()->back()->with('error', 'Σφάλμα κατά τη δημιουργία της νέας συμβουλής κλάδευσης.');
  }
}
