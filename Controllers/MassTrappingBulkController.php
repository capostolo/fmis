<?php namespace Fmis\Controllers;

class MassTrappingBulkController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session', 'date']);
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
    return view('\Fmis\Views\Masstrappingparcel\add_bulk', $data ?? array());
  } 
  public function newGlobalItem()
  {
    $Trap = new \Fmis\Models\TrapModel();
    $FarmingStage = new \Fmis\Models\FarmingStageModel();
    $ParamCatso = new \Fmis\Models\ParamCatSoModel();

    $data['trap'] = $Trap->findAll();
    $data['farming_stage'] = $FarmingStage->findAll();
    $data['cultivation_codes'] = $ParamCatso->findAll();

    session()->remove('mass_trapping_id');
    return view('\Fmis\Views\Masstrappingparcel\add_global', $data ?? array());
  }

  public function showItem($id)
  {    
    $MassTrapping = new \Fmis\Models\MassTrappingModel();
    $Trap = new \Fmis\Models\TrapModel(); 
	$FarmingStage = new \Fmis\Models\FarmingStageModel(); 
		
    $data['trap'] = $Trap->findAll(); 
	$data['farming_stage'] = $FarmingStage->findAll(); 
		
    $crops = new \Fmis\Models\ParcelModel(); 
	$data['crops'] = $MassTrapping->parcelList(session()->get('farmer_id'), $id);
    $data['row'] = $MassTrapping->find($id);
    if($data['row']){
      session()->set('mass_trapping_id', $id);
    }
	$data['disabled'] = 'disabled';
    return view('\Fmis\Views\Masstrappingparcel\update_bulk_dir', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();

    $MassTrapping = new \Fmis\Models\MassTrappingModel();
	$dirData = $MassTrapping->find(session()->get('mass_trapping_id'))->toArray();
	unset($dirData['id']);

    $MassTrappingParcel = new \Fmis\Models\MassTrappingParcelModel();
	$parcelData = $MassTrappingParcel->where('mass_trapping_id = '.session()->get('mass_trapping_id').' AND mass_trapping_date IS NULL')->findAll();

	foreach($parcelData As $p){
		$p->fill($dirData);
		$p->mass_trapping_date = randomDate($postdata['start_date'], $postdata['end_date']);
		if(!$MassTrappingParcel->save($p)){
			return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο ".$p->parcel_id);
		}
	}
	return redirect()->to('fmis/farmer/pending')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
   }

	public function saveBulk()
	{   
		$MassTrappingParcel = new \Fmis\Models\MassTrappingParcelModel();
		$Parcel = new \Fmis\Models\ParcelModel(); 
		$postdata = $this->request->getPost();
		$fi_selected = $postdata['fi_selected']; 
		unset($postdata['fi_selected']);
		$item = new \Fmis\Entities\MassTrappingParcelEntity();
		$item->fill($postdata);
		foreach($fi_selected As $key => $val){
			$item->parcel_id = $val;
			$item->mass_trapping_date = randomDate($postdata['start_date'], $postdata['end_date']);
			$parcel_data = $Parcel->find($item->parcel_id);
			if(!$MassTrappingParcel->save($item)){
				return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο ".$parcel_data->code);
			}
		}		
		return redirect()->to('fmis/farmer/pending')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
	}
	
	public function saveGlobal()
	{
		$MassTrappingParcel = new \Fmis\Models\MassTrappingParcelModel();
		$Parcel = new \Fmis\Models\ParcelModel();
		$postdata = $this->request->getPost();
		$where = ['advisor_id' => user_id(), 'cultivation_code' => $postdata['cultivation_code']];

		// If cultivar_code is provided, further filter the parcels
		if (!empty($postdata['cultivar_code'])) {
			$where['cultivar_code'] = $postdata['cultivar_code'];
		}

		$parcels = $Parcel->getByAdvisor($where);

		foreach ($parcels as $parcel) {
			$item = new \Fmis\Entities\MassTrappingParcelEntity();
			$item->fill($postdata);
			$item->parcel_id = $parcel->id;
			$item->mass_trapping_date = randomDate($postdata['start_date'], $postdata['end_date']);

			if (!$MassTrappingParcel->save($item)) {
				return redirect()->back()->withInput()->with('error', "Σφάλμα κατά την καταγραφή για το αγροτεμάχιο " . $parcel->code);
			}
		}

		return redirect()->to('fmis/farmer/pending')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
	}
}
