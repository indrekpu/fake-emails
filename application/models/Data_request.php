<?php

class Data_request extends CI_Model {

	public function getUrlContents($ip){
		$json = file_get_contents("http://ip-api.com/json/$ip");
		$expression = json_decode($json);
		return $expression;
	}

}

?>