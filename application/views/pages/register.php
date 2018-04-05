<!-- this is test form for database testing -->

<p style="padding-bottom: 4ex"></p> 
<div class="container">
	<?php echo $this->session->flashdata('failure'); ?>
	<div id="login_form_container" class="row justify-content-md-center">
		<form name="register" action="<?php echo base_url(); ?>register/submit" method="POST" class="col col-lg-3">
			<div class="row">
				<div class="col col-lg-1"><span class="register_label">Nimi:</span></div>
				<div class="col col-lg-10"><input type="text" class="form-control" name="full_name"></div>
			</div>

			<div class="row">
				<div class="col col-lg-1"><span class="register_label">Email:</span></div>
				<div class="col col-lg-10"><input type="text" class="form-control" name="email"></div>
			</div>

			<div class="row">
				<div class="col col-lg-1"><span class="register_label">Parool:</span></div>
				<div class="col col-lg-10"><input type="password" class="form-control" name="passwd"><small>Vähemalt 6 karakterit pikk!</small></div>
			</div>

			<div class="row">
				<div class="col col-lg-1"><span class="register_label">Kinnita parool:</span></div>
				<div class="col col-lg-10"><input type="password" class="form-control" name="confirm_passwd"></div>
			</div>

			<p style="padding-bottom: 2ex"></p> 

			<div class="row"><input type="submit" class="btn btn-dark" name="submit"></div>
		</form>
	</div>
</div>


<p style="padding-bottom: 10ex"></p> 
<!-- Adding a pop-up that explains terms and conditions for the users -->

 <div class="popup" onclick="kasutamisTingimused()">Kasutamistingimusi loe siit!
  <span class="popuptext" id="kasutamisPopUp">Kasutades fake-emailsi nõustud kasutustingimustega. Keskkonda üleslaetud e-maile kasutatakse ainult saatmiskuupäeva ja IP-aadressi analüüsiks. Nende sisu ei salvestata, ega kasutata millekski muuks.</span>
</div> 


<!-- Here is the JS to show the pop-up -->

<script>
// When the user clicks on <div>, open the popup
function kasutamisTingimused() {
    var popup = document.getElementById("kasutamisPopUp");
    popup.classList.toggle("show");
}
</script>