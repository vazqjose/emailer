<?php

session_start();							

	if ($_POST['Login'])		
	{
		include 'db/db.php';
		$email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
		$pass = mysqli_real_escape_string($conn, $_POST['password']);
	        
        $querystring = "SELECT * FROM staff WHERE email='$email' AND password='$pass'";
            
		$loginquery = mysqli_query($conn, $querystring) or die ("Error-> ".mysql_error());
			
			if (mysqli_num_rows($loginquery) > 0) 	{
				
				$lastlogin = date('Y-m-d');
                $updatequerystring = "UPDATE staff SET lastlogin='$lastlogin' WHERE email='$email' AND password='$pass'";
				
				mysqli_query($conn, $updatequerystring) or die(mysqli_error($conn));
				
				$loginrow = mysqli_fetch_assoc($loginquery) or die(mysqli_error($conn));
		
				$_SESSION['staffid'] = $loginrow['id'];				
				$_SESSION['name'] = $loginrow['name'];
				$_SESSION['email'] = $loginrow['email'];
				$_SESSION['password'] = $loginrow['password'];
				$_SESSION['title'] = $loginrow['nombre']." logged in (".$_SERVER['HTTP_HOST'].")";
				$_SESSION['path'] = 'uploads/';
				header('location:campaigns_list.php');
				exit;
			
			} else {
				
				$msg = 'Incorrect user details';
				$msgType = 'alert-danger';
				$msgIcon = 'fas fa-exclamation-triangle';
				header('location:index.php?msg='.$msg.'&msgType='.$msgType.'&msgIcon='.$msgIcon);
				exit;		
			}
	} 
		else if ($_POST['RecoverPassw'])	// RECOVER USER DETAILS
	{
		header('location:recoverpassword.php');
		exit;
	} 
		else // MAIN IF
	{
				
				header('location:index.php');
				exit;
	}
	
?>