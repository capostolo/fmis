<?php namespace Fmis\Controllers;

class HomeController extends BaseController
{

  public function __construct()
  {
    helper('form');
  }
  
  public function index()
  {    
    return view('\Fmis\Views\home');
  }

  public function selectYear()
  {    
    session()->remove('iacs_year');
    $data['hide'] = 'collapse';
    return view('\Fmis\Views\member_home', );
  }

  public function setYear()
  {    
    $iacs_year = $this->request->getPost('iacs_year');
    session()->set(['iacs_year' => $iacs_year]);
    return redirect()->to ('fmis/farmer');
  }

}
