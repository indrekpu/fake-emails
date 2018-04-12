<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qrinfo";

//$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Couldnt connect');


$conn = new mysqli($servername, $username, $password, $dbname);

//$conn->set_charset("utf8");
//$conn->query("SET character_set_results=utf8");
$conn->query("SET NAMES 'utf8_unicode_ci'");


function escapeAllData($data, $dbc){
	$data = stripslashes($data);
	$data = htmlentities($data);
	$data = strip_tags($data);
	$data = mysqli_real_escape_string($dbc, $data);
	return $data;
}

function convert_smart_quotes($string) 
{ 
    $search = array(chr(145), 
                    chr(146), 
                    chr(147), 
                    chr(148), 
                    chr(151)); 

    $replace = array("'", 
                     "'", 
                     '"', 
                     '"', 
                     '-'); 

    return str_replace($search, $replace, $string); 
} 
?>