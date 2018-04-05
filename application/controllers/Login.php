<?php
class Login extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('url_helper');
	}

	public function index($data=NULL){
		
	}

	public function submit(){
		$formData = $this->input->post();
		$email =  $this->input->post("email");
		$password =  $this->input->post("password");

		$this->load->model('user');
		$result = $this->user->loginUser($email, $password);

		if($result){
			if($this->input->post("redirect") != null){ //For melding purpose we check if the redirect value is assigned.
				$this->session->unset_userdata('redirect'); 
				redirect(base_url() . $this->input->post("redirect"), 'refresh');
			} else {
				redirect(base_url(), 'refresh');
			}
		} else {
			$this->session->set_flashdata('success', 'Kontrolli väljasid!');
			redirect(base_url() . 'login', 'refresh');
		}
	}

	public function logout(){
		session_destroy();
		redirect(base_url(), 'refresh');
	}

	public function fbLogin(){
		$fb = new \Facebook\Facebook([
			'app_id' => '163711774288814',
			'app_secret' => '766dba50bd054df89e9b3ca8881bc2f3',
			'default_graph_version' => 'v2.12' 
		]);

		try {
		  $response = $fb->get('/me', '{access-token}');
		} catch(\Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(\Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		$me = $response->getGraphUser();
		echo 'Logged in as ' . $me->getName();
	}

}
?>