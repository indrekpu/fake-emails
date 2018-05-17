<?php

class Analyse extends CI_Controller{

	private $allowedFileTypes = "*";
	private $maxFileSize = 2 * 1000 * 1000; //MegaBytes
	private $directory = "./assets/uploads/";


	public function view(){

		if(!isset($this->session->statistics)){
    		$this->load->model('statistics_model');
    		$this->load->model('data_request');
    		
    		$ipInformation = $this->data_request->getUrlContents($this->statistics_model->getIp());

    		if(isset($ipInformation['country_name']) && $this->statistics_model->getIp() != "127.0.0.1"){
    			$this->statistics_model->insertStatistics($ipInformation['country_name']);
    		}

    		$this->session->set_userdata('statistics', 'true');
    	}

    	$headerData = array();//Title, language, description, keywords
    	$headerData['title'] = "E-kirja analüüsimine ja laadimine";
    	$headerData['lang'] = "et";
		$headerData['description'] = "Kasutaja e-kirja analüüsimine ning kasutaja võimalus laadida e-kirja serveri";
		$headerData['keywords'] = "E-kiri, email, analüüsimine, tuvastamine, upload, ülesse laadmine";
    	


		$this->load->view('templates/header', $headerData);
		if($this->session->userdata('name') != null){
			$this->load->view('templates/navbar-logged');
		} else {
			$this->load->view('templates/navbar-not-logged');
		}
		$this->load->view('pages/analyse');
		$this->load->view('templates/footer');
	}	

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

	public function fileAnalyse($fileName){
		$this->load->model('file_handler');

		$fileContents = $this->file_handler->getFileContents($fileName, $this->session->id);
		$threadIndexValue = $this->file_handler->getDataByParameter($fileContents, 'Thread-Index');
		$dateValue = $this->file_handler->getDataByParameter($fileContents, 'Date');

		$originatingIp = $this->file_handler->getDataByParameter($fileContents, 'x-originating-ip');
		
		$data = array();

		preg_match('/\[(.*?)\]/', $originatingIp, $match);
		if(isset($match[1])){
			$originatingIp = $match[1];
			$arr_location = file_get_contents(("http://freegeoip.net/json/$originatingIp"));
			$json = json_decode($arr_location,true); 
			$data['originating_ip'] = $originatingIp;
			$data['originating_ip_country'] = $json['country_name'];
			$data['originating_ip_city'] = $json['city'];
			$data['originating_ip_latitude'] = $json['latitude'];
			$data['originating_ip_longitude'] = $json['longitude'];
		} else {
			$data['originating_ip'] = "-";
			$data['originating_ip_country'] = "-";
			$data['originating_ip_city'] = "-";
			$data['originating_ip_latitude'] = "0";
			$data['originating_ip_longitude'] = "0";
		}

		

		

		if(empty($threadIndexValue)){
			$data['thread_index_date'] = "Ei leidnud thread-index välja!";

		} else {
			$threadIndexDecoded = $this->decodeThreadIndex($threadIndexValue);
			$threadIndexDate = date_create_from_format("Y-m-d H:i:s.u", $threadIndexDecoded, new DateTimeZone('+0000'));
			$data['thread_index_date'] = $threadIndexDate->format('d/m/Y H:i:s');
		}

		if(empty($dateValue)){
			$data['displayed_date'] = "Ei leidnud kuupäeva välja!";
		} else {
			$dateValue = trim($dateValue);
			$displayedDate = date_create_from_format("D, d M Y H:i:s O", $dateValue);
			$data['displayed_date'] = $displayedDate->format('d/m/Y H:i:s');
		}
		
		if(!empty($dateValue) && !empty($threadIndexValue)){
			$dateDiff = date_diff($threadIndexDate, $displayedDate);
			$data['date_diff'] = $dateDiff->format('%d päeva %h tundi %i minutit %s sekundit');
			if($dateDiff->y == 0 && $dateDiff->m == 0 && $dateDiff->d == 0 && $dateDiff->h == 0 && $dateDiff->i <= 5){
				$data['is_faked_time'] = "false";
			} else {
				$data['is_faked_time'] = "true";
			}
		} else {
			$data['date_diff'] = "-";
			$data['is_faked_time'] = "Unknown";
		}
		
		
		
		
		
		
		
		

		


		
		//Loading view
		$headerData = array();//Title, language, description, keywords
    	$headerData['title'] = "Tulemus";
    	$headerData['lang'] = "et";
		$headerData['description'] = "Kasutaja e-kirja analüüsimine ning kasutaja võimalus laadida e-kirja serveri";
		$headerData['keywords'] = "E-kiri, email, analüüsimine, tuvastamine, upload, ülesse laadmine";

		$this->load->view('templates/header', $headerData);
		$this->load->view('templates/navbar-logged');
		
		$this->load->view('pages/results', $data);
		$this->load->view('templates/footer');

	}

	public function decodeThreadIndex($threadIndexValue){
		$pythonLocation = "C:\Python\python.exe"; 
		$pythonCommand = escapeshellcmd("C:/xampp/htdocs/fake-emails/assets/python/thread.py $threadIndexValue");
		exec("$pythonLocation $pythonCommand", $output);
		return $output[0];
	}

}

?>