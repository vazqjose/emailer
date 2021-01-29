<?php
	session_start();
		
	if (!$_SESSION['staffid']) 
	{ 
		header("location:index.php");
		exit;
    } 
    else 
    {
    	header("location:campaigns_list.php");
    	exit;
    }

?>
