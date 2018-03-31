
<div container="class">

<div class="row">
			
<div class="col-lg-6">
	<h3>Kontakt</h3><br>
	<p>Võta meiega otse ühendust:</p>

<?php
$xml=simplexml_load_file("http://localhost/fake-emails/assets/xml_files/kontaktvorm.xml");
echo $xml->nimi . "<br>";
echo $xml->email . "<br>";
echo $xml->aadress1 . "<br>";
echo $xml->aadress2;
?> 

</div>
</div>

</div>