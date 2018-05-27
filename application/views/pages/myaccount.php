<p style="padding-bottom: 4ex"></p> 

<?php
if($this->session->email == null){ // kui kasutaja pole sisse logitud.
		$this->session->set_userdata('redirect', 'myaccount');
		redirect(base_url() . "login", 'refresh');
	}
?>

<div class="container">
	<h3>Kasutaja informatsioon</h3>
	<div id="user_info_panel">
		<?php echo $this->session->flashdata('result'); ?>
		<p>Nimi: <?php echo $this->session->name;//Kasutaja info k2sitlemine. ?></p>
		<p>Email: <?php echo $this->session->email; ?></p>
		<p>Aktiveeritud: <?php if($user_info['activated']){ echo "Jah"; } else { echo "Ei"; } ?></p>
		<p><a href="myaccount/deleteaccount" class="btn btn-danger">Kustuta kasutaja</a></p>
		
	</div>
	<div id="files_panel">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Faili nimi</th>
					<th scope="col">Kontrollitud</th>
					<th scope="col">Eemalda ja kuva</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($user_files as $file){
						echo '<tr>\n';
						echo "<td>$file[file_name]</td>\n";
						echo "<td>Ei</td>\n";
						echo "<td><a href=\"myaccount/removefile/$file[id]\" class=\"btn btn-danger\">Eemalda</a><button onclick=\"showFile('$file[file_name]')\" class=\"btn btn-info ml-3\">Kuva</button></td>\n";
						echo "<td><a href=\"analyse/fileAnalyse/$file[file_name]\" class=\"btn btn-success\">Analüüsi</a></td>";
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
	<div id="file_viewer_panel">
		<h3>Fail: <span id="file_name_title"></span></h3>
		<pre>
		<code id="file_data_code">
		
		</code>
		</pre>
		<button onclick="$('#file_viewer_panel').slideUp('600')" class="btn btn-dark">Tagasi</a>
	</div>
</div>

<script>


function showFile(fileName){
	var fileContents = [];
	<?php
		foreach($files_data as $fileName => $contents){
			echo "fileContents['$fileName'] = " . $this->db->escape($contents) . ";\n";
		}
	?>
	if($("#file_viewer_panel").is(":visible")){
		$("#file_viewer_panel").slideUp("600", function(){
			$("#file_data_code").text(fileContents[fileName]);
			$("#file_name_title").text(fileName);
			$("#file_viewer_panel").slideDown("600", function(){});
		});
	} else {
		$("#file_data_code").text(fileContents[fileName]);
		$("#file_name_title").text(fileName);
		$("#file_viewer_panel").slideDown("600", function(){});
	}
}
</script>