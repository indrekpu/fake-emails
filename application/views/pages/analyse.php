<?php
	if($this->session->email == null){ // kui kasutaja pole sisse logitud.
		$this->session->set_userdata('redirect', 'analyse');
		redirect(base_url() . "login", 'refresh');
	}
?>
<div class="container">
	Analüüsimise leht
	<div class="form_container">
		<?php echo form_open_multipart('analyse/upload'); ?>
			<p>Lae ülesse fail: <input type="file" name="email_file"></p>
			<input type="submit" name="submit">
		</form>
	</div>
	<p><?php $result = $this->session->flashdata('result');
		if($result != null){
			foreach($result as $res){
				echo $res . "<br>";
			}
		}
	?></p>
</div>