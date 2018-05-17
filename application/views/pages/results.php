<div class="container">

	<div id="data_panel">
		<h2>E-kirja informatsioon</h2>
		<div class="row pt-3">
			<div class="col-sm">
				<div class="row pt-1">
					<div class="col-sm">
						<span class="lead">E-kirjas kuvatav aeg:</span>
					</div>
					<div class="col-sm">
						<span class="lead"><?php echo $thread_index_date;?></span>
					</div>
				</div>
				<div class="row pt-1">
					<div class="col-sm">
						<span class="lead">Tegelik aeg:</span>
					</div>
					<div class="col-sm">
						<span class="lead"><?php echo $displayed_date;?></span>
					</div>
				</div>
				<div class="row pt-1">
					<div class="col-sm">
						<span class="lead">Ajavahemik:</span>
					</div>
					<div class="col-sm">
						<span class="lead"><?php echo $date_diff;?></span>
					</div>
				</div>
				<div class="row pt-1">
					<div class="col-sm">
						<span class="lead">Riik:</span>
					</div>
					<div class="col-sm">
						<span class="lead"><?php echo $originating_ip_country;?></span>
					</div>
				</div>
				<div class="row pt-1">
					<div class="col-sm">
						<span class="lead">Linn:</span>
					</div>
					<div class="col-sm">
						<span class="lead"><?php echo $originating_ip_city;?></span>
					</div>
				</div>
				<div class="row pt-3">
					<h3 class="<?php if($is_faked_time == "true") { echo "text-danger"; } else { echo "text-success"; } ?>">
						<?php 
						if($is_faked_time != "Unknown"){
							if($is_faked_time == "true") { 
								echo 'E-kirja aega on tõenäoliselt muudetud!'; 
							}
						 	else { 
						 		echo 'E-kirja aega ei ole tõenäoliselt muudetud';
						 	} 
					 	}
						 ?>
					 	
					</h3>
				</div>
			</div>
			<div class="col-sm">
				<h2>Asukoht</h2>
				<div id="map" style="width:100%;height:300px;"></div>

			  <script>
			      function initMap() {
			        var uluru = {lat: <?php echo $originating_ip_latitude; ?>, lng: <?php echo $originating_ip_longitude; ?>};

			        var map = new google.maps.Map(document.getElementById('map'), {
			          zoom: 6,
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



			</div>
		</div>
	</div>
	
	<div id="map_view">

	</div>

</div>