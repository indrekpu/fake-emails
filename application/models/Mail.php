<?php

class Mail extends CI_Model {

	private $from;
	private $headers;

	public function __construct(){
		parent::__construct();
		$this->from = "fakeemailsproject@gmail.com";
		$this->headers = 'MIME-Version: 1.0' . "\r\n" . 'From: Fake Emails <fakeemailsproject@gmail.com>' . "\r\n" .'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	}


	public function sendMail($reciver, $subject, $message){
		mail($reciver, $subject, $message, $this->headers);
	}

	public function sendVerification($userEmail, $verificationCode){
		$message = "Registreerimise kinnitus link: " . base_url() . "myaccount/activateAccount/" . $verificationCode;
		$this->sendMail($userEmail, "Kinnitus", $message);
	}

}

?>