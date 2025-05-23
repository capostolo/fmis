<?php namespace Fmis\Controllers;

class FertilisationParcelController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\FertilisationParcelModel();
  }
  
  public function index()
  {    
    if(session()->get('parcel_id')){
      $data['rows'] = $this->model->modelList(['parcel_id' => session()->get('parcel_id')]);
      return view('\Fmis\Views\Fertilisationparcel\list', $data);
    }
    return redirect()->back()->withInput()->with('error', "Παρακαλώ επιλέξτε αγροτεμάχιο!");
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
		
    
    session()->remove('fertilisation_parcel_id');
    return view('\Fmis\Views\Fertilisationparcel\add', $data ?? array());
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
		
    $data['fertiliser'] = $Fertiliser->modelList(); 
	$data['unit_measurement'] = $UnitMeasurement->where(['practice' => 'fertilisation'])->findAll(); 
	$data['fertiliser_application'] = $FertiliserApplication->findAll(); 
	$data['farming_stage'] = $FarmingStage->findAll(); 
	$data['fertilise_equipment'] = $FertiliseEquipment->findAll(); 
	$data['specialised_fertiliser'] = $SpecialisedFertiliser->findAll(); 
		
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('fertilisation_parcel_id', $id);
      if($data['row']->fertilisation_id){
        $dirData = $Fertilisation->find($data['row']->fertilisation_id);
        $data['directive'] = new \Fmis\Entities\FertilisationParcelEntity();
        if($dirData){ 
          $data['directive']->fill($dirData->toArray());
          if (!$data['row']->fertilisation_date){
            session()->set('message', 'Προσοχή! Τα στοιχεία έχουν προσυμπληρωθεί με βάση την υφιστάμενη συμβουλή λίπανσης.');
          }
        }
      }
    }
    return view('\Fmis\Views\Fertilisationparcel\update', $data);
  }

  public function saveItem()
  {   
    $Parcel = new \Fmis\Models\ParcelModel(); 
	$postdata = $this->request->getPost();
    $item = new \Fmis\Entities\FertilisationParcelEntity();
    $item->fill($postdata);
    $item->parcel_id = session()->get('parcel_id');
	$parcel_data = $Parcel->find($item->parcel_id);
	if($item->unit_measurement_id == 1 || $item->unit_measurement_id == 3){
		$item->total_quantity = $item->quantity_description * ($parcel_data->trees_number_ge4_years + $parcel_data->trees_number_l4_years);
	}
	else if($item->unit_measurement_id == 2){
		$item->total_quantity = $item->item_quantity_description * $parcel_data->total_area * 10;
	}
	else if($item->unit_measurement_id == 4){
		$item->total_quantity = $item->item_quantity_description * $item->parcel_quantity / 100;
	}
    if(session()->get('fertilisation_parcel_id')){
      $item->id = session()->get('fertilisation_parcel_id');
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
    if(!$item_data->fertilisation_id){
      $this->model->delete($item_id);
    }
    else {
      $item = new \Fmis\Entities\FertilisationParcelEntity();
      $item->id = $item_id;
      $item->fertilisation_date = null;
      $item->fertiliser_id = null;
      $item->quantity_description = null;
      $item->unit_measurement_id = null;
      $item->parcel_quantity = null;
      $item->fertiliser_application_id = null;
      $item->farming_stage_id = null;
      $item->fertilise_equipment_id = null;
      $item->specialised_fertiliser_id = null;
      $item->total_quantity = null;
      $item->carbon_footprint = null; 
      $this->model->save($item);
    }
    return $this->response->setJSON([
      'status' => 'success',
      'message' => 'Η διαγραφή ολοκληρώθηκε με επιτυχία'
    ]);
  }

  public function createDirective($id)
  {    
    $Fertilisation = new \Fmis\Controllers\FertilisationController();
    return $Fertilisation->createDirectiveFromParcel($id);
  }
}
