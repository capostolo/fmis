<?php namespace Fmis\Controllers;

class PruningBulkController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session', 'date']);
  }
 
  public function newItem()
  {    
    $PruningType = new \Fmis\Models\PruningTypeModel(); 
	$PruningEquipment = new \Fmis\Models\PruningEquipmentModel(); 
	$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		
    $data['pruning_type'] = $PruningType->findAll(); 
	$data['pruning_equipment'] = $PruningEquipment->findAll(); 
	$data['farming_stage'] = $FarmingStage->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
	$data['crops'] = $crops->getShortList(['farmer_id' => session()->get('farmer_id')]);
    session()->remove('pruning_id');
    return view('\Fmis\Views\Pruningparcel\add_bulk', $data ?? array());
  }
 
  public function newGlobalItem()
  {
    $PruningType = new \Fmis\Models\PruningTypeModel();
    $PruningEquipment = new \Fmis\Models\PruningEquipmentModel();
    $FarmingStage = new \Fmis\Models\FarmingStageModel();
    $ParamCatso = new \Fmis\Models\ParamCatsoModel();

    $data['pruning_type'] = $PruningType->findAll();
    $data['pruning_equipment'] = $PruningEquipment->findAll();
    $data['farming_stage'] = $FarmingStage->findAll();
    $data['cultivation_codes'] = $ParamCatso->findAll();

    session()->remove('pruning_id');
    return view('\Fmis\Views\Pruningparcel\add_global', $data ?? array());
  }

  public function showItem($id)
  {    
    $Pruning = new \Fmis\Models\PruningModel();
    $PruningType = new \Fmis\Models\PruningTypeModel(); 
	$PruningEquipment = new \Fmis\Models\PruningEquipmentModel(); 
	$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		
    $data['pruning_type'] = $PruningType->findAll(); 
	$data['pruning_equipment'] = $PruningEquipment->findAll(); 
	$data['farming_stage'] = $FarmingStage->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
	$data['crops'] = $Pruning->parcelList(session()->get('farmer_id'), $id);
    $data['row'] = $Pruning->find($id);
    if($data['row']){
      session()->set('pruning_id', $id);
    }
	$data['disabled'] = 'disabled';
    return view('\Fmis\Views\Pruningparcel\update_bulk_dir', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();

    $Pruning = new \Fmis\Models\PruningModel();
	$dirData = $Pruning->find(session()->get('pruning_id'))->toArray();
	unset($dirData['id']);

    $PruningParcel = new \Fmis\Models\PruningParcelModel();
	$parcelData = $PruningParcel->where('pruning_id = '.session()->get('pruning_id').' AND pruning_date IS NULL')->findAll();

	foreach($parcelData As $p){
		$p->fill($dirData);
		$p->pruning_date = randomDate($postdata['start_date'], $postdata['end_date']);
		if(!$PruningParcel->save($p)){
			return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο ".$p->parcel_id);
		}
	}
	return redirect()->to('fmis/farmer')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
   }

	public function saveBulk()
	{   
		$PruningParcel = new \Fmis\Models\PruningParcelModel();
		$Parcel = new \Fmis\Models\ParcelModel(); 
		$postdata = $this->request->getPost();
		$fi_selected = $postdata['fi_selected']; 
		unset($postdata['fi_selected']);
		$item = new \Fmis\Entities\PruningParcelEntity();
		$item->fill($postdata);
		foreach($fi_selected As $key => $val){
			$item->parcel_id = $val;
			$item->pruning_date = randomDate($postdata['start_date'], $postdata['end_date']);
			$parcel_data = $Parcel->find($item->parcel_id);
			if(!$PruningParcel->save($item)){
				return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο ".$parcel_data->code);
			}
		}		
		return redirect()->to('fmis/farmer')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
	}

	public function saveGlobal()
	{
	    $Pruning = new \Fmis\Models\PruningModel();
		$PruningParcel = new \Fmis\Models\PruningParcelModel();
		$Parcel = new \Fmis\Models\ParcelModel();
		$postdata = $this->request->getPost();
		$farmer_id = '';
		
		$where = ['advisor_id' => user_id(), 'cultivation_code' => $postdata['cultivation_code']];
		// If cultivar_code is provided, further filter the parcels
		if (!empty($postdata['cultivar_code'])) {
			$where['cultivar_code'] = $postdata['cultivar_code'];
		}

		$parcels = $Parcel->getByAdvisor($where);

		foreach ($parcels as $parcel) {
			$item = new \Fmis\Entities\PruningEntity();
			$item->fill($postdata);
			$item->dir_date = randomDirDate($postdata['start_date']);
			if ($farmer_id != $parcel->farmer_id){
				$farmer_id = $parcel->farmer_id;
				$item->farmer_id = $farmer_id;
				if (!$Pruning->insert($item)) {
					return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταχώριση της συμβουλής.");
				}
				else {
					$pruning_id = $Pruning->insertID();
				}
			}
			$item = new \Fmis\Entities\PruningParcelEntity();
			$item->fill($postdata);
			$item->parcel_id = $parcel->id;
			$item->pruning_date = randomDate($postdata['start_date'], $postdata['end_date']);
			$item->pruning_id = $pruning_id;

			if (!$PruningParcel->save($item)) {
				return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο " . $parcel->code);
			}
		}

		return redirect()->to('fmis/farmer')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
	}

}
