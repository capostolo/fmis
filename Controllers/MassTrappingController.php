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
		
    $data['trap'] = $Trap->findAll(); 
		$data['farming_stage'] = $FarmingStage->findAll(); 
	$data['disabled'] = '';	
		
    $crops = new \Fmis\Models\ParcelModel(); 
		$data['crops'] = $this->model->parcelList(session()->get('farmer_id'), $id);
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
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        $parcel = new \Fmis\Models\MassTrappingParcelModel();
        foreach($fi_selected As $key => $val){ 
         $parcel->insert(array('mass_trapping_id' => $item_id, 'parcel_id' => $val)); 
       }
      }
      else {
        $item_id = $item->id;
        $parcel = new \Fmis\Models\MassTrappingParcelModel();
        $parcel->where('mass_trapping_id', $item_id)->delete();
        foreach($fi_selected As $key => $val){ 
         $parcel->insert(array('mass_trapping_id' => $item_id, 'parcel_id' => $val)); 
        }
      }
      return redirect()->to('fmis/farmer/'.session()->get('farmer_id'))->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Masstrapping\list');
  }
}
