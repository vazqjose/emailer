<?php

$servername = 'localhost';//
$username = 'vazqjose_netsky';	//
$password = '456011';// 
$database = 'vazqjose_netskyis_mailingdb';	//

/* Database Stuff, do not modify below this line */

// Create connection
$conn = mysqli_connect("$servername", "$username", "$password", "$database");

// Check connection
if (mysqli_connect_errno())
{
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>