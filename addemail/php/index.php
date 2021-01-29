<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<meta charset="UTF-8">
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
<form action="php/Newsletter-signup.php" method="post">
    <p>
        <label for="person">Full Name:</label>
        <input type="text" name="person" id="person" class="mytext">
    </p>
    <p>
        <label for="email">Email Address:</label>
        <input type="text" name="email" id="email" class="mytext">
    </p>
    
    <form method="post" action="http://mailing.netskyis.com/index.php?manage=campaign&action=subscribe">
   <input type="email" name="recipientmail" class="mytext" placeholder="Enter email" required />
   <input type="text" name="recipientname" class="mytext" placeholder="Enter Name" />
   <input type="hidden" name="tags" value="" />
   <input type="hidden" name="recipientcomment" value="" />
   <input type="hidden" name="redirectto" value="" />
   <input type="hidden" name="dbloptin" value="1" />
   <input type="hidden" name="subscriptionFormToken" value="" />
   <input type="submit" class="mybutton" value="submit" />
</form>

    <input name="addemail" type="submit" class="mybutton" id="addemail" value="Add" />
</form>
</body>
</html>