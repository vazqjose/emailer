<?php
include_once "include/checksession.php";
include_once "db/db.php";

$path = $_SESSION['path'];

if ($_REQUEST["campaignID"])
{
    $campaignID = $_REQUEST["campaignID"];
    $sql_campaign = "SELECT * FROM campaigns, email_headers WHERE campaigns.headerID = email_headers.id AND campaigns.id = '$campaignID'";
    $campaign_query = mysqli_query($conn, $sql_campaign) or die(mysqli_error($conn));

        $campaign_row = mysqli_fetch_assoc($campaign_query);

        $name = $campaign_row['name'];
        $title = $campaign_row['title'];
        $content = stripslashes($campaign_row['content']);
        $datecreated = $campaign_row['datecreated'];
        $headerID = $campaign_row['headerID'];
        $imagename = $campaign_row['filename'];
        $description = $campaign_row['description'];

        $images_query = mysqli_query($conn, "SELECT * FROM images WHERE campaignID = '$campaignID' LIMIT 1") or die(mysqli_error($conn));

        if (mysqli_num_rows($images_query) > 0)
        {
          $images_row = mysqli_fetch_assoc($images_query);
          $image = $images_row['filename'];
          $mainimage = "<img src='$path$image' width='700' style='display:block' />";
        }
}
else 
{
  header('location:campaigns_list.php');
  exit;
}

/*---------------------------------------------------------------------------*/
 ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Email Campaign Manager / Preview email</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="application/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a8f00d241f.js" crossorigin="anonymous"></script>

<link href="bootstrap-4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />

</head>

<body>
  <?php include 'menu.php'; ?>


<?php
$message = "

    <link href='https://fonts.googleapis.com/css?family=Open+Sans&display=swap' rel='stylesheet'>

    <table align='center' padding=0 style='background:#fff; color:#333 !important; font-family: Open Sans; margin:20px auto 30px; width: 700px;'>
    <tr>
        <td>
        <img src='images/$imagename' align='center' style='display:block' />
        $mainimage
        </td>
    </tr>
    <tr>
        <td style='padding:40px; font-size: 1vw;'>
          $content
        </td>
    </tr>

    <tr>
                <td style='border-top:1px dotted #999;
                  font-size: .8vw;
                  color: #666;
                  padding: 20px 0;
                  text-align: center;'>
                  <p>Netsky Store, IT Warehouse | 2421 Perla Del Sur Ponce By Pass Ponce, PR 00730</p>
                  <p><a href='$path/unsubscribe.php?email=".$email_to."' target='_new'>Para no recibir estas promociones, presione aqui</p>
                </td>
                </tr>
                </table>
     ";
      
?>

<div class="container">
  <form method="post" enctype="multipart/form-data">
    <fieldset>
      <legend class="brownglass"><span>Preview email layout</span></legend>
          <p>&nbsp;</p>
          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <a role="button" class="btn btn-primary shadow bold" href="send_campaign.php?campaignID=<?php echo $campaignID ?>" onclick="return confirm('Are you sure?')"><i class="fas fa-paper-plane" ></i>  Send email now!</a>
                <a role="button" class="btn btn-warning shadow" href="edit_campaign.php?campaignID=<?php echo $campaignID ?>"><i class="fas fa-backspace"></i>  Return to campaign editor</a>
            </div>
          </div>
          <?php echo($message); ?>
    </fieldset>
  </form>
</div>

</body>
</html>
