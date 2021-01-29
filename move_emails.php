<?php
include_once "db/db.php";

$table = 'recipients_notfound';

$recipient_query = mysqli_query($conn, "SELECT email FROM $table WHERE email LIKE '%@scotiabank.com'") or die(mysqli_error($conn));
/*
echo (mysqli_num_rows($recipient_query));
exit;
*/
        while ($recipient_row = mysqli_fetch_assoc($recipient_query)) 
        {   
            $email = $recipient_row['email'];		// Email to check

			    $messages[] = 'Email &lt;'.$email.'&gt; moved to main table'; 
			    mysqli_query($conn, "INSERT INTO recipients (email) VALUES ('$email')") or die('error: '.mysqli_error($conn));
			    mysqli_query($conn, "DELETE FROM $table WHERE email = '$email'") or die('error: '.mysqli_error($conn));
		}

		echo '<pre>'; print_r($messages); echo '</pre>'; 
		exit; 

?>
