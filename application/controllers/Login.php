<?php
class Login extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
	}

	public function index($data=NULL){
		
	}

	public function submit(){
		//TODO load user model, check user data, start session.	
		$formData = $this->input->post();
		$email =  $this->input->post("email");
		$password =  $this->input->post("password");

		$this->load->model('user');
		$result = $this->user->loginUser($email, $password);

		if($result){
			redirect(base_url(), 'refresh');
		} else {
			redirect(base_url() . 'login', 'refresh');
		}
	}

	public function logout(){
		session_destroy();
		redirect(base_url(), 'refresh');
	}

}
?>