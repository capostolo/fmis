<?php namespace Fmis\Controllers;

class MassTrappingParcelController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\MassTrappingParcelModel();
  }
  
  public function index()
  {    
    if(session()->get('parcel_id')){
      $data['rows'] = $this->model->modelList(['parcel_id' => session()->get('parcel_id')]);
      return view('\Fmis\Views\Masstrappingparcel\list', $data);
    }
    return redirect()->back()->withInput()->with('error', "Παρακαλώ επιλέξτε αγροτεμάχιο!");
  }

  public function newItem()
  {    
    $Trap = new \Fmis\Models\TrapModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
    $data['trap'] = $Trap->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
    session()->remove('mass_trapping_parcel_id');
    return view('\Fmis\Views\Masstrappingparcel\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $Trap = new \Fmis\Models\TrapModel(); 
		$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
    $MassTrapping = new \Fmis\Models\MassTrappingModel();
    $data['trap'] = $Trap->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('mass_trapping_parcel_id', $id);
      $dirData = $MassTrapping->find($data['row']->mass_trapping_id);
      if($dirData){ 
        $data['directive'] = $dirData;
		if (!$data['row']->mass_trapping_date){
			session()->set('message', 'Προσοχή! Τα στοιχεία έχουν προσυμπληρωθεί με βάση την υφιστάμενη συμβουλή μαζικής παγίδευσης.');
		}
      }
    }
    return view('\Fmis\Views\Masstrappingparcel\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    $item = new \Fmis\Entities\MassTrappingParcelEntity();
    $item->fill($postdata);
    $item->parcel_id = session()->get('parcel_id');
    if(session()->get('mass_trapping_parcel_id')){
      $item->id = session()->get('mass_trapping_parcel_id');
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
    
    if(!$item_data->mass_trapping_id){
        $this->model->delete($item_id);
    } else {
        $item = new \Fmis\Entities\MassTrappingParcelEntity();
        $item->id = $item_id;
        $item->mass_trapping_date = null;
        $item->trap_id = null;
        $item->traps_hectare = null;
        $item->farming_stage_id = null;
        $item->carbon_footprint = null;
        $this->model->save($item);
    }

    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'Η διαγραφή ολοκληρώθηκε με επιτυχία'
    ]);
  }
}
