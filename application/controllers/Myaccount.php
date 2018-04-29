<?php

class Myaccount extends CI_Controller {
	
	public function view(){
		$this->load->model('user');
		$this->load->model('file_handler');

		if($this->session->email == null){ // kui kasutaja pole sisse logitud.
			$this->session->set_userdata('redirect', 'myaccount');
			redirect(base_url() . "login", 'refresh');
		}

		$filesContents = $this->file_handler->getUserAllFileContents($this->session->id);
		
		$data = array();
		$data['files_data'] = $filesContents;
		$data['json_data'] = json_encode($filesContents);
		$data['user_files'] = $this->user->getUserFiles($this->session->id);
		$data['user_info'] =  $this->user->getUserInfo($this->session->id); 

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
    	$headerData['title'] = "Minu kasutaja";
    	$headerData['lang'] = "et";
		$headerData['description'] = "Kasutaja kohta informatsioon ja kasutaja e-kirjad";
		$headerData['keywords'] = "info, nimi, email, e-kiri, kirjad, riik";


		$this->load->view('templates/header', $headerData);
		if($this->session->userdata('name') != null){
			$this->load->view('templates/navbar-logged');
		} else {
			$this->load->view('templates/navbar-not-logged');
		}
		$this->load->view('pages/myaccount', $data);
		$this->load->view('templates/footer');

	}

	public function activateAccount($verificationCode){
		$this->load->model('user');

		if($this->user->activateUser($verificationCode)){
			$this->session->set_flashdata('success', "Kasutaja aktiveeritud!");
			redirect(base_url() . "login", 'refresh');
		}
		$this->session->set_flashdata('success', "Kasutaja juba aktiveeritud või ei eksisteeri!");
		redirect(base_url() . "login", 'refresh');
	}

	public function removeFile($fileId){
		$this->load->model('user');

		if($this->user->isUsersFile($this->session->id, $fileId)){
		    unlink("./assets/uploads/" . $this->session->id . "/" . $this->user->getFileName($fileId));
		    $result = $this->user->removeFileFromDb($fileId);
		    if($result){
		    	$this->session->set_flashdata('result', "Fail kustutatud!");
		    	redirect(base_url() . "myaccount", 'refresh');
		    }
		}

		$this->session->set_flashdata('result', "Error occured during file deletion!");
		redirect(base_url() . "myaccount", 'refresh');
	}

}

?>