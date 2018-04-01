
<p style="padding-bottom: 4ex"></p> 
<div container="class">

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
</div>

</div>