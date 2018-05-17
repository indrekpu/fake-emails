<?php
class Login extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
	}

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
    	$headerData['title'] = "Sisse logimine";
    	$headerData['lang'] = "et";
		$headerData['description'] = "Logimise võimalus ning registreerimine";
		$headerData['keywords'] = "login, logimine, registreerimine, log in, facebook";
    	


		$this->load->view('templates/header', $headerData);
		if($this->session->userdata('name') != null){
			$this->load->view('templates/navbar-logged');
		} else {
			$this->load->view('templates/navbar-not-logged');
		}
		$this->load->view('pages/login');
		$this->load->view('templates/footer');
	}	

	public function submit(){
		$formData = $this->input->post();
		$email =  $this->input->post("email");
		$password =  $this->input->post("password");

		$this->load->model('user');
		$result = $this->user->loginUser($email, $password);

		if($result){
			if($this->input->post("redirect") != null){ //For melding purpose we check if the redirect value is assigned.
				$this->session->unset_userdata('redirect'); 
				redirect(base_url() . $this->input->post("redirect"), 'refresh');
			} else {
				redirect(base_url(), 'refresh');
			}
		} else {
			$this->session->set_flashdata('failure', 'Kontrolli väljasid!');
			redirect(base_url() . 'login', 'refresh');
		}
	}

	public function logout(){
		session_destroy();
		redirect(base_url(), 'refresh');
	}

	public function fbLogin(){
		$this->load->model('facebook_model');
		$result = $this->facebook_model->fbLogin();
		echo $result;
	}

	public function fbCallback(){
		$this->load->model('facebook_model');
		$this->load->model('user');
		$fbEmail = $this->facebook_model->fbCallback();
		if($this->user->doesUserExist($fbEmail)){
			$result = $this->user->loginViaEmail($fbEmail);
			if($result){
				redirect('myaccount', 'refresh');
			}
			echo 'Login via facebook Failed!';
		} else {
			$this->session->set_flashdata('email', $fbEmail);
			redirect('register', 'refresh');
		}
	}

	public function smartLogin(){
		$this->load->model('smartid_model');
		$this->smartid_model->login();
	}

	public function smartCallback(){
		$this->load->model('smartid_model');
		$this->load->model('user');
		$smartEmail = $this->smartid_model->getCallbackEmail();

		if($smartEmail != null){
			if($this->user->doesUserExist($smartEmail)){
				$loginResult = $this->user->loginViaEmail($smartEmail);
				if($loginResult){
					redirect('myaccount', 'refresh');
				}
			} else {
				$this->session->set_flashdata('email', $smartEmail);
				redirect('register', 'refresh');
			}
		}
	}

}
?>