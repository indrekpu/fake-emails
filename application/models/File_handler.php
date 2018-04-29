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

	public function getUserFileNames($userId){
		$userId = $this->db->escape_str($userId);
		$result = $this->db->query("SELECT file_name FROM files_view WHERE owner_id=$userId");
		return $result->result_array();
	}

	public function getUserAllFileContents($userId){
		$fileNames = $this->getUserFileNames($userId);

		$fileContents = array();
		foreach($fileNames as $row){
			$fileContents[$row['file_name']] = $this->getFileContents($row['file_name'], $userId);
		}
		return $fileContents;
	}

	public function getDataByParameter($fileContents, $param){
		preg_match("%$param: .+%", $fileContents, $matches);
		if(empty($matches)){
			return false;
		}
		return explode(": ", $matches[0])[1];
	}

}

?>