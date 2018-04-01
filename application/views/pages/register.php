<!-- this is test form for database testing -->

<p style="padding-bottom: 4ex"></p> 
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

		<p style="padding-bottom: 2ex"></p> 

		<input type="submit" name="submit">
	</form>
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