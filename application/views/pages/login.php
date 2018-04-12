<?php
$this->fb = new \Facebook\Facebook([
	'app_id' => '163711774288814',
	'app_secret' => '766dba50bd054df89e9b3ca8881bc2f3',
	'default_graph_version' => 'v2.2' 
]);

$helper = $this->fb->getRedirectLoginHelper();

$permissions = ['email'];
$loginUrl = $helper->getLoginUrl('https://www.medesteetika.ee/temp/fake-emails/login/fbcallback', $permissions);

?>

<div class="container">
	<script src="<?php echo asset_url(); ?>js/field_validator.js"></script>
	
	  <?php 
	  	if($this->session->flashdata('success') != null){
	  		echo "<div class=\"alert alert-success\"><strong>Õnnestus!</strong> ";
	  		echo $this->session->flashdata('success');
	  		echo "</div>";
	  	}
	  	if($this->session->flashdata('failure') != null){
	  		echo "<div class=\"alert alert-danger\"><strong>Hoiatus!</strong> ";
			echo $this->session->flashdata('failure');
			echo "</div>";
	  	}
	  ?>
	

	<!-- Form to test login system. -->
	<div id="login_form_container" class="h-100 row justify-content-center align-items-center">
		<form name="login" action="<?php echo base_url(); ?>login/submit" method="POST" class="col col-lg-3" id="login_form">
			<div class="row justify-content-center pb-3">
				<span id="login_form_header">Logi sisse oma kasutajasse</span>
			</div>
			<div class="pt-3">
				<input type="text" class="form-control" name="email" placeholder="Email" id="login_form_email">
			</div>
			<div class="pt-3">
				<input type="password" class="form-control" name="password" placeholder="Parool" id="login_form_password">
			</div>
			
			<div class="pt-3">
				<input id="login_form_submit" class="btn btn-dark btn-block" type="submit" name="submit" value="Logi">
			</div>
			
				<?php //echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with facebook!</a>'; ?>
			<div class="pt-3">	
				<a class="loginBtn loginBtn--facebook" <?php echo 'href="' . htmlspecialchars($loginUrl) . '"';?>>
				  Login with Facebook
				</a>
			</div>

			<div class="pt-3">
				<a href="register">Registreeri</a>
			</div>
			<?php
				$redirect = $this->session->redirect;
				if($redirect != null){
					echo "<input name=\"redirect\" value=\"$redirect\" type=\"hidden\">";
				}
			?>
		</form>
	</div>
</div>
<script>
$(document).ready(function(){
	addEmailFieldChangeListener("#login_form_email");
	addPasswordFieldChangeListener("#login_form_password");
});
</script>
