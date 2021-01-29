<?php

include_once "include/checksession.php";


$path = $_SESSION['path'];

if ($_REQUEST["campaignID"])  //  LOAD RECORD
{
    include_once "db/db.php";
    require_once 'include/objects.php';
    require_once 'include/functions.php';

    $campaignID = $_REQUEST["campaignID"];
    $sql_campaign = "SELECT * FROM campaigns, email_headers WHERE campaigns.headerID = email_headers.id AND campaigns.id = '$campaignID'";
    $campaign_query = mysqli_query($conn, $sql_campaign) or die(mysqli_error($conn));

    $campaign_row = mysqli_fetch_assoc($campaign_query);
    
        $id = $campaign_row['id'];
        $name = $campaign_row['name'];
        $title = $campaign_row['title'];
        $content = stripslashes($campaign_row['content']);
        $datecreated = $campaign_row['datecreated'];
        $email_from = $campaign_row['email_from'];
        $sender_name = $campaign_row['sender_name'];
        $headerID = $campaign_row['headerID'];
        $imagename = $campaign_row['filename'];
        $description = $campaign_row['description'];
}
else 
{
  header('location:campaigns_list.php');
  exit;
}

// ------------------------------------------- UPDATE 

if (($_POST['update']) || ($_POST['preview']))
{
      if (($_POST["title"] <> '')  &&  ($_POST["name"] <> '')   &&  isset($_POST["campaignID"]) &&  ($_POST["email_from"] <> '')  &&  ($_POST["sender_name"] <> '')  &&  ($_POST["headerID"] <> ''))   //  SUBMIT UPDATE
      {
          $campaignID = $_POST["campaignID"];
          $title = $_POST['title'];
          $name = $_POST['name'];
          $content = addslashes($_POST['content']);
          $sender_name = $_POST['sender_name'];
          $email_from = $_POST['email_from'];
          $headerID = $_POST['headerID'];
          
          $sql = "UPDATE campaigns SET title = '$title', name = '$name', content = '$content', email_from = '$email_from', sender_name = '$sender_name', headerID = '$headerID' WHERE id = '$campaignID'";
          mysqli_query($conn, $sql) or die("Error updating campaign --> ".mysqli_error($conn));

        
          if (!empty($_FILES['image']['name']))
          {
                if ($_FILES['image']['type'] == 'image/jpeg')
                {
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

                    $ImageMsg = "Image <strong>".$filename."</strong> added successfuly";
                    $ImageMsgType = "alert-primary";
                    $msgImageIcon = 'far fa-image';
                }
                else    // IF FILE TYPE
                { 
                    $ImageMsg = "Only JPG images are allowed!";
                    $ImageMsgType = "alert-warning";
                    $msgImageIcon = 'fas fa-exclamation-triangle';
                    $OkToSend = 'no';
                }
          }   // IF USER SUBMITED IMAGE


              
          if (($_POST['preview']) && ($OkToSend <> 'no'))  // SAVED, THEN PREVIEW
          {
              header('location:email_preview.php?campaignID='.$campaignID);
              exit;
          }
          
          $msg = "Campaign details saved successfuly!";
          $msgType = "alert-success";
          $msgIcon = "far fa-check-circle";

        } 
        else 
        {
            $msg = "All primary fields are required!";
            $msgType = "alert-danger";
            $msgIcon = 'fas fa-exclamation-triangle';
           
        }
 }



/*---------------------------------------------------------------------------*/
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Email Campaign Manager / Edit campaign detail</title>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="summernote/summernote.min.css" rel="stylesheet">
    <script src="summernote/summernote.min.js"></script>

    <script src="https://kit.fontawesome.com/a8f00d241f.js" crossorigin="anonymous"></script>
    <link href="css/style.css" rel="stylesheet" type="text/css" />

                  <style type="text/css">
                        .myDiv
                        {
                          display:none;
                        }  
                        .myDiv img{
                          margin: 0 auto;
                          width:auto;
                        }

                  </style>

                  <script type="text/javascript">
                          $(document).ready(function(){
                              $('#myselection').on('change', function(){

                                  var demovalue = $(this).val(); 
                                
                                  $("div.myDiv").hide();
                                  $("#show"+demovalue).show();
                              });
                          });
                        </script>

</head>

<body>

<?php include 'menu.php'; ?>

