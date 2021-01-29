<?php

function resize_image($file, $max_resolution)
      {
        if(file_exists($file))
        {
          $original_image = imagecreatefromjpeg($file);
          // resolution
          $original_width = imagesx($original_image);
          $original_height = imagesy($original_image);

          //try width first
          $ratio = $max_resolution / $original_width;
          $new_width = $max_resolution;
          $new_height = $original_height * $ratio;

          //if that iddnt work
          if ($new_height > $max_resolution) 
          {
            $ratio = $max_resolution / $original_height;
            $new_height = $max_resolution;
            $new_width = $original_width * $ratio;
          }

          if ($original_image)
          {
            $new_image = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
            imagejpeg($new_image, $file, 90);
          }
        }
      }
//-------------------------------------------------------------------------------------------
      
function word_cleanup ($str)
{
    $pattern = "/<(\w+)>(\s|&nbsp;)*<\/\1>/";
    $str = preg_replace($pattern, '', $str);
    return mb_convert_encoding($str, 'HTML-ENTITIES', 'UTF-8');
}

//-------------------------------------------------------------------------------------------


function sendemail($message, $subject, $recipient, $email_from)	 {
					/*						
		$headers = 'Content-Type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'Content-Transfer-Encoding: base64' . "\r\n";

    $headers .= "From: ". strip_tags($email_from) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($email_from) . "\r\n";
*/

    $headers = "From: ". $email_from . "\r\n";
    $headers .= "Reply-To: ". $email_from . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1/r/n";
    $headers .= "Content-Transfer-Encoding: 8bit\r\n";

		$email_message = 	$message;							
							
		@mail($recipient, $subject, $email_message, $headers);
		
		
	} // function
	

//-------------------------------------------------------------------------------------------------------------

  
function rrmdir($dir) {

	if (is_dir($dir)) {

		$objects = scandir($dir);
		
		foreach ($objects as $object) {
		
			if ($object != "." && $object != "..") 	{
				
				if (filetype($dir."/".$object) == "dir")	{
					
					rrmdir($dir."/".$object);
					
				} else { 
				
					@unlink($dir."/".$object);
				}
				
			}
		}	//	foreach
	}	// is_dir

	reset($objects);
	rmdir($dir);
} 
   
   

//------------------------------------------------------------------------------------------------------------


function formatBytes($b,$p = null) {
    /**
     *
     * @author Martin Sweeny
     * @version 2010.0617
     *
     * returns formatted number of bytes.
     * two parameters: the bytes and the precision (optional).
     * if no precision is set, function will determine clean
     * result automatically.
     *
     **/
    $units = array("B","kB","MB","GB","TB","PB","EB","ZB","YB");
    $c=0;
    if(!$p && $p !== 0) {
        foreach($units as $k => $u) {
            if(($b / pow(1024,$k)) >= 1) {
                $r["bytes"] = $b / pow(1024,$k);
                $r["units"] = $u;
                $c++;
            }
        }
        return number_format($r["bytes"],2) . " " . $r["units"];
    } else {
        return number_format($b / pow(1024,$p)) . " " . $units[$p];
    }
}


/*
echo formatBytes(81000000);   //returns 77.25 MB
echo formatBytes(81000000,0); //returns 81,000,000 B
echo formatBytes(81000000,1); //returns 79,102 kB
*/


//-------------------------------------------------------------------------------------------------------------

function formatdate($mydate)	{
 	
	// date must be in YYYY-MM-DD format
	
	$year = substr($mydate, 0,4); 
	$month = substr($mydate, 5, 2);
	$day = substr($mydate, 8, 2);
	
	$formatted= date("M d, Y", mktime(0, 0, 0, $month, $day, $year));
	
	return $formatted;
}

//----------------------------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------

/**
Validate an email address.
Provide email address (raw input)
Returns true if the email address has the email 
address format and the domain exists.
*/
function validemail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if
(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
      {
         // domain not found in DNS
         $isValid = false;
      }
   }
   return $isValid;
}


?>