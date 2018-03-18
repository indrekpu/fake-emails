<?php
class Register extends CI_Controller{

	public function index($data = NULL){
		
	}

	public function submit(){
		$formData = $this->input->post();
		$name =  $this->input->post("full_name");
		$email =  $this->input->post("email");
		$password =  $this->input->post("passwd");
		$confirmPassword =  $this->input->post("confirm_passwd");

		if($password != $confirmPassword){
			$this->session->set_flashdata('failure', "Parool ei uhti.");
			redirect(base_url() . 'register', 'refresh');
		}

		$this->load->model('user');

		if(!$this->user->doesUserExist($email)){
			$this->session->set_flashdata('failure', "Selle emailiga on juba registreeritud.");
			redirect(base_url() . 'register', 'refresh');
		}
		
		$result = $this->user->createUser($name, $email, "", "", $password);

		$this->load->helper('url');

		if($result){
			echo 'successful' . $result;
			$this->session->set_flashdata("success", "Registeerimine 6nnestus!");
			redirect('login', 'refresh');
		} else {
			echo 'failed' . $result;
			redirect(base_url(), 'refresh');
		}
		

		echo "$name - $email - $password - $confirmPassword";

		//redirect
	}

}
?>