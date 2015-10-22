<?php 
namespace Makuta;

/**
* 
*/
abstract class RequestMaker
{
	protected $id;
	protected $secret;

	function __construct($id, $secret)
	{
		$this->id = $id;
		$this->secret = $secret;
	}

	abstract public function submit($params = array());

	protected function getSignature($data)
	{
		return hash_hmac("sha256", $data, $this->secret);
	}	
}