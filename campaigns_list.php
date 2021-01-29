<?php
  require_once 'include/checksession.php';
  require_once 'db/db.php';
  require_once 'include/objects.php';
  require_once 'include/functions.php';
  /*-----------------------------------------------------------------*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Email campaigns</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="application/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a8f00d241f.js" crossorigin="anonymous"></script>

<link href="bootstrap-4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />

</head>
<script type="text/javascript">
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<body>

<?php include 'menu.php' ?>

<div class="container">

    <fieldset class="blackglass">
        <legend class="brownglass"><span>Manage email campaigns</span></legend>

<?php
//----------------------------------------------------------------------------------------

      if ($_REQUEST['msg'])
      { 
        $msgType = $_REQUEST['msgType'];
        $msg = $_REQUEST['msg'];
        $msgIcon = $_REQUEST['msgIcon'];

        $myMsg = new Msg();
        $myMsg->PrintMsg($msg, $msgType, $msgIcon);
      }

//---------------------------------------------------------------------------------

    $sql_campaign = "SELECT id, name, title, datecreated FROM campaigns ORDER BY datecreated DESC";
    $campaign_query = mysqli_query($conn, $sql_campaign) or die(mysqli_error($conn));
    
    $myrows = mysqli_num_rows($campaign_query);

    if ($myrows > 0) 
    { 
//----------------------------------------------------------------------------------
?>
<table class="table">
  <tr>
      <th scope="col" width="20%">&nbsp;</th>

      <th scope="col">Title</th>
      <th scope="col" width="20%">Date created</th>
      
  </tr>
<?php
//----------------------------------------------------------------------------------

		while ($campaign_row = mysqli_fetch_assoc($campaign_query))	
		{	
				$id = $campaign_row['id'];
        $title = $campaign_row['title'];
				$datecreated = formatdate($campaign_row['datecreated']);

/*-------------------------------------------------------------------------------*/
 ?>
            <tr>
              <td><a class="btn btn-primary" href="edit_campaign.php?campaignID=<?php echo $id ?>" title="Modify email campaign details"><i class="fas fa-edit"></i></a> 

              <a class="btn btn-info" href="email_preview.php?campaignID=<?php echo $id ?>" title="Send email campaign to subscribers now"><i class="fas fa-paper-plane"></i></a>

              <a class="btn btn-secondary" href="delete_campaign.php?campaignID=<?php echo $id ?>" onclick="confirm('Campaign and all details will be removed, continue?')"><i class="far fa-trash-alt"></i></button>

              </td>
              <td><div class="form-group"><?php echo $title ?></div></td>
              <td><?php echo $datecreated ?></td>
              
			     </tr>
            
<?php 			} // while		?>
          
          </table>
          
<?php 
  } else {
          echo "<p style='color:white'>No campaigns created yet</p>";
  }
?>

    </fieldset>

</div>

</body>
</html>

