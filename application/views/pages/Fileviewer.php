<?php
if($this->session->email == null){
	redirect("login", 'refresh');
}

if($file_data == null){
	redirect("myaccount", 'refresh');
}
?>

<div class="container">
	<h3>Fail sisemus</h3>
	<pre>
	<code>
		<?php echo $file_data ?>
	</code>
	</pre>
	<a href="<?php echo base_url(); ?>myaccount" class="btn btn-dark">Tagasi</a>
</div>