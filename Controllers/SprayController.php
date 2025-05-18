<?php namespace Fmis\Controllers;

class SprayController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\SprayModel();
  }
  
  public function index()
  {    
    $data['rows'] = $this->model->modelList(['farmer_id' => session()->get('farmer_id')]);
    return view('\Fmis\Views\Spray\list', $data);
  }

  public function newItem()
  {    
    $ProtectiveProduct = new \Fmis\Models\ProtectiveProductModel(); 
		$UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		$SprayEquipment = new \Fmis\Models\SprayEquipmentModel(); 
		
    $data['protective_product'] = $ProtectiveProduct->getPpList(); 
		$data['unit_measurement'] = $UnitMeasurement->where("practice = 'protection'")->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['spray_equipment'] = $SprayEquipment->modelList(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
		$data['crops'] = $crops->getShortList(['farmer_id' => session()->get('farmer_id')]);
    session()->remove('spray_id');
    return view('\Fmis\Views\Spray\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $Parcel = new \Fmis\Models\ParcelModel(); 
    $ProtectiveProduct = new \Fmis\Models\ProtectiveProductModel(); 
		$UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		$SprayEquipment = new \Fmis\Models\SprayEquipmentModel(); 
		
    $data['protective_product'] = $ProtectiveProduct->getPpList(); 
		$data['unit_measurement'] = $UnitMeasurement->where("practice = 'protection'")->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['spray_equipment'] = $SprayEquipment->modelList(); 
    $data['disabled'] = '';	
    
    $crops = new \Fmis\Models\SprayParcelModel(); 
    $crops_data = $crops->modelList(['farmer_id' => session()->get('farmer_id'), 'spray_id' => $id]);
    $existing_crops_ids = array_column($crops_data, 'parcel_id');
    $parcels_data = $Parcel->getShortList(['farmer_id' => session()->get('farmer_id')]);
    foreach ($parcels_data as $parcel) {
      $parcel->spray_parcel_id = 0;
      if (in_array($parcel->id, $existing_crops_ids)) {
        // Find the matching crop data to get spray_parcel_id
        foreach ($crops_data as $crop) {
          if ($crop->parcel_id == $parcel->id) {
            $parcel->spray_parcel_id = $crop->spray_parcel_id;
            break;
          }
        }
      }
    }
    $data['crops'] = $parcels_data;
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('spray_id', $id);
    }
    return view('\Fmis\Views\Spray\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $fi_selected = $postdata['fi_selected']; 
		unset($postdata['fi_selected']);
    $item = new \Fmis\Entities\SprayEntity();
    $item->fill($postdata);
    $item->farmer_id = session()->get('farmer_id');
    if(session()->get('spray_id')){
      $item->id = session()->get('spray_id');
    }
    if($this->model->save($item)){
      $parcel = new \Fmis\Models\SprayParcelModel();
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
      }
      else {
        $item_id = $item->id;
      }
        
      // Get existing parcel relationships for this spray
      $existing_parcels = $parcel->where('spray_id', $item_id)->findAll();
      $existing_parcel_ids = array_column($existing_parcels, 'parcel_id');
      
      // Handle each selected parcel
      foreach($fi_selected as $val) {
          if (in_array($val, $existing_parcel_ids)) {
              // Update existing record
              $parcel->where(['spray_id' => $item_id, 'parcel_id' => $val])
                    ->set(['spray_id' => $item_id])
                    ->update();
          } else {
              // Insert new record
              $parcel->insert(['spray_id' => $item_id, 'parcel_id' => $val]);
          }
      }
      
      // Delete records for parcels that are no longer selected
      $parcels_to_delete = array_diff($existing_parcel_ids, $fi_selected);
      if (!empty($parcels_to_delete)) {
          $parcel->whereIn('parcel_id', $parcels_to_delete)
                ->where('spray_id', $item_id)
                ->delete();
      }
      
      return redirect()->to('fmis/spray/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }
  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Spray\list');
  }

  public function createDirectiveFromParcel($parcel_id)
  {    
    // Initialize models
    $SprayParcel = new \Fmis\Models\SprayParcelModel();
    $ProtectiveProduct = new \Fmis\Models\ProtectiveProductModel(); 
    $SprayEquipment = new \Fmis\Models\SprayEquipmentModel(); 
    $ProductActive = new \Fmis\Models\ProductActiveModel(); 
    
    // Get the parcel implementation
    $parcel_implementation = $SprayParcel->find($parcel_id);
    
    if (!$parcel_implementation) {
      return redirect()->back()->with('error', 'Η καταγραφή ψεκασμού δεν βρέθηκε.');
    }
    
    // Create new spray entity
    $item = new \Fmis\Entities\SprayEntity();
    
    // Copy relevant fields from parcel implementation
    $item->farmer_id = session()->get('farmer_id');
    $item->protective_product_id = $parcel_implementation->protective_product_id;
    $item->quantity = $parcel_implementation->quantity;
    $item->spray_equipment_id = $parcel_implementation->spray_equipment_id;
    $item->product_active_id = $parcel_implementation->product_active_id;

    // Set directive date 15 days before spray date
    $item->dir_date = $parcel_implementation->spray_date->modify('-15 days')->toLocalizedString('d/M/Y');
    
    // Save the new directive
    if ($this->model->save($item)) {
      $new_directive_id = $this->model->getInsertID();
      session()->set('spray_id', $new_directive_id);
      
      // Link the new directive to this parcel
      $parcel_item = new \Fmis\Entities\SprayParcelEntity();
      $parcel_item->id = $parcel_id;
      $parcel_item->spray_id = $new_directive_id;
      $SprayParcel->save($parcel_item);
      
      //Show the new directive so it can be modified
      return redirect()->to('fmis/spray/'.$new_directive_id)->with('message', 'Η οδηγία δημιουργήθηκε με επιτυχία και έχει αποθηκευθεί με βάση τα στοιχεία της καταγραφής.');
    }
    
    return redirect()->back()->with('error', 'Σφάλμα κατά τη δημιουργία της νέας συμβουλής ψεκασμού.');
  }
}
