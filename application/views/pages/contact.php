<div class="container">

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


	<div class="row">			
		<div class="col-lg-6">
			<h3>Kontakt</h3><br>
			<p>Võta meiega otse ühendust:</p>
			<!-- The information that will be shown in the contact details will come from a xml-file that will be parsed using php and its ready-made elements -->
		<?php
		$feed = new SimpleXMLElement("http://localhost/fake-emails/assets/xml_files/kontaktvorm.xml",NULL,TRUE);
						$namespaces = $feed->getNamespaces(true);
						
						$getChildren=$feed->children($namespaces["s"]);
						echo $getChildren->nimi."<br>";
						echo $getChildren->email."<br>";
						echo $getChildren->aadress1."<br>";
						echo $getChildren->aadress2."<br>";
		?> 

		</div>
		<div class="col-lg-6">
			 <div id="map" style="width:100%;height:300px;"></div>

			  <script>
			      function initMap() {
			        var uluru = {lat: 58.378251, lng: 26.714637};

			        var map = new google.maps.Map(document.getElementById('map'), {
			          zoom: 12,
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

	<div class="row mt-3">
		 <div class="col-md-6">
        
          <form class="form-horizontal" action="<?php echo base_url(); ?>contact/submit" method="post">
          <fieldset>
            <h4 class="text-center">Kontakteeru meiega!</h4>
    
            <!-- Name input-->
            <div class="form-group pt-3">
              <label class="col-md-3 control-label">Nimi</label>
              <div class="col-md-9">
                <input name="name" type="text" placeholder="Nimi" class="form-control" id="contact_form_name">
              </div>
            </div>
    
            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label">Email</label>
              <div class="col-md-9">
                <input name="email" type="text" placeholder="Email" class="form-control" id="contact_form_email">
              </div>
            </div>
    
            <!-- Message body -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="message">Sõnum</label>
              <div class="col-md-9">
                <textarea class="form-control" id="message" name="message" placeholder="Sisesta oma sõnum siia" rows="5"></textarea>
              </div>
            </div>
    
            <!-- Form actions -->
            <div class="form-group">
              <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-primary btn-lg">Saada!</button>
              </div>
            </div>
          </fieldset>
          </form>
        </div>
	</div>
</div>












