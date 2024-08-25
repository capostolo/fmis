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
		
    $data['fertiliser'] = $Fertiliser->findAll(); 
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
		
    $data['fertiliser'] = $Fertiliser->findAll(); 
	$data['unit_measurement'] = $UnitMeasurement->where(['practice' => 'fertilisation'])->findAll(); 
	$data['fertiliser_application'] = $FertiliserApplication->findAll(); 
	$data['farming_stage'] = $FarmingStage->findAll(); 
	$data['fertilise_equipment'] = $FertiliseEquipment->findAll(); 
	$data['specialised_fertiliser'] = $SpecialisedFertiliser->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
	$data['crops'] = $this->model->parcelList(session()->get('farmer_id'), $id);
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
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        $parcel = new \Fmis\Models\FertilisationParcelModel();
        foreach($fi_selected As $key => $val){ 
		      $parcel->insert(array('fertilisation_id' => $item_id, 'parcel_id' => $val)); 
		    }
      }
      else {
        $item_id = $item->id;
        $parcel = new \Fmis\Models\FertilisationParcelModel();
        $parcel->where('fertilisation_id', $item_id)->delete();
        foreach($fi_selected As $key => $val){ 
		      $parcel->insert(array('fertilisation_id' => $item_id, 'parcel_id' => $val)); 
		    }
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
}
