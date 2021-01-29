<?php

$techname = $_SESSION['techname'];
$techid = $_SESSION['techid'];

/*
$url = $_SERVER['REQUEST_URI']; //returns the current URL
$parts = explode('/',$url);
$dir = $_SERVER['SERVER_NAME'];

*/
//-----------------------------------------------------------------------------------------------------------------------
 ?>



<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="campaigns_list.php">ECR</a>
        </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        
      
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php"><span class="glyphicon glyphicon-tags" aria-hidden="true"></span>&nbsp; Ticket list</a></li>
          <li><a href="newticket.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp; New service ticket</a></li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $techname; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">

                <?php if ($_SESSION['isAdmin'] == true) {   ?>
                <li><a href="adminsettings.php"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>&nbsp; Admin settings</a></li>
                <?php }   ?>
                
                <li><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp; My details</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="../logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp; Sign Out</a></li>
              </ul>
          </li>
        </ul>
      </div>
    </div>
</nav>
    

</div>
