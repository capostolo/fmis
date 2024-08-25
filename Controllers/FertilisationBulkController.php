<?php namespace Fmis\Controllers;

class FertilisationBulkController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session', 'date']);
  }
  
  public function newItem()
  {    
    $Fertiliser = new \Fmis\Models\FertiliserModel(); 
	$UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
	$FertiliserApplication = new \Fmis\Models\FertiliserApplicationModel(); 
	$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
	$FertiliseEquipment = new \Fmis\Models\FertiliseEquipmentModel(); 
	$SpecialisedFertiliser = new \Fmis\Models\SpecialisedFertiliserModel(); 
		
    $data['fertiliser'] = $Fertiliser->findAll(); 
	$data['unit_measurement'] = $UnitMeasurement->where(['practice' => 'fertilisation'])->findAll(); 
	$data['fertiliser_application'] = $FertiliserApplication->findAll(); 
	$data['farming_stage'] = $FarmingStage->findAll(); 
	$data['fertilise_equipment'] = $FertiliseEquipment->findAll(); 
	$data['specialised_fertiliser'] = $SpecialisedFertiliser->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
	$data['crops'] = $crops->getShortList(['farmer_id' => session()->get('farmer_id')]);
    session()->remove('fertilisation_id');
    return view('\Fmis\Views\FertilisationParcel\add_bulk', $data ?? array());
  }

  public function showItem($id)
  {    
	$Fertiliser = new \Fmis\Models\FertiliserModel(); 
	$UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
	$FertiliserApplication = new \Fmis\Models\FertiliserApplicationModel(); 
	$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
	$FertiliseEquipment = new \Fmis\Models\FertiliseEquipmentModel(); 
	$SpecialisedFertiliser = new \Fmis\Models\SpecialisedFertiliserModel(); 
    $Fertilisation = new \Fmis\Models\FertilisationModel();
		
    $data['fertiliser'] = $Fertiliser->findAll(); 
	$data['unit_measurement'] = $UnitMeasurement->where(['practice' => 'fertilisation'])->findAll(); 
	$data['fertiliser_application'] = $FertiliserApplication->findAll(); 
	$data['farming_stage'] = $FarmingStage->findAll(); 
	$data['fertilise_equipment'] = $FertiliseEquipment->findAll(); 
	$data['specialised_fertiliser'] = $SpecialisedFertiliser->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
	$data['crops'] = $Fertilisation->parcelList(session()->get('farmer_id'), $id);
    $data['row'] = $Fertilisation->find($id);
    if($data['row']){
      session()->set('fertilisation_id', $id);
    }
	$data['disabled'] = 'disabled';
    return view('\Fmis\Views\FertilisationParcel\update_bulk_dir', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();

    $Fertilisation = new \Fmis\Models\FertilisationModel();
	$dirData = $Fertilisation->find(session()->get('fertilisation_id'))->toArray();
	unset($dirData['id']);

    $FertilisationParcel = new \Fmis\Models\FertilisationParcelModel();
	$parcelData = $FertilisationParcel->where('fertilisation_id = '.session()->get('fertilisation_id').' AND fertilisation_date IS NULL')->findAll();

    $Parcel = new \Fmis\Models\ParcelModel(); 
	
	foreach($parcelData As $p){
		$p->fill($dirData);
		$p->fertilisation_date = randomDate($postdata['start_date'], $postdata['end_date']);
		$p->quantity_description = $dirData['quantity'];
		$parcel_data = $Parcel->find($p->parcel_id);
		if($p->unit_measurement_id == 1 || $p->unit_measurement_id == 3){
			$p->total_quantity = $p->quantity_description * ($parcel_data->trees_number_ge4_years + $parcel_data->trees_number_l4_years);
		}
		else if($p->unit_measurement_id == 2){
			$p->total_quantity = $p->quantity_description * $parcel_data->total_area * 10;
		}
		else if($p->unit_measurement_id == 4){
			$p->total_quantity = $p->quantity_description * $postdata['parcel_quantity'] / 100;
		}
		if(!$FertilisationParcel->save($p)){
			return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο ".$parcel_data->code);
		}
	}
	return redirect()->to('fmis/farmer/pending')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
   }

	public function saveBulk()
	{   
		$FertilisationParcel = new \Fmis\Models\FertilisationParcelModel();
		$Parcel = new \Fmis\Models\ParcelModel(); 
		$postdata = $this->request->getPost();
		$fi_selected = $postdata['fi_selected']; 
		unset($postdata['fi_selected']);
		$item = new \Fmis\Entities\FertilisationParcelEntity();
		$item->fill($postdata);
		foreach($fi_selected As $key => $val){
			$item->parcel_id = $val;
			$item->fertilisation_date = randomDate($postdata['start_date'], $postdata['end_date']);
			$parcel_data = $Parcel->find($item->parcel_id);
			if($item->unit_measurement_id == 1 || $p->unit_measurement_id == 3){
				$item->total_quantity = $item->quantity_description * ($parcel_data->trees_number_ge4_years + $parcel_data->trees_number_l4_years);
			}
			else if($item->unit_measurement_id == 2){
				$item->total_quantity = $item->quantity_description * $parcel_data->total_area * 10;
			}
			else if($item->unit_measurement_id == 4){
				$item->total_quantity = $item->quantity_description * $postdata['parcel_quantity'] / 100;
			}
			if(!$FertilisationParcel->save($item)){
				return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο ".$parcel_data->code);
			}
		}		
		return redirect()->to('fmis/farmer/pending')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
	}
  
}
