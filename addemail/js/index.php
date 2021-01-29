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
        <input type="text" name="person" id="person" class="mytext" placeholder="Enter Full Name" required >
    </p>
    <p>
        <input type="text" name="email" id="email" class="mytext" placeholder="Enter email" required >
    </p>
    <input name="addemail" type="submit" class="mybutton" id="addemail" value="Add" />
</form>
</body>
</html>