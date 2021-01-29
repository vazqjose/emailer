<?php

include_once "include/checksession.php";
include_once "db/db.php";
require_once 'include/objects.php';
require_once 'include/functions.php';

if (isset($_POST['insert']))
{
            if (($_POST["insert"]) &&  ($_POST["title"])  &&  ($_POST["name"])  &&  
              ($_POST["sender_name"])   &&  ($_POST["email_from"])  &&  ($_POST["headerID"]))
            {
                $title = $_POST['title'];
                $name = $_POST['name'];
                $sender_name = $_POST['sender_name'];
                $email_from = $_POST['email_from'];
                $content = addslashes($_POST['content']);
                $headerID = $_POST['headerID'];
                $today = date('Y-m-d');

                mysqli_query($conn, "INSERT INTO campaigns(title, name, content, datecreated, sender_name, email_from, headerID) VALUES ('$title', '$name', '$content', '$today', '$sender_name', '$email_from', '$headerID')") or die("Error adding campaign --> ".mysqli_error($conn));
                
                $campaignID = mysqli_insert_id($conn);
                
                if (!empty($_FILES['image']['name']) && $_FILES['image']['type'] == 'image/jpeg')
                {
                    $path = 'uploads/';
                    move_uploaded_file($_FILES['image']['tmp_name'], $path.$_FILES['image']['name']);
                    
                    $tmp_file = $_FILES['image']['tmp_name'];
                    $filename = $_FILES['image']['name'];

                    list($width, $height, $type, $attr) = getimagesize($path.$filename); 
               
                      if ($width > 700)
                      {
                        resize_image($path.$filename, "700");
                      }
                    
                    $myfile = addslashes(file_get_contents($path.$filename));
                    
                    // add campaign image
                    mysqli_query($conn, "INSERT INTO images(filename, campaignID) VALUES ('$filename', '$campaignID')") or die("Error adding image --> ".mysqli_error($conn));
                }

                $msg = "Campaign added successfuly!";
                $msgType = "alert-success";
                $msgIcon = "far fa-check-circle";

                header('location:edit_campaign.php?campaignID='.$campaignID.'&msg='.$msg.'&msgType='.$msgType.'&msgIcon='.$msgIcon);
                exit;
                
            } else {

                $msg = "Campaign details are mandatory";
                $msgType = "alert-warning";
                $msgIcon = 'fas fa-exclamation-triangle';
            }


      if (isset($_REQUEST['msg']))
        { 
          $msgType = $_REQUEST['msgType'];
          $msg = $_REQUEST['msg'];
          $msgIcon = $_REQUEST['msgIcon'];
        }
            
  } // IF INSERT
//--------------------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Email Campaign Manager / Register a new campaign</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="summernote/summernote.min.css" rel="stylesheet">
    <script src="summernote/summernote.min.js"></script>

    <script src="https://kit.fontawesome.com/a8f00d241f.js" crossorigin="anonymous"></script>
    <link href="css/style.css" rel="stylesheet" type="text/css" />

                    <style>
                        .myDiv{
                          display:none;
                       
                        }  
                        .myDiv img{
                          margin: 0 auto;
                          height:80px;
                        }
                    </style>

                    <script>
                        $(document).ready(function(){
                            $('#myselection').on('change', function(){
                                
                                var demovalue = $(this).val(); 

                                $("div.myDiv").hide();
                                $("#show"+demovalue).show();
                            });
                        });
                    </script>

  </head>
</head>

<body>

<?php include 'menu.php' ?>

