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
    $farmer = session()->get('farmer_id');
	$parcels = new \Fmis\Models\ParcelModel();
	$data['rows'] = $parcels->getYears(['farmer_id' => $farmer]);
    return view('\Fmis\Views\Spd\list', $data);
  }

  public function showItem($year)
  {    
    $farmer = session()->get('farmer_id');
    $data['table1'] = $this->model->where(['farmer_id' => $farmer, 'iacs_year' => $year])->findAll();
    $data['table2'] = $this->model->getTable2(['farmer_id' => $farmer, 'iacs_year' => $year]);
    $data['table3a'] = $this->model->getTable3a(['farmer_id' => $farmer, 'iacs_year' => $year]);
    $data['table3b'] = $this->model->getTable3b(['farmer_id' => $farmer, 'iacs_year' => $year]);
    $data['table4'] = $this->model->getTable4(['farmer_id' => $farmer, 'iacs_year' => $year]);
    $data['table5'] = $this->model->getTable5(['farmer_id' => $farmer, 'iacs_year' => $year]);
    return view('\Fmis\Views\Spd\show', $data);
	/*  
	$paths = new \Config\Paths();
	require_once $paths->pdfDirectory . '/vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'format' => [190, 236],
      'orientation' => 'P'
    ]);
    $mpdf->use_kwt = true;
    //$stylesheet = file_get_contents(base_url().'/assets/css/print.css');
    //$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML(view('\Fmis\Views\Spd\show', $data));
    $this->response->setHeader('Content-Type', 'application/pdf');
    $mpdf->Output('filename.pdf', 'I');
    //return view('\Yf\Apps\Views\app_print_data', $data);
	*/
  }

}
