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
		
    $data['fertiliser'] = $Fertiliser->findAll(); 
		$data['unit_measurement'] = $UnitMeasurement->where('id = 1 OR id = 2')->findAll(); 
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
		
    $data['fertiliser'] = $Fertiliser->findAll(); 
		$data['unit_measurement'] = $UnitMeasurement->where('id = 1 OR id = 2')->findAll(); 
		$data['fertiliser_application'] = $FertiliserApplication->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
		$data['fertilise_equipment'] = $FertiliseEquipment->findAll(); 
		$data['specialised_fertiliser'] = $SpecialisedFertiliser->findAll(); 
		
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('fertilisation_parcel_id', $id);
      $dirData = $Fertilisation->find($data['row']->fertilisation_id);
      if($dirData && !$data['row']->fertilisation_date){
        $data['directive'] = $dirData;
        session()->set('message', 'Προσοχή! Τα στοιχεία έχουν προσυμπληρωθεί με βάση την υφιστάμενη συμβουλή λίπανσης.');
      }
    }
    return view('\Fmis\Views\Fertilisationparcel\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $item = new \Fmis\Entities\FertilisationParcelEntity();
    $item->fill($postdata);
    $item->parcel_id = session()->get('parcel_id');
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
     return view('\Fmis\Views\Fertilisationparcel\list');
  }
}
