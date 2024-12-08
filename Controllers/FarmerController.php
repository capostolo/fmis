<?php namespace Fmis\Controllers;

class FarmerController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\FarmerModel();
	$this->user = auth()->user();
  }
  
  public function index()
  { 
    session()->remove('farmer_id');
    session()->remove('farmer_name');
    session()->remove('farmer_afm');
    session()->remove('farmer_fathername');
    session()->remove('advisor_id');
    if (session('magicLogin')) {
      return redirect()->route('change-password')->with('message', lang('Auth.forceChangePassword'));
    }
	  $data['advisor'] = false;
    if ($this->user->inGroup('admin')) {
      $data['rows'] = $this->model->getList();
	  $data['advisor'] = true;
      return view('\Fmis\Views\Farmer\list', $data);
    }
    else if ($this->user->inGroup('advisor')){
      $data['rows'] = $this->model->where('advisor_id', user_id())->findAll();
      return view('\Fmis\Views\Farmer\list', $data);
    }
    else if ($this->user->inGroup('user')){
      $farmer = $this->model->where('user_id', user_id())->first();
      if($farmer){
        return redirect()->to('fmis/farmer/'.$farmer->id);
      }
      else {
        return view('\Fmis\Views\Farmer\nodata');
      }
    }
    else {
      return view('\Fmis\Views\Farmer\nogroup');
    }
  }

  public function newItem()
  {
    return view('\Fmis\Views\Farmer\add');
  }
  
  public function showItem($id)
  {
    $crops = new \Fmis\Models\ParcelModel(); 
    $data['crops'] = $crops->getCropList(['farmer_id' => $id]);
    $data['farmer'] = false;
    if ($this->user->inGroup('user')){
      $data['farmer'] = true;
    }
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('farmer_id', $id);
      session()->set('farmer_name', $data['row']->farmer_firstname.' '.$data['row']->farmer_lastname);
      session()->set('farmer_afm', $data['row']->farmer_afm);
      session()->set('farmer_fathername', $data['row']->farmer_fathername);
      session()->set('advisor_id', $data['row']->advisor_id);
    }
    return view('\Fmis\Views\Farmer\update', $data);
    
  }
  
  public function showPendingDir()
  {
	$data['rows'] = $this->model->getPendingDir(['farmer_id' => session()->get('farmer_id')]);
    return view('\Fmis\Views\Farmer\pending', $data);
  }
}
