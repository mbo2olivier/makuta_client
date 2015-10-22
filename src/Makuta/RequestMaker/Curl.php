<?php 
namespace Makuta\RequestMaker;

use Makuta\RequestMaker;
/**
* 
*/

class Curl extends RequestMaker
{
	const SERVER_URL = "http://www.e-makuta.com/web/api/intent";

	function __construct($id, $secret)
	{
		parent::__construct($id, $secret);
	}

	public function submit($params = array())
	{
		$data = http_build_query($params,'','&');
		$sig = $this->getSignature($data);
		$endpoint = self::SERVER_URL.'?'.http_build_query(array("APP_ID"=>$this->id,"SIGNATURE"=>$sig));
		$curl = curl_init($endpoint);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded'
        ));
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		$return = curl_exec($curl);
		curl_close($curl);
		return $return;
	}
}