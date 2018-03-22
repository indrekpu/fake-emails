<?php

class Data_request extends CI_Model {

	public function getUrlContents($ip){
		$json = file_get_contents("http://ip-api.com/json/176.46.98.232");
		$expression = json_decode($json);
		return $expression;
	}

}

?>