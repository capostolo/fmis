<?php namespace Fmis\Controllers;

class FarmInputOutputController extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url', 'session', 'date']);
    }

    public function index()
    {
        $FarmInput = new \Fmis\Models\FarmInputsModel();
        $FarmOutput = new \Fmis\Models\FarmOutputsModel();

        $data['inputs'] = $FarmInput->modelList(['farmer_id' => session()->get('farmer_id')]);
        $data['outputs'] = $FarmOutput->modelList(['farmer_id' => session()->get('farmer_id')]);

        return view('\Fmis\Views\FarmInputOutput\report', $data);
    }

    public function downloadPdf()
    {
        $FarmInput = new \Fmis\Models\FarmInputsModel();
        $FarmOutput = new \Fmis\Models\FarmOutputsModel();

        $data['inputs'] = $FarmInput->modelList(['farmer_id' => session()->get('farmer_id')]);
        $data['outputs'] = $FarmOutput->modelList(['farmer_id' => session()->get('farmer_id')]);

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->use_kwt = true;
        $content = view('\Fmis\Views\FarmInputOutput\report_pdf', $data);
        $mpdf->WriteHTML($content);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('filename.pdf', 'D');
        }
} 