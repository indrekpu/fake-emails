<?php
class Contact extends CI_Controller{

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