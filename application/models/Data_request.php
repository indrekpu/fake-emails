<?php

class Data_request extends CI_Model {

	public function getUrlContents($ip){
		$json = file_get_contents("http://freegeoip.net/json/$ip");
		$expression = json_decode($json, true);
		return $expression;
	}

}

?>