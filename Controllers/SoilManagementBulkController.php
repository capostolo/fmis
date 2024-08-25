<?php namespace Fmis\Controllers;

class SoilManagementBulkController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session', 'date']);
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
    return view('\Fmis\Views\Soilmanagementparcel\add_bulk', $data ?? array());
  }

  public function showItem($id)
  {    
    $SoilManagement = new \Fmis\Models\SoilManagementModel();
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
	$data['crops'] = $SoilManagement->parcelList(session()->get('farmer_id'), $id);
    $data['row'] = $SoilManagement->find($id);
    if($data['row']){
      session()->set('soil_management_id', $id);
    }
	$data['disabled'] = 'disabled';
    return view('\Fmis\Views\Soilmanagementparcel\update_bulk_dir', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();

    $SoilManagement = new \Fmis\Models\SoilManagementModel();
	$dirData = $SoilManagement->find(session()->get('soil_management_id'))->toArray();
	unset($dirData['id']);

    $SoilManagementParcel = new \Fmis\Models\SoilManagementParcelModel();
	$parcelData = $SoilManagementParcel->where('soil_management_id = '.session()->get('soil_management_id').' AND soil_management_date IS NULL')->findAll();

	foreach($parcelData As $p){
		$p->fill($dirData);
		$p->soil_management_date = randomDate($postdata['start_date'], $postdata['end_date']);
		if(!$SoilManagementParcel->save($p)){
			return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο ".$p->parcel_id);
		}
	}
	return redirect()->to('fmis/farmer/pending')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
   }

	public function saveBulk()
	{   
		$SoilManagementParcel = new \Fmis\Models\SoilManagementParcelModel();
		$Parcel = new \Fmis\Models\ParcelModel(); 
		$postdata = $this->request->getPost();
		$fi_selected = $postdata['fi_selected']; 
		unset($postdata['fi_selected']);
		$item = new \Fmis\Entities\SoilManagementParcelEntity();
		$item->fill($postdata);
		foreach($fi_selected As $key => $val){
			$item->parcel_id = $val;
			$item->soil_management_date = randomDate($postdata['start_date'], $postdata['end_date']);
			$parcel_data = $Parcel->find($item->parcel_id);
			if(!$SoilManagementParcel->save($item)){
				return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο ".$parcel_data->code);
			}
		}		
		return redirect()->to('fmis/farmer/pending')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
	}

}
