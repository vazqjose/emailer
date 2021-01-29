<?php

	session_start();
 
	require_once 'include/objects.php';

	if (isset($_SESSION['staffid']))
	{
    	//header("location:http://".$_SERVER['HTTP_HOST']."/location:adminpanel.php");
    	header("location:http://".$_SERVER['HTTP_HOST']."/emailer/campaigns_list.php");
    	exit;
  }

//----------------------------------------------------------------------------------------

?>
<HTML>
<!DOCTYPE>

<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8" />
<TITLE>Email Campaign Manager</TITLE>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script type="application/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a8f00d241f.js" crossorigin="anonymous"></script>

<link href="bootstrap-4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">

label
{
  color:white;
}

.main-head{
    height: 150px;
    background: #FFF;
   
}

.sidenav {
    height: 100%;
    background-color: rgb(0,0,0,0.4);
    overflow-x: hidden;
    padding-top: 20px;
}


.main {
    padding: 0px 10px;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
}

@media screen and (max-width: 450px) {
    .login-form{
        margin-top: 10%;
    }

    .register-form{
        margin-top: 10%;
    }
}

@media screen and (min-width: 768px){
    .main{
        margin-left: 40%; 
    }

    .sidenav
    {
        width: 40%;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
    }

    .login-form{
        margin-top: 80%;
    }

    .register-form{
        margin-top: 20%;
    }
}


.login-main-text{
    margin-top: 20%;
    padding: 60px;
    color: #fff;
}

.login-main-text h2{
    font-weight: 300;
}

.btn-black{
    background-color: #000 !important;
    color: #fff;
}
</style>
</HEAD>
<BODY>

<div class="container"> 

<!------ Include the above in your HEAD tag ---------->

<div class="sidenav">
         <div class="login-main-text">
            <h2>Email Campaign Manager<br> Login Page</h2>
            <p>Login here to access.</p>
         </div>
      </div>
      <div class="main">

         <div class="col-md-8 col-sm-12">
            <div class="login-form">
              <div class="control-label">
                
                  <?php 
                    if ($_REQUEST['msg'])
                        {
                          $msg = $_REQUEST['msg'];
                          $msgType = $_REQUEST['msgType'];
                          $msgIcon = $_REQUEST['msgIcon'];

                          $myMsg = new Msg();
                          $myMsg->PrintMsg($msg, $msgType, $msgIcon);
                        }
                  ?>
                
              </div>
               <FORM METHOD="post" ACTION="login_user.php" enctype="multipart/form-data">
                  <div class="form-group">
                     <label>Email address</label>
                     <input type="text" name="email" class="form-control" placeholder="Enter a email address" />
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input name="password" type="password" class="form-control" placeholder="Enter your password"  />
                  </div>
                  <button type="Submit" name="Login" value="Login" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Login</button>
                  <button type="Submit" name="RecoverPassw" value="RecoverPassw" class="btn btn-secondary"><i class="fas fa-question-circle"></i> Forgot password</button>
               </FORM>
            </div>
         </div>
      </div>

</DIV>

</BODY>
</HTML>