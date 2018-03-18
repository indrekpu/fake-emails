<!-- this is test form for database testing -->
<div class="container">
	<?php echo $this->session->flashdata('failure'); ?>
	<form name="register" action="<?php echo base_url(); ?>register/submit" method="POST">
		<div>
			<span class="register_label">Nimi:</span>
			<input type="text" name="full_name">
		</div>

		<div>
			<span class="register_label">Email:</span>
			<input type="text" name="email">
		</div>

		<div>
			<span class="register_label">Parool:</span>
			<input type="password" name="passwd">
		</div>

		<div>
			<span class="register_label">Kinnita parool:</span>
			<input type="password" name="confirm_passwd">
		</div>

		<input type="submit" name="submit">
	</form>
</div>