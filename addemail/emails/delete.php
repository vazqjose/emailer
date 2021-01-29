<!DOCTYPE html>
<html lang="en">
<head>
  <title>Email's Manager</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Loading Flat UI Pro -->
    <link href="css/flat-ui-pro.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.png">
  
</head>
<body>

<?php 
//include the navigation bar

include '../checksession.php';
include '../../functions/functions.php';
include ("inc/navbar.php");?>

<div class="container">
	<br>
	<br>
  

  <div class="row">
    
    <div class="col-md-9" name="maincontent" id="maincontent">
		
		<div id="exercise" name="exercise" class="panel panel-info">
		<div class="panel-heading"><h5>Email's Manager</h5></div>
			<div class="panel-body">
			<!-- ***********Edit your content STARTS from here******** -->
			
<?
// check if the 'id' variable is set in URL, and check that it is valid
$id =$_REQUEST['id'];

$con = mysql_connect("localhost","apps","QPKEnPnPJx55fDJJ");
if (!$con)
{
die('Could not connect: ' . mysql_error());
}

mysql_select_db("itwarehouseprdb", $con);

$sql="DELETE FROM itwarehousecustomers WHERE id='$id'";

if (!mysql_query($sql,$con))
{
die('Error: ' . mysql_error());
}
echo "Record deleted successfully!";

        echo "<br>";
        echo "<a href='search-update-delete.php'> Back to main page </a>";
    
        // close connection 

mysql_close($con)

?>

<?php
					//end of records
				?>
				</table>
				<?php
				//end if there are records
			//end db search
			?>
			
			<!-- ***********Edit your content ENDS here******** -->	
			</div> <!--body panel main -->
		</div><!--toc -->
		
    </div><!-- end main content -->
	
    <div class="col-md-3">
		<?php 
		//include the sidebar menu
		include ("inc/sidebar-menu.php");?>
    </div><!-- end main menu -->
  </div>
</div><!-- end container -->


<?php 
//include the footer
include ("inc/footer.php");?>

</body>
</html>
