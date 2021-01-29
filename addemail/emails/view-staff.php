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
		<div class="panel-heading"><h5>Email's Manager</h5></div>
			<div class="panel-body">
			<!-- ***********Edit your content STARTS from here******** -->
			
						
				<?php
				$id=$_GET['id'];
				//Create SQL query

				$query="select id, clientid, clientname, clientemail, phone
				from itwarehousecustomers where id='$id'";
				//Execute the query
				$qr=mysqli_query($db,$query);
				if($qr==false){
					echo ("Query cannot be executed!<br>");
					echo ("SQL Error : ".mysqli_error($db));
				}
				else{//no error in sql
					$rec=mysqli_fetch_array($qr);
				}
				
				
			?>
			
			View Client Info<br>
				<form role="form" name="" action="" method="GET">
					<div class="form-group">
					  Account <input class="form-control" name="account" type="text" 
					  value="<?php echo $rec['clientid']; ?>" >
					  Name <input class="form-control" name="staffname" type="text" 
					  value="<?php echo $rec['clientname']; ?>" >
					  Email <input class="form-control" name="email" type="text" 
					  value="<?php echo $rec['clientemail']; ?>" >
					  City & ST <input class="form-control" name="dept" type="text" 
					  value="<?php echo $rec['clientarea']; ?>" >
					  Phone <input class="form-control" name="phone" type="text" 
					  value="<?php echo $rec['phone']; ?>" >
					  
					</div>
				</form>
				<hr>
			
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
