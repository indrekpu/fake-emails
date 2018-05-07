<div class="container">

	<div id="data_panel">
		<h3>E-kirja informatsioon</h3>
		<div class="row pt-3">
			<div class="col-sm">
				<div class="row pt-1">
					<div class="col-sm">
						<span>Kuvatav aeg:</span>
					</div>
					<div class="col-sm">
						<span><?php echo $thread_index_date;?></span>
					</div>
				</div>
				<div class="row pt-1">
					<div class="col-sm">
						<span>Dekodeeritud aeg:</span>
					</div>
					<div class="col-sm">
						<span><?php echo $displayed_date;?></span>
					</div>
				</div>
				<div class="row pt-1">
					<div class="col-sm">
						<span>Ajavahemik:</span>
					</div>
					<div class="col-sm">
						<span><?php echo $date_diff;?></span>
					</div>
				</div>
				<div class="row pt-1">
					<div class="col-sm">
						<span>Riik:</span>
					</div>
					<div class="col-sm">
						<span><?php echo $originating_ip_country;?></span>
					</div>
				</div>
				<div class="row pt-1">
					<div class="col-sm">
						<span>Linn:</span>
					</div>
					<div class="col-sm">
						<span><?php echo $originating_ip_city;?></span>
					</div>
				</div>
				<div class="row pt-3">
					<h5 class="<?php if($is_faked_time) { echo "text-danger"; } else { echo "text-success"; } ?>">
						<?php if($is_faked_time) { echo 'E-kirja aega on tõenäoliselt muudetud!'; } else { echo 'E-kirja aega ei ole tõenäoliselt muudetud';} ?>
					</h5>
				</div>
			</div>
			<div class="col-sm">
				<h4>Asukoht</h4>
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