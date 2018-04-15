
<p style="padding-bottom: 4ex"></p> 
<?php
	if($this->session->email == null){ // kui kasutaja pole sisse logitud.
		$this->session->set_userdata('redirect', 'analyse');
		redirect(base_url() . "login", 'refresh');
	}
?>
<div class="container">
	Analüüsimise leht
	<div class="form_container row justify-content-center align-items-center">
		<?php echo form_open_multipart('analyse/upload'); ?>
			<p>Lae ülesse fail: </p>
			<div class="custom-file">
				<input type="file" class="custom-file-input" name="email_file">
				<label class="custom-file-label" for="customFile">Vali fail</label>
			</div>
			<input type="submit" class="btn btn-dark" name="submit" value="Lae">
		</form>
	</div>
	<p><?php $result = $this->session->flashdata('result');
		if($result != null){
			foreach($result as $res){
				if($res == 1){
					echo 'Fail serveri laetud!';
				} else if($res == 0){
					echo 'Error';
				} else {
					echo $res . "<br>";
				}
			}
		}
	?></p>
</div>

 <div id="map" style="width:100%;height:600px;"></div>

<?php

$ip_address = $_SERVER['REMOTE_ADDR'];
$arr_location = file_get_contents(("http://freegeoip.net/json/$ip_address"));
$json = json_decode($arr_location,true); 



$latitude = $json['latitude'] . PHP_EOL;
$longitude = $json['longitude'] . PHP_EOL;




?>


    <script>
      function initMap() {
        var uluru = {lat: <?php echo $latitude; ?>, lng:<?php echo $longitude; ?>};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>


    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABaqlhzO7qecXtqVbB9Aw4SnmRb6cnp5g&callback=initMap">
    </script>


