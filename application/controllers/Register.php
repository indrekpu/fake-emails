<?php
class Register extends CI_Controller{

	public function index($data = NULL){
		
	}

	public function submit(){
		$this->load->model('user');
		$this->load->model('mail');

		$formData = $this->input->post();
		$name =  $this->input->post("full_name");
		$email =  $this->input->post("email");
		$password =  $this->input->post("passwd");
		$confirmPassword =  $this->input->post("confirm_passwd");

		if($password != $confirmPassword){
			$this->redirectWithMessage('register', 'failure', "Paroolid ei uhti!");
		}

		if($this->user->doesUserExist($email)){
			$this->redirectWithMessage('register', 'failure', "Selle emailiga on juba registreeritud.");
		}

		if(!$this->validateFields($name, $email, $password)){
			$this->redirectWithMessage('register', 'failure', "Kontrolli andmeid!");
		}
		
		$result = $this->user->createUser($name, $email, "", "", $password);

		if($result){
			$this->mail->sendVerification($email, $this->user->getUserVerificationCode($email)); //Sending verification to user.
			$this->redirectWithMessage('login', 'success', "Registeerimine õnnestus!");
		} else {
			$this->redirectWithMessage('register', 'failure', "Registeerimine ebaõnnestus!");
		}
	}

	private function validateFields($name, $email, $password){
		$name = preg_match("%[A-Za-zÜÕÄÖüõäö\. -]{3,30}%", $name);
		$email = preg_match("%[A-Za-z0-9._-]+@[A-Za-z-]{1,20}\.[A-Za-z]{2,10}(\.[A-Za-z]{2,10})?%", $email);
		$password = preg_match("%[A-Za-zÜÕÄÖüõäö0-9.]{6,30}%", $password);

		if($name and $email and $password){
			return true;
		}
		return false;
	}

	public function redirectWithMessage($pageName, $status, $message){
		$this->session->set_flashdata($status, $message);
		redirect(base_url() . $pageName, 'refresh');
	}

}
?>