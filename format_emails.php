<?php

include_once "db/db.php";

    $recipient_query = mysqli_query($conn, "SELECT id, email FROM emails") or die(mysqli_error($conn));

        while ($recipient_row = mysqli_fetch_assoc($recipient_query)) 
        {   
            $id = $recipient_row['id'];
            //$email = strtolower(filter_var($recipient_row['email'], FILTER_SANITIZE_EMAIL));
            $email = strtolower($recipient_row['email']);
            $email = $recipient_row['email'];
            $emailArray[] = $email;
/*
            if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
                // split on @ and return last value of array (the domain)
                $domain = array_pop(explode('@', $email));


                if (($domain == 'hotmail.com') ||  ($domain == 'hotmail.es')  ||  ($domain == 'live.com') ||  ($domain == 'outlook.com') || ($domain == 'msn.com'))
                {
                  mysqli_query($conn, "INSERT INTO recipients_hotmail(email) VALUES ('$email')") or die('error: '.mysqli_error($conn));
                  mysqli_query($conn, "DELETE FROM recipients WHERE id = '$id'") or die('error: '.mysqli_error($conn));
                } 
                else if ($domain == 'gmail.com')
                {
                  mysqli_query($conn, "INSERT INTO recipients_gmail(email) VALUES ('$email')") or die('error: '.mysqli_error($conn));
                  mysqli_query($conn, "DELETE FROM recipients WHERE id = '$id'") or die('error: '.mysqli_error($conn));
                }
                else if (($domain == 'yahoo.com') || ($domain == 'yahoo.es'))
                
            }*/
        }
           
/*
            if (!filter_var($formatted_email, FILTER_VALIDATE_EMAIL)) 
            {
                  mysqli_query($conn, "INSERT INTO recipients_test(email) VALUES ('$formatted_email')") or die('error: '.mysqli_error($conn));
                  mysqli_query($conn, "DELETE FROM recipients WHERE id = '$id'") or die('error: '.mysqli_error($conn));
                  $emailArray[] = $formatted_email;
            }
            */
        

echo '<pre>'; print_r($emailArray); echo '</pre>'; 
exit; 


?>
