<?php 
//include the database connectivity setting

include '../checksession.php';
include '../../functions/functions.php';
include ("inc/dbconn.php");?>
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
include ("inc/navbar.php");?>

<div class="container">
	<br>
	<br>
  

  <div class="row">
    
    <div class="col-md-9" name="maincontent" id="maincontent">
		
		<div id="exercise" name="exercise" class="panel panel-info">
		<div class="panel-heading"><h5>UPDATE Existing Client</h5></div>
			<div class="panel-body">
			<!-- ***********Edit your content STARTS from here******** -->
			<?php

			//perform UPDATE
			//Create SQL query
			$id=$_GET['id'];
			$clientname=$_GET['clientid'];
			$clientname=$_GET['clientname'];
			$clientemail=$_GET['clientemail'];
			$clientarea=$_GET['clientarea'];
			$phone=$_GET['phone'];
			
			//SQL to update record
			$query="UPDATE itwarehousecustomers SET 
			   Account='$clientid', 
			   Name='$clientname',
			   Email='$clientemail',
			   City & ST='$clientarea',
			   Phone='$phone'
			   where id='$id'";
			   //echo $query;
			   
			//Execute the query
			$qr=mysqli_query($db,$query);
			if($qr==false){
				echo ("Query cannot be executed!<br>");
				echo ("SQL Error : ".mysqli_error($db));
			}
			else{//insert successfull
				echo "UPDATE has been saved...<br>";
				echo "<a href='php-db-template.php?staffname=$clientname'>View $clientname $clientemail</a>";
			}

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