<div class="container">
    
    <fieldset style="background: none; border:0;">
        <legend class="brownglass"><span>Edit email campaign</span></legend>
                  <?php 
                  /*-----------------------------------------------*/
                    if (isset($msg))    // RECORD ALERT
                    {
                          $myMsg = new Msg();
                          $myMsg->PrintMsg($msg, $msgType, $msgIcon);
                    } 
                    else if ($_REQUEST['msg'])
                    {
                        $msg = $_REQUEST['msg'];
                        $msgType = $_REQUEST['msgType'];
                        $msgIcon = $_REQUEST['msgIcon'];
                        $myMsg = new Msg();
                        $myMsg->PrintMsg($msg, $msgType, $msgIcon);
                    }    

                    if (isset($ImageMsg))   // IMAGE ALERT
                    {
                        $myMsg = new Msg();
                        $myMsg->PrintMsg($ImageMsg, $ImageMsgType, $msgImageIcon);
                    } 
                    else if ($_REQUEST['ImageMsg'])
                    {
                      $ImageMsg = $_REQUEST['ImageMsg'];
                      $ImageMsgType = $_REQUEST['ImageMsgType'];
                      $msgImageIcon  = $_REQUEST['msgImageIcon'];
                      $myMsg = new Msg();
                      $myMsg->PrintMsg($ImageMsg, $ImageMsgType, $msgImageIcon);
                    }
                    
                  /*-----------------------------------------------*/
                  ?>
    
    <form method="post" enctype="multipart/form-data" id="myform">

      <div class="row">
                
                <div class="col-md-6">
                    <div class="form-group">       
                          <label class="control-label">Email header</label>
                          <input name="title" type="text" class="form-control" placeholder="Text that will go on the email header" value="<?php echo $title ?>"  />
                    </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Name of sender</label>
                   <input type="text" name="sender_name" class="form-control shadow" placeholder="Enter the name of the person or department as sender of this email"  value="<?php echo $sender_name ?>"/>
                  </div>
                </div>
    </div>

    <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Campaign description</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter a description for this email promotion" value="<?php echo $name ?>"  />
                  </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                          <label class="control-label">Email of the sender</label>
                          <input name="email_from" type="text" class="form-control shadow"  placeholder="Email of the sender that will be displayed in the 'From' line" value="<?php echo $email_from ?>"/>
                    </div>
                </div>
                
    </div>

    <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Header for the email</label>
                <select id="myselection" name="headerID" class="form-control shadow">
                  <option value="<?php echo $headerID ?>" selected="selected"><?php echo $description . ' (CURRENT)'; ?></option>
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
    <p>&nbsp;</p>

          <div class="row">
            <div class="col-lg-12 nopadding">
              <div class="form-group whiteglass">
                  <textarea id="summernote" name="content" class="form-control shadow" placeholder="Enter the content here..."><?php echo $content ?></textarea> 
              </div>
            </div>
          </div>

        
          <?php 

            $query_images = mysqli_query($conn, "SELECT * FROM images WHERE campaignID = '$campaignID'");

            if (mysqli_num_rows($query_images) > 0)
            {
          ?>
              <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">

                  <?php
                        $row = mysqli_fetch_assoc($query_images);
                        
                        $imageID = $row['id'];
                        $filename = $row['filename'];
                  ?>
                    <a target='preview' data-toggle="modal" data-target="#imagePopup" href="#"><img width='300' class='img-thumbnail rounded shadow' src="<?php echo $path.$filename ?>"></img></a>
                    <a class="btn btn-secondary shadow" onclick="return confirm('Delete this image?')" href="removeimage.php?campaignID=<?php echo $campaignID ?>&filename=<?php echo $filename ?>"><i class="fas fa-trash"></i> Remove</a>
                        </div>
                    </div>
              </div>

              <div class="modal fade" id="imagePopup" tabindex="-1" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered" role="document">
                  <div class="modal-content" style="background:none; border:0;">
                    <img src="<?php echo $path.$filename ?>" class='img-thumbnail rounded shadow'></img>
                         <div class="modal-footer" style="background:none">
                            <button type="button" class="btn btn-secondary shadow" data-dismiss="modal">Close</button>
                          </div>
                  </div>
                </div>
              </div>

          <?php 
            } else {  
          ?>
      
              <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                                <label class="control-label">Add a main image</label>
                                <input type="file" id="image" name="image" value="Add image" class="form-control shadow"/>
                        </div>
                    </div>
              </div>
          
      <?php
            }
      ?>
<hr>
  <input type="hidden" name="campaignID" value="<?php echo $campaignID ?>">
  <div class="row">
    <div class="form-group">
        <button type="submit" name="update" id="btnInsert" class="btn btn-primary shadow bold" value="Save details"><i class="fas fa-save"></i> Save details</button>
        <button type="submit" name="preview" id="btnPreview" class=" bold btn btn-warning shadow" value="Preview email"><i class="fas fa-glasses"></i> Save & preview email</button>
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
        tabsize: 2,
        height: 400
      });
  }); // ready
</script>
