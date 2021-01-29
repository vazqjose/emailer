<?php

if ($_POST['email'])
    {
      include_once "db/db.php";
      require_once 'include/functions.php';
      require_once 'include/objects.php';

      $email = $_POST['email'];
      $myquery = mysqli_query($conn, "SELECT * FROM staff WHERE email = '$email'") or die(mysqli_error($conn));

      if (mysqli_num_rows($myquery) > 0)
      {
          $myrow = mysqli_fetch_assoc($myquery) or die(mysqli_error($conn));
          $email_to = $myrow['email'];
          $name = $myrow['name'];
          $password = $myrow['password'];
          $email_msg = "

          <link href='https://fonts.googleapis.com/css?family=Open+Sans&display=swap' rel='stylesheet'>

            <div class='container' style='font-family: 'Open Sans';
                      width: 700px;
                      margin:40px auto;
                      padding:0;'>
                
                <fieldset style='margin:40px 0;
                    padding: 0 !important;
                    border: 0;'>
                    <p>Dear $name,</p>
                    <p>You are receiving this email because it was requested a password recovery to the Email Campaign Manager account associated with this email.</p>
                    <p>Your password is: <strong>$password</strong></p>
                    <p>&nbsp;</p>
                    <p>Login to your Email Campaign Manager account <a href='index.php'>here</a>.</p>
                </fieldset>
            </div>
     ";


          $msg = "Password sent to <strong>".$email."</strong>";
          $msgType = "alert-success";
          $email_from = 'info@netskyis.com';
          
          $subject = "Password recovery from Email Campaign Manager";
          sendemail($email_msg, $subject, $email_to, $email_from);
          
          header("location:index.php?msg=".$msg."&msgType=".$msgType);
          exit;
      } 
      else 
      {
          $msg = "The email <strong>".$email."</strong> is not registered in our system";
          $msgType = "alert-warning";
      }
    
}

//--------------------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Email Campaign Manager / Recover your account password</title>
<script src="https://kit.fontawesome.com/a8f00d241f.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
<link href="bootstrap-4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">
    
    <fieldset>
        <legend><span>Recover account password</span></legend>
    
    
    <form method="post" enctype="multipart/form-data">

      <div class="row justify-content-center" >
        <div class="col-md-8">
        <div class="form-group">
          <?php
            if ($msg)
              { 
                $myMsg = new Msg();
                $myMsg->PrintMsg($msg, $msgType);
              }
          ?>
          <label>Please enter the emai addresss associated with your account.  We will recover your password and send it to your email.</label>
        </div>
      </div>
      </div>
      <div class="row justify-content-center" >
                <div class="col-md-8">
                  <div class="form-group">
                    
                   <div class="input-group mb-3 shadow">
                      <input type="text" class="form-control" placeholder="Enter your email address" aria-label="Enter your email address" aria-describedby="basic-addon2" name="email">
                      <div class="input-group-append">
                        <button class="btn btn-primary" value="search" type="submit"><i class="fas fa-search"></i></button>
                      </div>
                    </div>

                  </div>
                </div>
                
        </div>
      </form>


    </fieldset>  
</div>

</body>
</html>
