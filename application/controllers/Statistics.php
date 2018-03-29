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


		$this->load->view('templates/header');
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
		foreach($result as $row){
			echo "$row->ip;$row->country;$row->browser;$row->platform;$row->time|";
		}
	}

}

?>