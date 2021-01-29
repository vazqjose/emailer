<?php

include_once "include/checksession.php";
include_once "db/db.php";
require_once 'include/objects.php';
require_once 'include/functions.php';

$staffid = $_SESSION['staffid'];

$myquery = mysqli_query($conn, "SELECT * FROM staff WHERE id = '$staffid'") or die("Error saving details --> ".mysqli_error($conn));
$myrow = mysqli_fetch_assoc($myquery) or die(mysqli_error($conn));
$email = $myrow['email'];

if (isset($_POST["update"]))
{
    if (validemail($_POST['email']))
    {
      $email = $_POST['email'];
      mysqli_query($conn, "UPDATE staff SET email = '$email' WHERE id = '$staffid'") or die(mysqli_error($conn));
      $email_msg = "Email address updated. ";
      $msgType = "alert-success";
      $msgIcon = 'far fa-check-circle';
    }

    if (($_POST['password1']) && ($_POST['password2']))
    {
        if (($_POST['password1']) == ($_POST['password2']))
        {
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];
            mysqli_query($conn, "UPDATE staff SET password = '$password1' WHERE id = '$staffid'") or die(mysqli_error($conn));
            $msgType = "alert-success";
            $password_msg = "Password updated. ";
        } else {
            $password_msg = "Passwords did not match. ";
            $msgType = "alert-warning";
        }
    }

    $msg = $email_msg.$password_msg;
}

//--------------------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Email Campaign Manager / Edit login details</title>
<script src="https://kit.fontawesome.com/a8f00d241f.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
<link href="bootstrap-4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php include 'menu.php' ?>

<div class="container">
    
    <fieldset>
        <legend class="brownglass"><span>Edit user details</span></legend>
    <?php
      if ($msg)
        { 
          $myMsg = new Msg();
          $myMsg->PrintMsg($msg, $msgType, $msgIcon);
        }
    ?>
    
    <form method="post" enctype="multipart/form-data">

      <div class="row">
        <div class="col-md-12">
        <div class="form-group">
          <?php
           
                $myMsg = new Msg();
                $myMsg->PrintMsg('Please make sure that you are entering a functional email address before submiting your changes in this screen.  Your email address is important for password recovery.', 'alert-info', 'far fa-id-badge');
              
          ?>
         
        </div>
      </div>
      </div>
      <div class="row" >
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Email address</label>
                   <input type="text" name="email" class="form-control" placeholder="Enter a email address" value="<?php echo $email ?>" />
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">       
                          <label class="control-label">Change Password</label>
                          <input name="password1" type="text" class="form-control" placeholder="Enter a new password" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">       
                          <label class="control-label ">Verify password</label>
                          <input name="password2" type="text" class="form-control" placeholder="Enter new password again" />
                    </div>
                </div>
        </div>

      
      <button type="submit" class="btn btn-primary shadow bold" name="update" id="btnInsert" value="Insert"><i class="fas fa-save"></i> Save details</button>
        </form>


    </fieldset>  
</div>

</body>
</html>
