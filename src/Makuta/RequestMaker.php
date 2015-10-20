<?php 

/**
* 
*/
class RequestMaker
{
	protected $id;
	protected $secret;
	
	function __construct($id, $secret)
	{
		$this->id = $id;
		$this->secret = $secret;
	}

	function submit($params = array()){
		
	}
}