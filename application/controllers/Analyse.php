<?php

class Analyse extends CI_Controller{

	private $allowedFileTypes = "msg|txt";
	private $maxFileSize = 2 * 1000 * 1000; //MegaBytes
	private $directory = "./assets/uploads/";


	public function view(){

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
    	$headerData['title'] = "E-kirja analüüsimine ja laadimine";
    	$headerData['lang'] = "et";
		$headerData['description'] = "Kasutaja e-kirja analüüsimine ning kasutaja võimalus laadida e-kirja serveri";
		$headerData['keywords'] = "E-kiri, email, analüüsimine, tuvastamine, upload, ülesse laadmine";
    	


		$this->load->view('templates/header', $headerData);
		if($this->session->userdata('name') != null){
			$this->load->view('templates/navbar-logged');
		} else {
			$this->load->view('templates/navbar-not-logged');
		}
		$this->load->view('pages/analyse');
		$this->load->view('templates/footer');
	}	

	public function upload(){
		$this->load->model('user');

		
		$config = array(
		'upload_path' => $this->directory . $this->session->id,
		'allowed_types' => $this->allowedFileTypes,
		'overwrite' => FALSE,
		'max_size' => $this->maxFileSize
		);
		$this->load->library('upload', $config);

		if(!is_dir($this->directory . $this->session->id)){
			mkdir($this->directory . $this->session->id);
		}

		if(!$this->upload->do_upload('email_file')) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('result', $error);
			redirect(base_url() . "analyse", 'refresh');
		} else {
			$fileData = $this->upload->data();
			$fileName = $fileData['file_name'];
			$result = $this->user->addFileToUser($this->session->email, $fileName);
			
			$success = array($result);
			$this->session->set_flashdata('result', $success);
			redirect(base_url() . "analyse", 'refresh');
		}
	}

}

?>