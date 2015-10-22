<?php 
namespace Makuta;
/**
* 
*/
class ResponseParser
{
	
	function parse($text,$assoc = true){
		return json_decode($text,$assoc);
	}
}