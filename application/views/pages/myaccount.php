<?php
if($this->session->email == null){ // kui kasutaja pole sisse logitud.
		$this->session->set_userdata('redirect', 'myaccount');
		redirect(base_url() . "login", 'refresh');
	}
?>

<div class="container">
	<p>Nimi: <?php echo $this->session->name;//Kasutaja info k2sitlemine. ?></p>
	<p>Email: <?php echo $this->session->email; ?></p>
</div>