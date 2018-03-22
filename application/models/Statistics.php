<?php

class Statistics extends CI_Model {

	private $browserInfo;

	public function __construct(){
		parent::__construct();
		$this->browserInfo = get_browser();
	}

	public function insertStatistics($country){
		$browser = $this->db->escape($this->getBrowser());
		$platform = $this->db->escape($this->getPlatform());
		$ip = $this->db->escape($this->getIp());
		$country = $this->db->escape($country);
		

		$result = $this->db->simple_query("INSERT INTO statistics(ip, country, browser, platform) VALUES($ip, $country, $browser, $platform)");
	}

	public function getBrowser(){
		return $this->browserInfo->browser;
	}

	public function getPlatform(){
		return $this->browserInfo->platform;
	}

	public function getIp(){
		return $_SERVER['REMOTE_ADDR'];
	}

}

?>