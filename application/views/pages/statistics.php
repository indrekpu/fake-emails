<div class="container">
	
	<h3>Brauserite kasutus</h3>
	<div class="col-md-6">
		<canvas id="browser_chart"></canvas>
	</div>
	<h3>Operatsioonisüsteemide kasutus</h3>
	<div class="col-md-6">
		<canvas id="platform_chart"></canvas>
	</div>
	<script src="<?php echo asset_url(); ?>js/charts.js"></script>
	<script>

		$(document).ready(function() {
			createPieChart("browser_chart", <?php echo json_encode($browser_labels); ?>, <?php echo json_encode($browser_values); ?>);
			createPieChart("platform_chart", <?php echo json_encode($platform_labels); ?>, <?php echo json_encode($platform_values); ?>);
		});
	</script>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">IP</th>
				<th scope="col">Asukoht</th>
				<th scope="col">Brauser</th>
				<th scope="col">Platform</th>
				<th scope="col">Aeg</th>
		</thead>
		

	</table>
	<div id="tableWrapper">
		<table class="table">
			<tbody id="ajaxResponse">
				
			</tbody>
		</table>
	</div>
	<button id="expandButton" class="btn-primary">Rohkem</button>
</div>

<script>
	$(document).ready(function(){
		
		$("#expandButton").click(function() {
			if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        } else {
	            // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        }
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	            	var result = "";
	            	var byTime = this.responseText.split("|");
	            	for(i = 0; i < byTime.length; i++){
	            		var temp = byTime[i].split(";");
	            		result += "<tr>";
	            		for(j = 0; j < temp.length; j++){
	            			result += "<td>" + temp[j] + "</td>";
	            		}
	            		result += "</tr>";
	            	}
	                document.getElementById("ajaxResponse").innerHTML = result;
	                $("#tableWrapper").slideDown("slow");
	            }
	        };
	        xmlhttp.open("GET","<?php echo base_url() . "statistics/statisticstable" ?>",true);
	        xmlhttp.send();
	     
	    });
	});
</script>