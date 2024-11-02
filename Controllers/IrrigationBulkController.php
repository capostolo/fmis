<?php namespace Fmis\Controllers;

class IrrigationBulkController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session', 'date']);
  }
 
  public function newItem()
  {    
    $UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
	$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
	$IrrigationEquipment = new \Fmis\Models\IrrigationEquipmentModel(); 
		
    $data['unit_measurement'] = $UnitMeasurement->where(['practice' => 'irrigation'])->findAll(); 
	$data['farming_stage'] = $FarmingStage->findAll(); 
	$data['irrigation_equipment'] = $IrrigationEquipment->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
	$data['crops'] = $crops->getShortList(['farmer_id' => session()->get('farmer_id')]);
    session()->remove('irrigation_id');
    return view('\Fmis\Views\Irrigationparcel\add_bulk', $data ?? array());
  } 
  public function newGlobalItem()
  {
    $UnitMeasurement = new \Fmis\Models\UnitMeasurementModel();
    $FarmingStage = new \Fmis\Models\FarmingStageModel();
    $IrrigationEquipment = new \Fmis\Models\IrrigationEquipmentModel();
    $ParamCatso = new \Fmis\Models\ParamCatsoModel();

    $data['unit_measurement'] = $UnitMeasurement->where(['practice' => 'irrigation'])->findAll();
    $data['farming_stage'] = $FarmingStage->findAll();
    $data['irrigation_equipment'] = $IrrigationEquipment->findAll();
    $data['cultivation_codes'] = $ParamCatso->findAll();

    session()->remove('irrigation_id');
    return view('\Fmis\Views\Irrigationparcel\add_global', $data ?? array());
  }

  public function showItem($id)
  {    
    $Irrigation = new \Fmis\Models\IrrigationModel();
    $UnitMeasurement = new \Fmis\Models\UnitMeasurementModel(); 
	$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
	$IrrigationEquipment = new \Fmis\Models\IrrigationEquipmentModel(); 
		
    $data['unit_measurement'] = $UnitMeasurement->where(['practice' => 'irrigation'])->findAll();
	$data['farming_stage'] = $FarmingStage->findAll(); 
	$data['irrigation_equipment'] = $IrrigationEquipment->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
	$data['crops'] = $Irrigation->parcelList(session()->get('farmer_id'), $id);
    $data['row'] = $Irrigation->find($id);
    if($data['row']){
      session()->set('irrigation_id', $id);
    }
	$data['disabled'] = 'disabled';
    return view('\Fmis\Views\Irrigationparcel\update_bulk_dir', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();

    $Irrigation = new \Fmis\Models\IrrigationModel();
	$dirData = $Irrigation->find(session()->get('irrigation_id'))->toArray();
	unset($dirData['id']);

    $IrrigationParcel = new \Fmis\Models\IrrigationParcelModel();
	$parcelData = $IrrigationParcel->where('irrigation_id = '.session()->get('irrigation_id').' AND irrigation_date IS NULL')->findAll();

	foreach($parcelData As $p){
		$p->fill($dirData);
		$p->irrigation_date = randomDate($postdata['start_date'], $postdata['end_date']);
		if(!$IrrigationParcel->save($p)){
			return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο ".$p->parcel_id);
		}
	}
	return redirect()->to('fmis/farmer')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
   }

	public function saveBulk()
	{   
		$IrrigationParcel = new \Fmis\Models\IrrigationParcelModel();
		$Parcel = new \Fmis\Models\ParcelModel(); 
		$postdata = $this->request->getPost();
		$fi_selected = $postdata['fi_selected']; 
		unset($postdata['fi_selected']);
		$item = new \Fmis\Entities\IrrigationParcelEntity();
		$item->fill($postdata);
		foreach($fi_selected As $key => $val){
			$item->parcel_id = $val;
			$item->irrigation_date = randomDate($postdata['start_date'], $postdata['end_date']);
			$parcel_data = $Parcel->find($item->parcel_id);
			if(!$IrrigationParcel->save($item)){
				return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο ".$parcel_data->code);
			}
		}		
		return redirect()->to('fmis/farmer')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
	}

	public function saveGlobal()
	{   
    	$Irrigation = new \Fmis\Models\IrrigationModel();
		$IrrigationParcel = new \Fmis\Models\IrrigationParcelModel();
		$Parcel = new \Fmis\Models\ParcelModel();
		$postdata = $this->request->getPost();
		$where = ['advisor_id' => user_id(), 'cultivation_code' => $postdata['cultivation_code']];
		$farmer_id = '';

		// If cultivar_code is provided, further filter the parcels
		if (!empty($postdata['cultivar_code'])) {
			$where['cultivar_code'] = $postdata['cultivar_code'];
		}

		$parcels = $Parcel->getByAdvisor($where);

		foreach ($parcels as $parcel) {
			$item = new \Fmis\Entities\IrrigationEntity();
			$item->fill($postdata);
			$item->dir_date = randomDirDate($postdata['start_date']);
			if ($farmer_id != $parcel->farmer_id){
				$farmer_id = $parcel->farmer_id;
				$item->farmer_id = $farmer_id;
				if (!$Irrigation->insert($item)) {
					return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταχώριση της συμβουλής.");
				}
				else {
					$irrigation_id = $Irrigation->insertID();
				}
			}
			$item = new \Fmis\Entities\IrrigationParcelEntity();
			$item->fill($postdata);
			$item->parcel_id = $parcel->id;
			$item->irrigation_date = randomDate($postdata['start_date'], $postdata['end_date']);
			$item->irrigation_id = $irrigation_id;

			if (!$IrrigationParcel->save($item)) {
				return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο " . $parcel->code);
			}
		}

    	return redirect()->to('fmis/farmer')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
	}

}
