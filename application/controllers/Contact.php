<?php
class Contact extends CI_Controller{

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
    	$headerData['title'] = "Kontakt";
    	$headerData['lang'] = "et";
		$headerData['description'] = "Fake-Emails kontakt informatsioon: asukoht, email ja muud kontakteerumis võimalused";
		$headerData['keywords'] = "kontakt, telefoninumber, telefon, tel, aadress, email, e-kiri, eesti";
    	


		$this->load->view('templates/header', $headerData);
		if($this->session->userdata('name') != null){
			$this->load->view('templates/navbar-logged');
		} else {
			$this->load->view('templates/navbar-not-logged');
		}
		$this->load->view('pages/contact');
		$this->load->view('templates/footer');
	}	

	public function submit(){
		$this->load->model("user");
		$formData = $this->input->post();

		$email =  $this->input->post("email");
		$name =  $this->input->post("name");
		$message =  $this->input->post("message");

		$result = $this->user->addContactMessage($name, $email, $message);
		if($result){
			$this->session->set_flashdata('success', 'Sõnum saadetud!');
			redirect(base_url() . 'contact', 'refresh');
		} else {
			$this->session->set_flashdata('failure', 'Kontrolli väljasid!');
			redirect(base_url() . 'contact', 'refresh');
		}
	}

}
?>