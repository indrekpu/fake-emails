<?php

class Myaccount extends CI_Controller {
	
	public function activateAccount($verificationCode){
		$this->load->model('user');

		if($this->user->activateUser($verificationCode)){
			$this->session->set_flashdata('success', "Kasutaja aktiveeritud!");
			redirect(base_url() . "login", 'refresh');
		}
		$this->session->set_flashdata('failure', "Kasutaja juba aktiveeritud või ei eksisteeri!");
		redirect(base_url() . "login", 'refresh');
	}

}

?>