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
	
	<div class="h-100 row justify-content-center align-items-center">
		<form name="register" action="<?php echo base_url(); ?>register/submit" method="POST" class="col col-lg-3" id="register_form">
			<div class="row justify-content-center pb-3">
				<span id="register_form_header">Registreeri kasutaja</span>
			</div>
			
			<div class="pt-3">
				<input type="text" class="form-control" name="full_name" placeholder="Nimi" id="form_name">
			</div>
			

			<div class="pt-3">
				<input type="text" class="form-control" name="email" placeholder="Email" id="form_email" <?php if($this->session->flashdata('email') != null) { echo "value=\"" .  $this->session->flashdata('email') . '"'; } ?>>
			</div>

			<div class="pt-3">
				<input type="password" class="form-control" name="passwd" placeholder="Parool" id="form_password">
			</div>

			<div class="pt-3">
				<input type="password" class="form-control" name="confirm_passwd" placeholder="Kinnita parool" id="form_confirm_password">
			</div>

			<div class="pt-3">
				<input type="submit" class="btn btn-dark btn-block" name="submit" value="Registreeri">
			</div>

			<!-- Adding a pop-up that explains terms and conditions for the users -->

			<div class="popup pt-3" onclick="kasutamisTingimused()">Kasutamistingimusi loe siit!
			  <span class="popuptext" id="kasutamisPopUp">Kasutades fake-emailsi nõustud kasutustingimustega. Keskkonda üleslaetud e-maile kasutatakse ainult saatmiskuupäeva ja IP-aadressi analüüsiks. Nende sisu ei salvestata, ega kasutata millekski muuks.</span>
			</div> 

			<div id="reg_form_message_container">
				
			</div>

		</form>
	</div>
</div>




<!-- Here is the JS to show the pop-up -->

<script>
// When the user clicks on <div>, open the popup
function kasutamisTingimused() {
    var popup = document.getElementById("kasutamisPopUp");
    popup.classList.toggle("show");
}

$(document).ready(function(){
	addNameFieldChangeListener("#form_name");
	addEmailFieldChangeListener("#form_email");
	addPasswordFieldChangeListener("#form_password");
	addPasswordFieldChangeListener("#form_confirm_password");
	
});
</script>