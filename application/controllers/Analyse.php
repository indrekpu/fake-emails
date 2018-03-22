<?php

class Analyse extends CI_Controller{


	public function upload($field){
		$this->load->model('file_handler');


		if(!empty($_FILES[$field])){
			$file = $_FILES[$field];
			
			$result = $this->file_handler-uploadFile($file);
			if(empty($result)){

			}


		} else {
			//redirect with error.
		}
	}

}

?>