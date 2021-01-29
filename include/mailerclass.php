<?php



class mailer	{

	var $headers;
	var $email_message;
	var $semi_rand;
	var $mime_boundary;

	function sendemail($message, $subject, $email, $email_from)	 {

		$this->headers = "From: ".$email_from; 
		$this->semi_rand = md5(time());
		$this->mime_boundary = 			"==Multipart_Boundary_x{$semi_rand}x"; 

		$this->headers .= 				"\nMIME-Version: 1.0\n" . 
										"Content-Type: multipart/mixed;\n" . 
										" boundary=\"{$this->mime_boundary }\""; 

		$this->email_message = 	$message;

		$this->email_message .= 	"This is a multi-part message in MIME format.\n\n" . 
									"--{$this->mime_boundary }\n" . 
									"Content-Type:text/html; charset=\"iso-8859-1\"\n" . 
								   "Content-Transfer-Encoding: 7bit\n\n" . 

		$this->email_message .= "\n\n";														

		@mail($email, $subject, $this->email_message, $this->headers);


	} // function



}

?>