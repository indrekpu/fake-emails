<?php

class Privacypolicy extends CI_Controller {
	
	public function view(){

		if(!isset($this->session->statistics)){
    		$this->load->model('statistics_model');
    		$this->load->model('data_request');
    		
    		$ipInformation = $this->data_request->getUrlContents($this->statistics_model->getIp());

    		if(isset($ipInformation['country_name']) && $this->statistics_model->getIp() != "127.0.0.1"){
    			$this->statistics_model->insertStatistics($ipInformation['country_name']);
    		}

    		$this->session->set_userdata('statistics', 'true');
    	}

    	$headerData = array();//Title, language, description, keywords
    	$headerData['title'] = "Privaatsuspoliitika";
    	$headerData['lang'] = "et";
		$headerData['description'] = "Privaatsuspoliitika";
		$headerData['keywords'] = "privaatsus, andmed, andmete käitlemine, salvestamine, info, informatsioon, kasutaja";
    	


		$this->load->view('templates/header', $headerData);
		if($this->session->userdata('name') != null){
			$this->load->view('templates/navbar-logged');
		} else {
			$this->load->view('templates/navbar-not-logged');
		}
		$this->load->view('pages/privacypolicy');
		$this->load->view('templates/footer');
	}	

}

?>