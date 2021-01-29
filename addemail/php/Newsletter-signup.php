<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<meta charset="UTF-8">
<title>You have been successfully added</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript">
    function pageRedirect() {
        window.location.replace("https://netskyis.com/addemail/");
    }      
    setTimeout("pageRedirect()", 10000);
</script>   

<link href="../style.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="holder">

<h1>You have been successfully added</h1>
  
<fieldset> 
<legend>Thank you</legend>

<?php 
$host = "localhost";
$db_name = "netskyis_mailingdb";
$username = "netskyis_mailing";
$password = ",CSDT[6&[Hf=";
 
$person= $_POST['person']; 
$email= $_POST['email']; 
  
  
// Connection to DBase  
$dbc= mysqli_connect($host,$username,$password, $db_name)  
or die("Unable to select database"); 
 
 
$query= "INSERT INTO mlg__recipient (person,email) VALUES ('$person','$email')";
 
mysqli_query ($dbc, $query) 
or die ("The Email Already Exists Or A Error"); 
 
echo '<p>Successful Added</p>' . '<br>'; 
 
mysqli_close($dbc); 

?> 

    <p><strong>Note:</strong> You will be redirected, add another emails in 10 sec.</p>
</body>
</html> 