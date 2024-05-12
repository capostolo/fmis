<?php namespace Fmis\Controllers;

class HomeController extends BaseController
{

  public function __construct()
  {
  }
  
  public function index()
  {    
    return view('\Fmis\Views\home');
  }

}