<div class="container">
    
    <fieldset style="background: none; border:0;">
        <legend class="brownglass"><span>Register a new email campaign</span></legend>
    
    <?php
      if (isset($msg))
        { 
          $myMsg = new Msg();
          $myMsg->PrintMsg($msg, $msgType, $msgIcon);
        } 
        else if ($_REQUEST['msg'])
        { 
          $msgType = $_REQUEST['msgType'];
          $msg = $_REQUEST['msg'];
          $msgIcon = $_REQUEST['msgIcon'];
          $myMsg = new Msg();
          $myMsg->PrintMsg($msg, $msgType, $msgIcon);
        }
    ?>
    <form method="post" enctype="multipart/form-data" id="myform">

      <div class="row" >
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Campaign description for administrative use</label>
                   <input type="text" name="name" class="form-control shadow" placeholder="Enter a brief description about this campaign"  value="<?php echo $_POST['name'] ?>"/>
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                          <label class="control-label">Email header (What will be read in the recipient's inbox)</label>
                          <input name="title" type="text" class="form-control shadow" value="<?php echo $_POST['title'] ?>" placeholder="Text that will go on the email header" />
                    </div>
                </div>
    </div>

    <div class="row" >
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Name of sender</label>
                   <input type="text" name="sender_name" class="form-control shadow" placeholder="Enter the name of the person or department as sender of this email"  value="<?php echo $_SESSION['name'] ?>"/>
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                          <label class="control-label">Email of the sender</label>
                          <input name="email_from" type="text" class="form-control shadow"  placeholder="Email of the sender that will be displayed in the 'From' line" value="<?php echo $_SESSION['email'] ?>"/>
                    </div>
                </div>
    </div>

    <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Header for the email</label>
                <select id="myselection" name="headerID" class="form-control shadow">
                  <option value="" selected="selected">-Select one-</option>
                <?php 
                  $query_heading = mysqli_query($conn, "SELECT * FROM email_headers WHERE image_type = 'header'");

                  while ($row = mysqli_fetch_assoc($query_heading))
                  {                    
                    $imageID = $row['id'];
                    $description = $row['description'];
                    $filename = $row['filename'];
                ?>
                  
                  <option value="<?php echo $imageID ?>"><?php echo $description . ' (' . $filename .')'; ?></option>
                
                <?php
                  }
                ?>

                </select>
            </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                  
                    <?php 
                        $query_heading = mysqli_query($conn, "SELECT * FROM email_headers WHERE image_type = 'header'");

                        while ($row = mysqli_fetch_assoc($query_heading))
                        { 
                          $imageID = $row['id'];
                          $description = $row['description'];
                          $filename = $row['filename'];
                    ?>
                    <div id="show<?php echo $imageID ?>" class="myDiv">
                        <img src="images/<?php echo $filename ?>" title="<?php echo $description ?>" class="img-responsive img-thumbnail"/>
                    </div>
                    <?php

                        }
                    ?>

              </div>
          </div>
    </div>

          <div class="row">
              <div class="col-lg-12 nopadding"><label class="control-label">Email content</label>
                <div class="form-group whiteglass">

                    <textarea id="summernote" name="content" class="form-control shadow" placeholder="Enter the content here..."></textarea> 
                </div>
              </div>
          </div>

          <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                            <label class="control-label">Main image</label>
                            <input type="file" id="image" name="image"/>
                    </div>
                </div>
          </div>
 
        <div class="row">
          <div class="form-group">
              <button type="submit" class="btn btn-primary shadow bold" name="insert" id="btnInsert" value="Insert"><i class="fas fa-feather-alt"></i> Create campaign</button>
          </div>
        </div>
    </form>


    </fieldset>  
</div>

</body>
</html>


<script>
  $(document).ready(function() 
  {

      $('#summernote').summernote({
        placeholder: 'Enter your content here',
        tabsize: 2,
        height: 400
      });

      $("#myform").on('click', '#btnInsert', function() 
      {

            var image_name = $('#image').val();
            var extension = $('#image').val().split('.').pop().toLowerCase();

              if (($('#image').val()) &&  (jQuery.inArray(extension, ['jpg', 'jpeg']) == -1))
              {
                $('#image').val('');
                alert('Only jpeg images allowed');
                event.preventDefault();
              }
      }); // click
      
  }); // ready
</script>
