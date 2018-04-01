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
		
	</div>
	<div id="files_panel">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Faili nimi</th>
					<th scope="col">Kontrollitud</th>
					<th scope="col">Eemalda</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($user_files as $file){
						echo '<tr>';
						echo "<td>$file[file_name]</td>";
						echo "<td>Ei</td>";
						echo "<td><a href=\"myaccount/removefile/$file[id]\" class=\"btn btn-dark\">Eemalda</a></td>";
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
</div>