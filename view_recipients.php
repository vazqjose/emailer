<?php

include_once "include/checksession.php";
include_once "db/db.php";
require_once 'include/functions.php';
require_once 'include/objects.php';
    
    if ($_POST['btnDelete'])
    {
        for ($i; $i < count($_POST['email']); $i++)
        {
            $email = $_POST['email'][$i];
            //echo $_POST['email'][$i].'<br>';
            mysqli_query($conn, "DELETE FROM recipients WHERE email = '$email'") or die(mysqli_error($conn));
        }

        $msg = count($_POST['email']).' emails deleted';
        $msgType = 'alert-success';
    }

    $recipient_query = mysqli_query($conn, "SELECT email FROM recipients") or die(mysqli_error($conn));
    $myrows = mysqli_num_rows($recipient_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Email recipients</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="application/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a8f00d241f.js" crossorigin="anonymous"></script>

<link href="bootstrap-4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />

</head>

<body>
<?php include 'menu.php' ?>

    <div class="container">

<?php

      if ($_REQUEST['msg'])
      { 
        $msgType = $_REQUEST['msgType'];
        $msg = $_REQUEST['msg'];
        $msgIcon = $_REQUEST['msgIcon'];

        $myMsg = new Msg();
        $myMsg->PrintMsg($msg, $msgType, $msgIcon);
      }
?>

    <fieldset class="blackglass">
        <legend class="brownglass"><span>Manage email campaigns</span></legend>

<?php
    if ($myrows > 0)
    { 
?>

<form method="post" enctype="multipart/form-data">

    <input type="submit" name="btnDelete" value="Delete selected" onclick="confirm('Are you sure?')" class="btn btn-primary" >
    <table class="table">
  <tr>
      <th scope="col">&nbsp;</th>
  </tr>

<?php
        while ($recipient_row = mysqli_fetch_assoc($recipient_query)) 
        {   
?>

    <tr>
      <td scope="col"><label><input type="checkbox" name="email[]" value="<?php echo $recipient_row['email']; ?>"> <?php echo $recipient_row['email']; ?></label></td>
    </tr>
        
<?php
        }
?>
<?php
    }
?>

        </table>


</form>
    </fieldset>
    </div>
</body>
</html>