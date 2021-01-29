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
		<div class="panel-heading"><h5>Add New Client</h5></div>
			<div class="panel-body">
			<!-- ***********Edit your content STARTS from here******** -->
				Add New Client Info<br>
				<form role="form" name="" action="" method="GET">
					<div class="form-group">
					  Account ID <input class="form-control" name="clientid" type="text" maxlength="7" 
					  placeholder ="Account (Example 0004567)" >
					  Name <input class="form-control" name="clientname" type="text" 
					  placeholder ="Name here..." >
					  Email's <input class="form-control" name="clientemail" type="text" 
					  placeholder ="Email here..." >
					  City & ST 
					  <select class="form-control" name="clientarea">
						<option value="Puerto Rico">Puerto Rico</option>
						<option value="USA">USA</option>
					  </select>
					  
					  Phone <input class="form-control" name="phone" type="text" maxlength="10" 
					  placeholder="Phone here..." >
					  
					  <input class="btn btn-embosed btn-primary" type="submit" value="Save New Client Record" >
					</div>
				</form>
				<hr>
						
				<?php
				//check staff name input by the user if null
				if(!isset($_GET['clientid'])){
					
				}
				else{//if there's user search - then perform db search
				//Create SQL query
					$clientid=$_GET['clientid'];
					$clientname=$_GET['clientname'];
					$clientemail=$_GET['clientemail'];
					$clientarea=$_GET['clientarea']; 
					$phone=$_GET['phone'];
					$query="INSERT INTO itwarehousecustomers(clientid, clientname, clientemail, clientarea, phone) 
					values ('$clientid','$clientname','$clientemail','$clientarea','$phone')";
					//Execute the query
					$qr=mysqli_query($db,$query);
					if($qr==false){
						echo ("Query cannot be executed!<br>");
						echo ("SQL Error : ".mysqli_error($db));
					}
					else{//insert successfull
						echo "The new client has been saved...<br>";
						echo "<a href='php-db-template.php?staffname=$clientemail'>View $clientemail $clientname</a>";
					}
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
