<?php
include_once "db/db.php";

// Include library file
require_once 'VerifyEmail.class.php'; 

// Initialize library class
$mail = new VerifyEmail();

// Set the timeout value on stream
$mail->setStreamTimeoutWait(20);

// Set debug output mode
$mail->Debug= TRUE; 
$mail->Debugoutput= 'html'; 

// Set email address for SMTP request
$mail->setEmailFrom('jessica@netskyis.com');

$table = 'recipients_notfound';
$tableto = 'emails';

$recipient_query = mysqli_query($conn, "SELECT id,email FROM $table WHERE email LIKE '%@yahoo.com' ") or die(mysqli_error($conn));
/*
echo (mysqli_num_rows($recipient_query));
exit;
*/
        while ($recipient_row = mysqli_fetch_assoc($recipient_query)) 
        {   
            $id = $recipient_row['id'];
            $email = $recipient_row['email'];		// Email to check

			// Check if email is valid and exist
			if($mail->check($email))
			{ 
			    $messages[] = 'Email &lt;'.$email.'&gt; exists!';
			  //  mysqli_query($conn, "INSERT INTO recipients (email) VALUES ('$email')") or die('error: '.mysqli_error($conn));
			  //  mysqli_query($conn, "DELETE FROM $table WHERE id = '$id'") or die('error: '.mysqli_error($conn));
			}
			elseif(verifyEmail::validate($email))
			{
			    $messages[] = 'Email &lt;'.$email.'&gt; is valid, but does not exist!'; 
			  	mysqli_query($conn, "INSERT INTO $tableto (email) VALUES ('$email')") or die('error: '.mysqli_error($conn));
               	mysqli_query($conn, "DELETE FROM $table WHERE id = '$id'") or die('error: '.mysqli_error($conn));
			}
			else
			{ 
			    $messages[] = 'Email &lt;'.$email.'&gt; is not valid and doesnt exist!';
			    mysqli_query($conn, "INSERT INTO $tableto (email) VALUES ('$email')") or die('error: '.mysqli_error($conn));
                mysqli_query($conn, "DELETE FROM $table WHERE id = '$id'") or die('error: '.mysqli_error($conn));
			}
		}

		echo '<pre>'; print_r($messages); echo '</pre>'; 
		exit; 

?>
