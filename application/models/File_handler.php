<?php

class FileHandler extends CI_Model {
	
	private $allowedFileTypes = array('txt', 'msg', '...');
	public $maxFileSize = 2 * 1000 * 1000; //MegaBytes
	private $directory = asset_url() . "uploads";

	public function uploadFile($file, $location = $this->directory){
		$errors = [];

		if($file['size'] > $this->maxFileSize){
			$errors[] = "File size is more than allowed."
		}
		

		$matches = preg_grep('%\.[A-Za-z]+$%', array($file['name']))

		if(!in_array($matches[0], $allowedFileTypes)){
			$errors[] = "This file type is not allowed."
		}


		if(empty($file['error'])){
			$result = move_uploaded_file($file['name'], $location);
			if($result){
				return $errors;
			} 
			$errors[] = "Upload failed!";
			return $errors;
		}
		return $errors;
	}

}

?>