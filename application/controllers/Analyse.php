<?php

class Analyse extends CI_Controller{

	private $allowedFileTypes = "msg|txt";
	private $maxFileSize = 2 * 1000 * 1000; //MegaBytes
	private $directory = "./assets/uploads/";


	public function upload(){
		$this->load->model('user');

		
		$config = array(
		'upload_path' => $this->directory . $this->session->id,
		'allowed_types' => $this->allowedFileTypes,
		'overwrite' => FALSE,
		'max_size' => $this->maxFileSize
		);
		$this->load->library('upload', $config);

		if(!is_dir($this->directory . $this->session->id)){
			mkdir($this->directory . $this->session->id);
		}

		if(!$this->upload->do_upload('email_file')) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('result', $error);
			redirect(base_url() . "analyse", 'refresh');
		} else {
			$fileData = $this->upload->data();
			$fileName = $fileData['file_name'];
			$result = $this->user->addFileToUser($this->session->email, $fileName);
			
			$success = array($result);
			$this->session->set_flashdata('result', $success);
			redirect(base_url() . "analyse", 'refresh');
		}
	}

}

?>