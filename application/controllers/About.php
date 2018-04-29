<?php

class About extends CI_Controller {
	
	public function view(){

		if(!isset($this->session->statistics)){
    		$this->load->model('statistics_model');
    		$this->load->model('data_request');

    		/*$ipInformation = $this->data_request->getUrlContents($this->statistics_model->getIp());
    		if(isset($ipInformation->country)){
    			$this->statistics_model->insertStatistics($ipInformation->country);
    		}*/

    		$this->session->set_userdata('statistics', 'true');
    	}

    	$headerData = array();//Title, language, description, keywords
    	$headerData['title'] = "Informatsioon";
    	$headerData['lang'] = "et";
		$headerData['description'] = "Lehe informatsioon";
		$headerData['keywords'] = "info, informatsioon, analüüsimine, e-kirjad, email, ekirjad, kkk, korduma kippuvad küsimused";
    	


		$this->load->view('templates/header', $headerData);
		if($this->session->userdata('name') != null){
			$this->load->view('templates/navbar-logged');
		} else {
			$this->load->view('templates/navbar-not-logged');
		}
		$this->load->view('pages/about');
		$this->load->view('templates/footer');
	}	

}

?>