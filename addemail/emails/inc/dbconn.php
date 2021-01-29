<?php
$db=mysqli_connect("localhost","netskyis_mailing",",CSDT[6&[Hf=","netskyis_mailingdb");
//Check connection
if (mysqli_connect_errno()) {
	echo "Connect failed: %s\n", mysqli_connect_error($db);
	exit();
}
?>