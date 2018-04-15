<?php

class Statistics extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	public function view(){
		$this->load->model('statistics_model');
		$browserArray = $this->statistics_model->getBrowsers();
		$platformArray = $this->statistics_model->getPlatforms();

		$data = array();
		$data['browser_labels'] = array_keys($browserArray);
		$data['browser_values'] = array_values($browserArray);
		$data['platform_labels'] = array_keys($platformArray);
		$data['platform_values'] = array_values($platformArray);

		if(!isset($this->session->statistics)){
    		$this->load->model('statistics_model');
    		$this->load->model('data_request');

    		$ipInformation = $this->data_request->getUrlContents($this->statistics_model->getIp());
    		if(isset($ipInformation->country)){
    			$this->statistics_model->insertStatistics($ipInformation->country);
    		}

    		$this->session->set_userdata('statistics', 'true');
    	}

    	$headerData = array();//Title, language, description, keywords
    	$headerData['title'] = "Statistika";
    	$headerData['lang'] = "et";
		$headerData['description'] = "Kasutajate statistika: ip aadress, riik, brauser, platform, operatsioonisüsteem";
		$headerData['keywords'] = "ip, aadress, riik, brauser, platform, operatsioonisüsteem, os, statistika, kasutaja";



		$this->load->view('templates/header', $headerData);
		if($this->session->userdata('name') != null){
			$this->load->view('templates/navbar-logged');
		} else {
			$this->load->view('templates/navbar-not-logged');
		}
		$this->load->view('pages/statistics', $data);
		$this->load->view('templates/footer');
	}

	public function statisticsTable(){
		$this->load->model('statistics_model');
		$result = $this->statistics_model->getTabel();
		$jsonArray = array();
		foreach($result as $row){
			//$rowArray = array($row->ip, $row->country,$row->browser, $row->platform, $row->time,);
			$jsonArray[] = $row;
		}

		$jsonArray = json_encode($jsonArray, JSON_FORCE_OBJECT);
		print_r($jsonArray);
	}

}

?>