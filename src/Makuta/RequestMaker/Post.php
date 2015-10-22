<?php 
namespace Makuta\RequestMaker;

use Makuta\RequestMaker;
/**
* 
*/

class Post extends RequestMaker
{
	const SERVER_URL = "http://www.e-makuta.com/web/api/intent";

	function __construct($id, $secret)
	{
		parent::__construct($id, $secret);
	}

	public function submit($params = array()){
		$data = http_build_query($params,'','&');
		$sig = $this->getSignature($data);
		$endpoint = self::SERVER_URL.'?'.http_build_query(array("APP_ID"=>$this->id,"SIGNATURE"=>$sig));
		$options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => $data,
            ),
        );
        $context = stream_context_create($options);
        return file_get_contents($endpoint, false, $context);
	}
}