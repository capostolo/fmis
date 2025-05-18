<?php namespace Fmis\Controllers;

class ParcelController extends BaseController
{
  protected $model;
  protected $user;
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
  
  public function getPhoto()
  {
    $image = WRITEPATH.'uploads/effects.jpg';
	$exif = exif_read_data($image, 0, true);
	var_dump($exif);
    if($exif && isset($exif['GPS'])){
        $GPSLatitudeRef = $exif['GPS']['GPSLatitudeRef'];
        $GPSLatitude    = $exif['GPS']['GPSLatitude'];
        $GPSLongitudeRef= $exif['GPS']['GPSLongitudeRef'];
        $GPSLongitude   = $exif['GPS']['GPSLongitude'];
        
        $lat_degrees = count($GPSLatitude) > 0 ? $this->gps2Num($GPSLatitude[0]) : 0;
        $lat_minutes = count($GPSLatitude) > 1 ? $this->gps2Num($GPSLatitude[1]) : 0;
        $lat_seconds = count($GPSLatitude) > 2 ? $this->gps2Num($GPSLatitude[2]) : 0;
        
        $lon_degrees = count($GPSLongitude) > 0 ? $this->gps2Num($GPSLongitude[0]) : 0;
        $lon_minutes = count($GPSLongitude) > 1 ? $this->gps2Num($GPSLongitude[1]) : 0;
        $lon_seconds = count($GPSLongitude) > 2 ? $this->gps2Num($GPSLongitude[2]) : 0;
        
        $lat_direction = ($GPSLatitudeRef == 'W' or $GPSLatitudeRef == 'S') ? -1 : 1;
        $lon_direction = ($GPSLongitudeRef == 'W' or $GPSLongitudeRef == 'S') ? -1 : 1;
        
        $latitude = $lat_direction * ($lat_degrees + ($lat_minutes / 60) + ($lat_seconds / (60*60)));
        $longitude = $lon_direction * ($lon_degrees + ($lon_minutes / 60) + ($lon_seconds / (60*60)));
		echo "info:";
        var_dump(array('latitude'=>$latitude, 'longitude'=>$longitude));
    }else{
        echo false;
    }
  }
  
private function gps2Num($coordPart){
    $parts = explode('/', $coordPart);
    if(count($parts) <= 0)
    return 0;
    if(count($parts) == 1)
    return $parts[0];
    return floatval($parts[0]) / floatval($parts[1]);
}	
  
  
}
