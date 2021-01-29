<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Add Emails</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>

<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="holder">
<h1>Inscriba su emails para nuevas promociones</h1>
  
<fieldset> 
<legend>Sign up for Newsletter</legend> 

<body>
<form method="post" action="https://mailing.netskyis.com/index.php?manage=campaign&action=subscribe">
    <p><input type="text" name="recipientname" class="mytext" placeholder="Enter Full Name" /></p>
    <p><input type="email" name="recipientmail" class="mytext" placeholder="Enter Email" required /></p>
    <p><input type="hidden" name="redirectto" value="http://netskyis.com/addemail/" /></p>
    <p><input type="submit" class="mybutton" value="submit" /></p>
</form>
</body>
</html>