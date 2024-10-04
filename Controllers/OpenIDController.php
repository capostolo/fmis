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
	$provider = 'https://accounts.opekepe.gr/realms/eco-schemes';
	$cid = 'schemis';
	$secret = '04C6n2ZtfuoL82cFG9Ql5IF55olSV98x';
	$oidc = new \Jumbojett\OpenIDConnectClient($cid, $secret, $issuer, $provider);

	$oidc->authenticate();
	$token = $oidc->access_token;
	$afm = $oidc->tin;
	$options = [
		'baseURI' => 'https://eae.opekepe.gr/api/v1/',
		'headers' => [
			'Authorization' => 'Bearer '. $token,
		],
		'query' => [
			'tin' => $afm, 
			'year' => '2024', 
			'initial' => 'false'
		],		
	];
	$client = service('curlrequest', $options);
	$response = $client->get('applications');
	var_dump($response);


  }
}
