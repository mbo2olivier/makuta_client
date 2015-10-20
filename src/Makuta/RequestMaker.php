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

	abstract function submit($params = array());	
}