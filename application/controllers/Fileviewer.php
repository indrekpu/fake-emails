<?php
class Fileviewer extends CI_Controller{
	
	
	public function showFile($fileId){
		$this->load->model('file_handler');
		$this->load->model('user');

		$result = $this->file_handler->getFileContents($this->user->getFileName($fileId), $this->session->id);

		$data = array();
		$data['file_data'] = $result;

		$this->load->view('templates/header');
		if($this->session->userdata('name') != null){
			$this->load->view('templates/navbar-logged');
		} else {
			$this->load->view('templates/navbar-not-logged');
		}
		$this->load->view('pages/fileviewer', $data);
		$this->load->view('templates/footer');
	}

}

?>