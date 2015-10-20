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

	
	function __construct($id, $secret)
	{
		$this->appID = $id;
		$this->secret = $secret;
		$this->parser = new ResponseParser();
		$this->sender = new RequestMaker($id, $secret);
	}

	public function openTransaction($montant, $devise, $code, $account = null){
		$params = array('ACTION' => 'OPEN_TX',
						'AMOUNT' => $montant,
						'DEVISE' => $devise,
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