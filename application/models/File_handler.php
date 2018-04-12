<?php

class File_handler extends CI_Model {
	
	private $allowedFileTypes = array('txt', 'msg', '...');
	public $maxFileSize = 2 * 1000 * 1000; //MegaBytes
	private $directory = "./assets/uploads/";

	public function getFileContents($fileName, $userId){
		$fileLocation = $this->directory . $userId . "/" . $fileName;
		$file = $this->getFile($fileLocation);

		return fread($file, filesize($fileLocation));
	}

	public function getFile($fileLocation){
		return fopen($fileLocation, "r");
	}

}

?>