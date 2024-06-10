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

    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
	$mpdf->use_kwt = true;
	$html = view('\Fmis\Views\Spd\show', $data);
	$mpdf->WriteHTML($html);
    $this->response->setHeader('Content-Type', 'application/pdf');
    $mpdf->Output('filename.pdf', 'I');
  }

}
