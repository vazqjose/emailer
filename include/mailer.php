<?php		
	function sendemail($message, $subject, $email, $email_from)	 {
	
		$this->headers = "From: ".$email_from; 
							
		$this->semi_rand = md5(time());
							
		$this->mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
							
		$this->headers .= "\nMIME-Version: 1.0\n" . 
							
										"Content-Type: multipart/mixed;\n" . 
							
										" boundary=\"{$mime_boundary}\""; 
		$this->email_message = $message
. "This is a multi-part message in MIME format.\n\n" . 
						
										"--{$mime_boundary}\n" . 
						
										"Content-Type:text/html; charset=\"iso-8859-1\"\n" . 
						
									   "Content-Transfer-Encoding: 7bit\n\n" . 
										"\n\n"; 						
							
									
		mail($email, $subject, $email_message, $headers);
		
	} // function


?>