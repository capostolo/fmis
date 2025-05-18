<?php namespace Fmis\Controllers;

class MassTrappingController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\MassTrappingModel();
  }
  
  public function index()
  {    
    $data['rows'] = $this->model->modelList(['farmer_id' => session()->get('farmer_id')]);
    return view('\Fmis\Views\Masstrapping\list', $data);
  }

  public function newItem()
  {    
    $Trap = new \Fmis\Models\TrapModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		
    $data['trap'] = $Trap->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
		$data['crops'] = $crops->getShortList(['farmer_id' => session()->get('farmer_id')]);
    session()->remove('mass_trapping_id');
    return view('\Fmis\Views\Masstrapping\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $Trap = new \Fmis\Models\TrapModel(); 
    $FarmingStage = new \Fmis\Models\FarmingStageModel(); 
    $Parcel = new \Fmis\Models\ParcelModel(); 
    
    $data['trap'] = $Trap->findAll(); 
    $data['farming_stage'] = $FarmingStage->findAll(); 
    $data['disabled'] = '';	
    
    $crops = new \Fmis\Models\MassTrappingParcelModel(); 
    $crops_data = $crops->modelList(['farmer_id' => session()->get('farmer_id'), 'mass_trapping_id' => $id]);
    $existing_crops_ids = array_column($crops_data, 'parcel_id');
    $parcels_data = $Parcel->getShortList(['farmer_id' => session()->get('farmer_id')]);
    foreach ($parcels_data as $parcel) {
      $parcel->mass_trapping_parcel_id = 0;
      if (in_array($parcel->id, $existing_crops_ids)) {
        // Find the matching crop data to get mass_trapping_parcel_id
        foreach ($crops_data as $crop) {
          if ($crop->parcel_id == $parcel->id) {
            $parcel->mass_trapping_parcel_id = $crop->mass_trapping_parcel_id;
            break;
          }
        }
      }
    }
    $data['crops'] = $parcels_data;
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('mass_trapping_id', $id);
    }
    return view('\Fmis\Views\Masstrapping\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $fi_selected = $postdata['fi_selected']; 
		unset($postdata['fi_selected']);
    $item = new \Fmis\Entities\MassTrappingEntity();
    $item->fill($postdata);
    $item->farmer_id = session()->get('farmer_id');
    if(session()->get('mass_trapping_id')){
      $item->id = session()->get('mass_trapping_id');
    }
    if($this->model->save($item)){
      $parcel = new \Fmis\Models\MassTrappingParcelModel();
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
      }
      else {
        $item_id = $item->id;
      }
        
      // Get existing parcel relationships for this mass trapping
      $existing_parcels = $parcel->where('mass_trapping_id', $item_id)->findAll();
      $existing_parcel_ids = array_column($existing_parcels, 'parcel_id');
      
      // Handle each selected parcel
      foreach($fi_selected as $val) {
          if (in_array($val, $existing_parcel_ids)) {
              // Update existing record
              $parcel->where(['mass_trapping_id' => $item_id, 'parcel_id' => $val])
                    ->set(['mass_trapping_id' => $item_id])
                    ->update();
          } else {
              // Insert new record
              $parcel->insert(['mass_trapping_id' => $item_id, 'parcel_id' => $val]);
          }
      }
      
      // Delete records for parcels that are no longer selected
      $parcels_to_delete = array_diff($existing_parcel_ids, $fi_selected);
      if (!empty($parcels_to_delete)) {
          $parcel->whereIn('parcel_id', $parcels_to_delete)
                ->where('mass_trapping_id', $item_id)
                ->delete();
      }
      
      return redirect()->to('fmis/mass-trapping/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }
  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Masstrapping\list');
  }

  public function createDirectiveFromParcel($parcel_id)
  {    
    // Initialize models
    $MassTrappingParcel = new \Fmis\Models\MassTrappingParcelModel();
    $Trap = new \Fmis\Models\TrapModel(); 
    
    // Get the parcel implementation
    $parcel_implementation = $MassTrappingParcel->find($parcel_id);
    
    if (!$parcel_implementation) {
      return redirect()->back()->with('error', 'Η καταγραφή μαζικής παγίδευσης δεν βρέθηκε.');
    }
    
    // Create new mass trapping entity
    $item = new \Fmis\Entities\MassTrappingEntity();
    
    // Copy relevant fields from parcel implementation
    $item->farmer_id = session()->get('farmer_id');
    $item->trap_id = $parcel_implementation->trap_id;
    $item->quantity = $parcel_implementation->quantity;

    // Set directive date 15 days before trapping date
    $item->dir_date = $parcel_implementation->trapping_date->modify('-15 days')->toLocalizedString('d/M/Y');
    
    // Save the new directive
    if ($this->model->save($item)) {
      $new_directive_id = $this->model->getInsertID();
      session()->set('mass_trapping_id', $new_directive_id);
      
      // Link the new directive to this parcel
      $parcel_item = new \Fmis\Entities\MassTrappingParcelEntity();
      $parcel_item->id = $parcel_id;
      $parcel_item->mass_trapping_id = $new_directive_id;
      $MassTrappingParcel->save($parcel_item);
      
      //Show the new directive so it can be modified
      return redirect()->to('fmis/mass-trapping/'.$new_directive_id)->with('message', 'Η οδηγία δημιουργήθηκε με επιτυχία και έχει αποθηκευθεί με βάση τα στοιχεία της καταγραφής.');
    }
    
    return redirect()->back()->with('error', 'Σφάλμα κατά τη δημιουργία της νέας συμβουλής μαζικής παγίδευσης.');
  }
}
