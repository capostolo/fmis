<?php namespace Fmis\Controllers;

class ParamSoController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
  }
  
  public function getCultivarCodes()
  {
      if ($this->request->isAJAX()) {
          $cultivationCode = $this->request->getPost('cultivation_code');
          
          $ParamCatso = new \Fmis\Models\ParamCatsoModel();
          $ParamSo = new \Fmis\Models\ParamSoModel();
  
          // Get the catso_id for the selected cultivation code
          $catso = $ParamCatso->where('poiCategory', $cultivationCode)->first();
  
          if ($catso) {
              // Get the cultivar codes for the selected catso_id
              $cultivarCodes = $ParamSo->where('poiCategory', $catso->poiCategory)->findAll();
  
              return $this->response->setJSON([
                  'success' => true,
                  'cultivar_codes' => $cultivarCodes
              ]);
          }
  
          return $this->response->setJSON([
              'success' => false,
              'message' => 'No matching cultivar codes found'
          ]);
      }
  
      return $this->response->setJSON([
          'success' => false,
          'message' => 'Invalid request'
      ]);
  }
  
}
