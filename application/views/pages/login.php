<p style="padding-bottom: 4ex"></p> 

<?php echo $this->session->flashdata('success'); //when registration was successful, user is redirected to here with success msg. ?>
<div class="container">
	<!-- Form to test login system. -->
	<form name="login" action="<?php echo base_url(); ?>login/submit" method="POST">
		<div>
			<span class="login_label">Email:</span>
			<input type="text" name="email">
		</div>
		<div>
			<span class="login_label">Parool:</span>
			<input type="password" name="password">
		</div>

		<p style="padding-bottom: 2ex"></p> 
		<input id="login_form_submit" type="submit" name="submit">
		<?php
			$redirect = $this->session->redirect;
			if($redirect != null){
				echo "<input name=\"redirect\" value=\"$redirect\" type=\"hidden\">";
			}
		?>
	</form>
</div>