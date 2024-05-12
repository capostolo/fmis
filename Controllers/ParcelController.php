<?php namespace Fmis\Controllers;

class ParcelController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session', 'calculations']);
    $this->model = new \Fmis\Models\ParcelModel();
	  $this->user = auth()->user();
  }
  

  public function showItem($id)
  {
    //$data['crops'] = $this->model->where(['parcel_id' => $id]);
    $data['row'] = $this->model->getParcel(['id' => $id]);
    $data['nutrients'] = calcNutrientBalance($id);
    $data['actives'] = $this->model->getActives(['parcel_id' => $id]);
    $data['calendar'] = $this->model->getCalendar(['parcel_id' => $id]);
    $data['calendaranalysis'] = $this->model->getCalendarAnalysis(['parcel_id' => $id]);
    if($data['row']){
      session()->set('parcel_id', $id);
    }
    return view('\Fmis\Views\Parcel\update', $data);
    
  }
}
