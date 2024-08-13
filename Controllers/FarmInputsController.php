<?php namespace Fmis\Controllers;

class FarmInputsController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\FarmInputsModel();
  }
  
  public function index()
  {    
    session()->remove('input_type');
    return view('\Fmis\Views\Farminputs\inputtype');
  }

  public function listFertilisers()
  {    
    session()->set('input_type', 1);
	$data['caption'] = lang('Fmis.farm_inputs_fertilisers');
    $data['rows'] = $this->model->listFertilisers(['farmer_id' => session()->get('farmer_id')]);
    return view('\Fmis\Views\Farminputs\list', $data);
  }

  public function listPpp()
  {    
    session()->set('input_type', 2);
	$data['caption'] = lang('Fmis.farm_inputs_ppp');
    $data['rows'] = $this->model->listPpp(['farmer_id' => session()->get('farmer_id')]);
    return view('\Fmis\Views\Farminputs\list', $data);
  }

  public function newItem()
  {    
    $Supplier = new \Fmis\Models\SupplierModel();
    $Input = new \Fmis\Models\InputModel();
	$UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
	
	if(session()->get('input_type') == 1){
		$data['caption'] = lang('Fmis.farm_inputs_fertilisers');
	}
	else {	
		$data['caption'] = lang('Fmis.farm_inputs_ppp');
	}
    $data['supplier'] = $Supplier->findAll(); 
	$data['input'] = $Input->where(['input_type' => session()->get('input_type')])->findAll(); 
	$data['unit_measurement'] = $UnitMeasurement->where(['practice' => 'input-output'])->findAll(); 
		
    
    session()->remove('farm_inputs_id');
    return view('\Fmis\Views\Farminputs\add', $data ?? array());
  }

  public function showItem($id)
  {    
    $Supplier = new \Fmis\Models\SupplierModel(); 
	$Input = new \Fmis\Models\InputModel(); 
	$UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
		
	if(session()->get('input_type') == 1){
		$data['caption'] = lang('Fmis.farm_inputs_fertilisers');
	}
	else {	
		$data['caption'] = lang('Fmis.farm_inputs_ppp');
	}
    $data['supplier'] = $Supplier->findAll(); 
	$data['input'] = $Input->where(['input_type' => session()->get('input_type')])->findAll(); 
	$data['unit_measurement'] = $UnitMeasurement->where(['practice' => 'input-output'])->findAll(); 
		
    
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('farm_inputs_id', $id);
    }
    return view('\Fmis\Views\Farminputs\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\FarmInputsEntity();
    $item->fill($postdata);
	$item->farmer_id = session()->get('farmer_id');
	$item->input_type = session()->get('input_type');
    if(session()->get('farm_inputs_id')){
      $item->id = session()->get('farm_inputs_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        
        
      }
      else {
        $item_id = $item->id;
        
        
        
      }
      
      return redirect()->to('fmis/farm-inputs/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
     return view('\Fmis\Views\Farminputs\list');
  }
  
  public function getOptions($type)
  {   
  
  }
}
