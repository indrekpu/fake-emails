<?php

class Analyse extends CI_Controller{

	private $allowedFileTypes = "msg|txt";
	private $maxFileSize = 2 * 1000 * 1000; //MegaBytes
	private $directory = "./assets/uploads/";


	public function upload(){

		$config = array(
		'upload_path' => $this->directory,
		'allowed_types' => $this->allowedFileTypes,
		'overwrite' => TRUE,
		'max_size' => $this->maxFileSize
		);
		$this->load->library('upload', $config);

		if(!$this->upload->do_upload('email_file')) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('result', $error);
			redirect(base_url() . "analyse", 'refresh');
		} else {
			$success = array('success');
			$this->session->set_flashdata('result', $success);
			redirect(base_url() . "analyse", 'refresh');
		}
	}

}

?>