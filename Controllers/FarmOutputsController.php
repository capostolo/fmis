<?php namespace Fmis\Controllers;

class FarmOutputsController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\FarmOutputsModel();
  }
  
  public function index()
  {    
    if(session()->get('farm_outputs_where')){
      $data['rows'] = $this->model->modelList(['farm_outputs_where' => session()->get('farm_outputs_where')]);
    }
    else{
      $data['rows'] = $this->model->modelList(['farmer_id' => session()->get('farmer_id')]);
    }
    return view('\Fmis\Views\Farmoutputs\list', $data);
  }

  public function newItem()
  {    
    $Buyer = new \Fmis\Models\BuyerModel(); 
		$UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
		
    $data['buyer'] = $Buyer->findAll(); 
		$data['unit_measurement'] = $UnitMeasurement->findAll(); 
		
    
    session()->remove('farm_outputs_id');
    return view('\Fmis\Views\Farmoutputs\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $Buyer = new \Fmis\Models\BuyerModel(); 
		$UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
		
    $data['buyer'] = $Buyer->findAll(); 
		$data['unit_measurement'] = $UnitMeasurement->findAll(); 
		
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('farm_outputs_id', $id);
    }
    return view('\Fmis\Views\Farmoutputs\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\FarmOutputsEntity();
    $item->fill($postdata);
    $item->farmer_id = session()->get('farmer_id');
    if(session()->get('farm_outputs_id')){
      $item->id = session()->get('farm_outputs_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        
        
      }
      else {
        $item_id = $item->id;
        
        
        
      }
      
      return redirect()->to('fmis/farm-outputs/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Farmoutputs\list');
  }
}
