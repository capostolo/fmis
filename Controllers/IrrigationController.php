<?php namespace Fmis\Controllers;

class IrrigationController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\IrrigationModel();
  }
  
  public function index()
  {    
    $data['rows'] = $this->model->modelList(['farmer_id' => session()->get('farmer_id')]);
    return view('\Fmis\Views\Irrigation\list', $data);
  }

  public function newItem()
  {    
    $UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		$IrrigationEquipment = new \Fmis\Models\IrrigationEquipmentModel(); 
		
    $data['unit_measurement'] = $UnitMeasurement->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['irrigation_equipment'] = $IrrigationEquipment->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
		$data['crops'] = $crops->getShortList(['farmer_id' => session()->get('farmer_id')]);
    session()->remove('irrigation_id');
    return view('\Fmis\Views\Irrigation\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $Parcel = new \Fmis\Models\ParcelModel(); 
    
    $UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		$IrrigationEquipment = new \Fmis\Models\IrrigationEquipmentModel(); 
		
    $data['unit_measurement'] = $UnitMeasurement->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['irrigation_equipment'] = $IrrigationEquipment->findAll(); 
    $data['disabled'] = '';	
    
    $crops = new \Fmis\Models\IrrigationParcelModel(); 
    $crops_data = $crops->modelList(['farmer_id' => session()->get('farmer_id'), 'irrigation_id' => $id]);
    $existing_crops_ids = array_column($crops_data, 'parcel_id');
    $parcels_data = $Parcel->getShortList(['farmer_id' => session()->get('farmer_id')]);
    foreach ($parcels_data as $parcel) {
      $parcel->irrigation_parcel_id = 0;
      if (in_array($parcel->id, $existing_crops_ids)) {
        // Find the matching crop data to get irrigation_parcel_id
        foreach ($crops_data as $crop) {
          if ($crop->parcel_id == $parcel->id) {
            $parcel->irrigation_parcel_id = $crop->irrigation_parcel_id;
            break;
          }
        }
      }
    }
    $data['crops'] = $parcels_data;
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('irrigation_id', $id);
    }
    return view('\Fmis\Views\Irrigation\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $fi_selected = $postdata['fi_selected']; 
		unset($postdata['fi_selected']);
    $item = new \Fmis\Entities\IrrigationEntity();
    $item->fill($postdata);
    $item->farmer_id = session()->get('farmer_id');
    if(session()->get('irrigation_id')){
      $item->id = session()->get('irrigation_id');
    }
    if($this->model->save($item)){
      $parcel = new \Fmis\Models\IrrigationParcelModel();
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
      }
      else {
        $item_id = $item->id;
      }
        
      // Get existing parcel relationships for this irrigation
      $existing_parcels = $parcel->where('irrigation_id', $item_id)->findAll();
      $existing_parcel_ids = array_column($existing_parcels, 'parcel_id');
      
      // Handle each selected parcel
      foreach($fi_selected as $val) {
          if (in_array($val, $existing_parcel_ids)) {
              // Update existing record
              $parcel->where(['irrigation_id' => $item_id, 'parcel_id' => $val])
                    ->set(['irrigation_id' => $item_id])
                    ->update();
          } else {
              // Insert new record
              $parcel->insert(['irrigation_id' => $item_id, 'parcel_id' => $val]);
          }
      }
      
      // Delete records for parcels that are no longer selected
      $parcels_to_delete = array_diff($existing_parcel_ids, $fi_selected);
      if (!empty($parcels_to_delete)) {
          $parcel->whereIn('parcel_id', $parcels_to_delete)
                ->where('irrigation_id', $item_id)
                ->delete();
      }
      
      return redirect()->to('fmis/irrigation/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }
  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Irrigation\list');
  }

  public function createDirectiveFromParcel($parcel_id)
  {    
    // Initialize models
    $IrrigationParcel = new \Fmis\Models\IrrigationParcelModel();
    $IrrigationEquipment = new \Fmis\Models\IrrigationEquipmentModel(); 
    
    // Get the parcel implementation
    $parcel_implementation = $IrrigationParcel->find($parcel_id);
    
    if (!$parcel_implementation) {
      return redirect()->back()->with('error', 'Η καταγραφή άρδευσης δεν βρέθηκε.');
    }
    
    // Create new irrigation entity
    $item = new \Fmis\Entities\IrrigationEntity();
    
    // Copy relevant fields from parcel implementation
    $item->farmer_id = session()->get('farmer_id');
    $item->irrigation_equipment_id = $parcel_implementation->irrigation_equipment_id;
    $item->quantity = $parcel_implementation->quantity;

    // Set directive date 15 days before irrigation date
    $item->dir_date = $parcel_implementation->irrigation_date->modify('-15 days')->toLocalizedString('d/M/Y');
    
    // Save the new directive
    if ($this->model->save($item)) {
      $new_directive_id = $this->model->getInsertID();
      session()->set('irrigation_id', $new_directive_id);
      
      // Link the new directive to this parcel
      $parcel_item = new \Fmis\Entities\IrrigationParcelEntity();
      $parcel_item->id = $parcel_id;
      $parcel_item->irrigation_id = $new_directive_id;
      $IrrigationParcel->save($parcel_item);
      
      //Show the new directive so it can be modified
      return redirect()->to('fmis/irrigation/'.$new_directive_id)->with('message', 'Η οδηγία δημιουργήθηκε με επιτυχία και έχει αποθηκευθεί με βάση τα στοιχεία της καταγραφής.');
    }
    
    return redirect()->back()->with('error', 'Σφάλμα κατά τη δημιουργία της νέας συμβουλής άρδευσης.');
  }
}
