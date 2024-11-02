<?php namespace Fmis\Controllers;


class SpdController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\SpdModel();
  }
  
  public function index()
  {    
	$parcels = new \Fmis\Models\ParcelModel();
	$advisors = new \Fmis\Models\AdvisorModel();
	$data['advisors'] = $advisors->where(['parent_id' => session()->get('advisor_id')])->findAll();  
	$data['rows'] = $parcels->getYears(['farmer_id' => session()->get('farmer_id')]);
    return view('\Fmis\Views\Spd\list', $data);
  }

  public function showItem()
  {    
    $postdata = $this->request->getPost();
	$year = $postdata['iacs_year'];
	$farmer = session()->get('farmer_id');
	$parcels = new \Fmis\Models\ParcelModel();
	$advisors = new \Fmis\Models\AdvisorModel();
	$data['user'] = $user = auth()->user();
	$data['advisor'] = $advisors->find($postdata['advisor_id']);
	$data['table6'] = $parcels->getCalendar('farmer_id = '. $farmer. ' AND dir_date IS NOT NULL');
	$data['table4'] = $this->model->getTable4(['farmer_id' => $farmer, 'iacs_year' => $year]);
	$data['iacs_year'] = $year;
	if (count($_GET) == 0) {
		$data['iacs_year'] = $year;
		$data['advisor_id'] = $postdata['advisor_id'];
		$data['ecoZ'] = false;
		$data['ecoU'] = false;
		foreach ($data['table4'] As $t) {
			if ($t->action == '31.6-Ζ') {
				$data['ecoZ'] = true;
			}
			if ($t->action == '31.6-Θ') {
				$data['ecoU'] = true;
			}
		}
		if ($data['ecoZ'] || $data['ecoU']) {
			return view('\Fmis\Views\Spd\additional', $data);
		}
	}

	$data['table1'] = $this->model->where(['farmer_id' => $farmer, 'iacs_year' => $year])->findAll();
	$data['table2'] = $this->model->getTable2(['farmer_id' => $farmer, 'iacs_year' => $year]);
	$data['table3a'] = $this->model->getTable3a(['farmer_id' => $farmer, 'iacs_year' => $year]);
	$data['table3b'] = $this->model->getTable3b(['farmer_id' => $farmer, 'iacs_year' => $year]);
	$data['table4'] = $this->model->getTable4(['farmer_id' => $farmer, 'iacs_year' => $year]);
	$data['table5'] = $this->model->getTable5(['farmer_id' => $farmer, 'iacs_year' => $year]);
	
	$data['equip_year'] = $_GET['equip_year'] ?? '';
	$data['beck_type'] =  $_GET['beck_type'] ?? '';
	$data['beck_num'] =  $_GET['beck_num'] ?? '';

    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
	$mpdf->use_kwt = true;
	$content = view('\Fmis\Views\Spd\show', $data);
	$mpdf->WriteHTML($content);
    $this->response->setHeader('Content-Type', 'application/pdf');
    $mpdf->Output('filename.pdf', 'I');
  }

}
