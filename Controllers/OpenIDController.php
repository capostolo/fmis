<?php namespace Fmis\Controllers;

use Jumbojett\OpenIDConnectClient;


class OpenIDController extends BaseController
{
  public function __construct()
  {
    helper(['form', 'url', 'session']);
  }
  
  public function index()
  {
	$issuer = 'https://accounts.opekepe.gr/realms/eco-schemes';
	$cid = 'schemis';
	$secret = '04C6n2ZtfuoL82cFG9Q15IF55o1SV98x';
	$oidc = new \Jumbojett\OpenIDConnectClient($issuer, $cid, $secret);

	$oidc->authenticate();
	//$oidc->requestUserInfo();

	$attributes = array();
	foreach($oidc as $key=> $value) {
		if(is_array($value)){
				$v = implode(', ', $value);
		}else{
				$v = $value;
		}
		$attributes[$key] = $v;
	}
	session()->set('openid_attr', $attributes);

  }
}
