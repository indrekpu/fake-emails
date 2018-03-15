<?php
class Login extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
	}

	public function index($data=NULL){
		
	}

	public function submit($user, $pw){
		//TODO load user model, check user data, start session.	
	}

}
?>