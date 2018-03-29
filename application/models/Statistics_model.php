<?php

class Statistics_model extends CI_Model {

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

	public function getTabel(){
		$query = $this->db->query("SELECT ip, country, browser, platform, time FROM statistics ORDER BY time");
		return $query->result();
	}

	public function getBrowsers(){
		$resultArray = array();
		$query = $this->db->query("SELECT browser, COUNT(browser) AS browser_count FROM statistics GROUP BY browser");
		
		foreach($query->result() as $row){
			$resultArray[$row->browser] = $row->browser_count;
		}
		return $resultArray;
	}

	public function getPlatforms(){
		$resultArray = array();
		$query = $this->db->query("SELECT platform, COUNT(platform) AS platform_count FROM statistics GROUP BY platform");
		
		foreach($query->result() as $row){
			$resultArray[$row->platform] = $row->platform_count;
		}
		return $resultArray;
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