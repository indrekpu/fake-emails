<?php
class Pages extends CI_Controller {

        public function view($page = 'home')
        {
			if(!isset($this->session->statistics)){
	    		$this->load->model('statistics_model');
	    		$this->load->model('data_request');
	    		
	    		$ipInformation = $this->data_request->getUrlContents($this->statistics_model->getIp());

	    		if(isset($ipInformation['country_name']) && $this->statistics_model->getIp() != "127.0.0.1"){
	    			$this->statistics_model->insertStatistics($ipInformation['country_name']);
	    		}

	    		$this->session->set_userdata('statistics', 'true');
	    	}

			if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
			{
				 // Whoops, we don't have a page for that!
				show_404();
			}

			$headerData = array();//Title, language, description, keywords
	    	$headerData['title'] = "Kodu";
	    	$headerData['lang'] = "et";
			$headerData['description'] = "Koduleht, pealeht";
			$headerData['keywords'] = "home page, koduleht, pealeht, esileht, fake-emails, e-kirjade analüüs, analüüsimine";

			$data['title'] = ucfirst($page); // Capitalize the first letter

			$this->load->view('templates/header', $headerData);
			if($this->session->userdata('name') != null){
				$this->load->view('templates/navbar-logged', $data);
			} else {
				$this->load->view('templates/navbar-not-logged', $data);
			}
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer', $data);

        }

}
?>