<p style="padding-bottom: 4ex"></p> 

<?php echo $this->session->flashdata('success'); //when registration was successful, user is redirected to here with success msg. ?>
<div class="container">
	<!-- Form to test login system. -->
	<div id="login_form_container" class="row justify-content-md-center">
		<form name="login" action="<?php echo base_url(); ?>login/submit" method="POST" class="col col-lg-3">
			<div class="row">
				<div class="col col-lg-1 login_label"><span>Email:</span></div>
				<div class="col col-lg-10"><input type="text" class="form-control" name="email"></div>
				
			</div>
			<div class="row pt-3">
				<div class="col col-lg-1 login_label"><span>Parool:</span></div>
				<div class="col col-lg-10"><input type="password" class="form-control" name="password"></div>
			</div>

			<p style="padding-bottom: 2ex"></p> 
			<input id="login_form_submit" class="btn btn-dark" type="submit" name="submit" value="Logi">

			
			<!--<fb:login-button 
			  scope="public_profile,email"
			  onlogin="checkLoginState();">
			</fb:login-button>-->

			<?php
				$redirect = $this->session->redirect;
				if($redirect != null){
					echo "<input name=\"redirect\" value=\"$redirect\" type=\"hidden\">";
				}
			?>
		</form>
	</div>
</div>