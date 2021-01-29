<?php

    $campaign_query = mysqli_query($conn, "SELECT id, name, title, datecreated FROM campaigns") or die(mysqli_error($conn));
    $numrows = mysqli_num_rows($campaign_query);

?>
<nav class="navbar fixed-top navbar-expand-lg mainmenu">
  <a class="navbar-brand" href="campaigns_list.php" title="Go to initial screen">Email Campaign Manager <i class="fas fa-paper-plane"></i></a>
  <div class="container-fluid">

    <ul class="nav navbar-nav">
      
    </ul>

    <ul class="nav navbar-nav navbar-right">
      <li class="nav-item">
        <a class="nav-link" href="new_campaign.php" title="Create campaign"><i class="fas fa-feather-alt"></i>Create new campaign <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="campaigns_list.php" title="Go to initial screen"><i class="fas fa-list"></i>View list of campaigns (<?php echo $numrows ?>) <span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-users-cog"></i><?php echo $_SESSION['name'] ?> <span class="caret"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="userprofile.php"><i class="fas fa-user-edit"></i>My details</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off"></i>Log off</a>
        </div>
      </li>
    </ul>
    
 </div>
</nav>
<p>&nbsp;</p><p>&nbsp;</p>