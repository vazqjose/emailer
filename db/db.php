<?php

$servername = 'localhost';//
$username = 'vazqjose_netsky';	//
$password = '456011';// 
$database = 'vazqjose_netskyis_mailingdb';	//

/* Database Stuff, do not modify below this line */
//die('Message inserted right before the mysqli_connect function');
// Create connection
$conn = mysqli_connect("$servername", "$username", "$password", "$database");

// Check connection
if (!$conn)
{
	printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>