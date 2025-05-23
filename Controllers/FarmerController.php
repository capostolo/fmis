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
    session()->remove('farmer_location');
    session()->remove('farmer_pen');
    session()->remove('farmer_reg');
    if (session('magicLogin')) {
      return redirect()->route('change-password')->with('message', lang('Auth.forceChangePassword'));
    }
	  $data['admin'] = false;
    if ($this->user->inGroup('admin')) {
      $data['rows'] = $this->model->getList();
	    $data['admin'] = true;
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
    $data['crops'] = $crops->getCropList(['farmer_id' => $id, 'iacs_year' => session()->get('iacs_year')]);
    $data['farmer'] = false;
    if ($this->user->inGroup('user')){
      $data['farmer'] = true;
    }
    $data['row'] = $this->model->getFarmer(['id' => $id]);

    if($data['row']){
      session()->set('farmer_id', $id);
      session()->set('farmer_name', $data['row']->farmer_firstname.' '.$data['row']->farmer_lastname);
      session()->set('farmer_afm', $data['row']->farmer_afm);
      session()->set('farmer_fathername', $data['row']->farmer_fathername);
      session()->set('farmer_location', $data['row']->farmer_location);
      session()->set('farmer_pen', $data['row']->farmer_pen);
      session()->set('farmer_reg', $data['row']->farmer_reg);
      session()->set('advisor_id', $data['row']->advisor_id);
    }
    return view('\Fmis\Views\Farmer\update', $data);
  }
  
  public function showPendingDir()
  {
	$data['rows'] = $this->model->getPendingDir(['farmer_id' => session()->get('farmer_id')]);
    return view('\Fmis\Views\Farmer\pending', $data);
  }

  public function addJson()
  {
    return view('\Fmis\Views\Farmer\addJson');
  }

  public function importFromJson()
  {
    // Validate file upload
    $validationRules = [
        'jsonFile' => [
            'label' => 'Αρχείο JSON',
            'rules' => [
                'uploaded[jsonFile]',
                'mime_in[jsonFile,application/json]',
                'max_size[jsonFile,2048]' // 2MB max size
            ]
        ]
    ];

    if (!$this->validate($validationRules)) {
        session()->setFlashdata('error', $this->validator->getError('jsonFile'));
        return redirect()->to('/fmis/farmer');
    }

    try {
        $file = $this->request->getFile('jsonFile');
        if (!$file->isValid()) {
            throw new \RuntimeException($file->getErrorString());
        }

        // Read and parse JSON content
        $jsonContent = file_get_contents($file->getTempName());
        $data = json_decode($jsonContent);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Μη έγκυρη μορφή αρχείου JSON');
        }

        // Validate required JSON structure
        if (!isset($data->tin)) {
            throw new \RuntimeException('Το αρχείο JSON δεν περιέχει την αναμενόμενη δομή δεδομένων');
        }

        // Create new farmer
        $farmerModel = new \Fmis\Models\FarmerModel();
        $existing_farmer = $farmerModel->where(['farmer_afm' => $data->tin, 'advisor_id' => user_id()])->first();
        $farmer = new \Fmis\Entities\FarmerEntity(); 
        $farmer_id = 0;
        if ($existing_farmer){
            $farmer->id = $existing_farmer->id;
            $farmer_id = $existing_farmer->id;
        }

        // Populate farmer data
        $farmer->farmer_afm = $data->tin;
        $farmer->farmer_firstname = $data->applicant_detail->first_name;
        $farmer->farmer_lastname = $data->applicant_detail->last_name;
        $farmer->farmer_fathername = $data->applicant_detail->father_name;
        $farmer->farmer_mobile = $data->applicant_detail->mobile_phone_number;
        $farmer->farmer_email = $data->applicant_detail->email;
        $farmer->farmer_dtebirth = $data->applicant_detail->birth_date;
        $farmer->farmer_location = $data->applicant_holding->administrative_division_code;
        $farmer->farmer_source = 'JSON';
        $farmer->advisor_id = user_id();
        $farmerModel->save($farmer);
        if($farmer_id == 0){    
            $farmer_id = $farmerModel->getInsertID();
        }

        // Create new parcel
        $parcelModel = new \Fmis\Models\ParcelModel();
        $parcelSchemeModel = new \Fmis\Models\ParcelSchemeModel();
        $parcel = new \Fmis\Entities\ParcelEntity(); 
        $parcel_scheme = new \Fmis\Entities\ParcelEntity(); 
        $existing_parcel = $parcelModel->where(['farmer_id' => $farmer_id, 'iacs_year' => $data->year])->first();
        
        if($existing_parcel){
            session()->setFlashdata("error", "Η διαδικασία εισαγωγής δεδομένων ματαιώθηκε. Υπάρχουν ήδη δεδομένα για τον παραγωγό με τον ΑΦΜ ".$data->tin." και το έτος ".$session()->get('iacs_year').".");
            return redirect()->to('/fmis/farmer');
        }

        $parcel->farmer_id = $farmer_id;
        $parcel->iacs_year = $data->year;
        foreach ($data->field_list as $p) {
            $parcel->aa = $p->code;
            $parcel->code = $p->field_geospatial_data->cartographic_background;
            $parcel->location = $p->field_info->location;
            $parcel->geomwkt = $p->field_geospatial_data->geom;
            $parcel->community_code = $p->field_geospatial_data->community_code;
            $parcel->co_ownership_percent = $p->field_info->co_ownership_percent;    
            
            foreach($p->field_cultivation_list as $c){
                $parcel->total_area = $c->total_area;
                $parcel->cultivation_code = $c->cultivation_code;
                $parcel->cultivar_code = $c->cultivar_code;
                $parcel->is_irrigated = $c->is_irrigated;
                $parcel->irrigation_method_code = $c->irrigation_method_code;
                $parcel->trees_number_ge4_years = $c->trees_number_ge4_years;
                $parcel->trees_number_l4_years = $c->trees_number_l4_years;
                $parcel->is_cultivation_ge3_years = $c->is_cultivation_ge3_years;
                $parcelModel->insert($parcel);
                $parcel_id = $parcelModel->getInsertID();
                
                foreach ($p->field_ecoscheme_subsidy_list as $e) {
                    $parcel_scheme->parcel_id = $parcel_id;
                    $parcel_scheme->ecoscheme_subsidy_code = $e->ecoscheme_subsidy_code;
                    $parcelSchemeModel->insert($parcel_scheme);
                }
            }
        }
        
        session()->setFlashdata("message", "Τα δεδομένα του παραγωγού με τον ΑΦΜ ".$data->tin." και το έτος ".session()->get('iacs_year')." καταχωρίστηκαν!");
        return redirect()->to('/fmis/farmer');

    } catch(\Exception $e) {
        session()->setFlashdata("error", "Σφάλμα κατά την επεξεργασία των δεδομένων: " . $e->getMessage());
        return redirect()->to('/fmis/farmer');
    }
  }

  public function newPo()
  {
    $PoModel = new \Fmis\Models\PoModel();
    $data['po'] = $PoModel->findAll();

    return view('\Fmis\Views\Farmer\addPo', $data);
  }

  public function showPo()
  {
    $PoModel = new \Fmis\Models\PoModel();
    $data['po'] = $PoModel->findAll();
    $FarmerModel = new \Fmis\Models\FarmerModel();
    $farmer = $FarmerModel->find(session()->get('farmer_id'));
    $data['farmer_po_id'] = $farmer->farmer_po_id;


    return view('\Fmis\Views\Farmer\updatePo', $data);
  }

  public function savePo()
  {
    $rules = [
      'farmer_po_id' => [
        'rules' => 'required|is_natural_no_zero',
        'errors' => [
          'required' => 'Η ΟΠ είναι υποχρεωτική.',
          'is_natural_no_zero' => 'Η ΟΠ δεν είναι έγκυρη.'
        ]
      ]
    ];

    // Run validation
    if (!$this->validate($rules)) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
    $FarmerModel = new \Fmis\Models\FarmerModel();
    $farmer = new \Fmis\Entities\FarmerEntity();
    $postdata = $this->request->getPost();
    $farmer->farmer_po_id = $postdata['farmer_po_id'];
    $farmer->id = session()->get('farmer_id');
    if($FarmerModel->save($farmer)){
      return redirect()->to('fmis/farmer')->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα αποθήκευσης. Παρακαλώ ελέγξτε τα δεδομένα και προσπαθήστε ξανά.");
    }
  }

  public function removePo()
  {    
    $item_id = $this->request->getPost('item_id');
    $item_data = $this->model->find($item_id);
    
    $item = new \Fmis\Entities\FarmerEntity();
    $item->id = $item_id;
    $item->farmer_po_id = null;
    $this->model->save($item);
    
    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'Η διαγραφή ολοκληρώθηκε με επιτυχία'
    ]);
  }

  public function delete()
  {
    if ($this->request->isAJAX() && $this->user->inGroup('admin')) {
      $id = $this->request->getPost('item_id');
      if ($this->model->delete($id)) {
        $response = [
          'status' => 'success',
          'message' => lang('Fmis.delete_success')
        ];
      } else {
        $response = [
          'status' => 'error', 
          'message' => lang('Fmis.delete_failure')
        ];
      }
      return $this->response->setJSON($response);
    }
  }
}
