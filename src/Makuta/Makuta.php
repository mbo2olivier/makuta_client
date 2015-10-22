<?php 

/**
* 
*/

namespace Makuta;

class Makuta
{
	protected $appID;
	protected $secret;
	protected $parser;
	protected $sender;

	
	function __construct($id, $secret,RequestMaker $method=null)
	{
		$this->appID = $id;
		$this->secret = $secret;
		$this->parser = new ResponseParser();
		if (!is_null($method)) {
            $this->sender = $method;
        } else {
            $this->sender = new RequestMaker\Curl($id, $secret);
        }
	}

	public function openTransaction($montant, $devise, $code, $account = null){
		$params = array('ACTION'  => 'OPEN_TX',
						'AMOUNT'  => $montant,
						'DEVISE'  => $devise,
						'TX_CODE' => $code,
						'ACCOUNT' => $account
					);
		$response = $this->sender->submit($params);
		return $this->parser->parse($response);
	}

	public function getStatus($token){
		$params = array('ACTION' => 'GET_STATUS',
						'TOKEN' => $token
					);
		$response = $this->sender->submit($params);
		return $this->parser->parse($response);
	}

}