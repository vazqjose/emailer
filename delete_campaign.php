<?php

include_once "include/checksession.php";
include_once "db/db.php";

$path = $_SESSION['path'];

if ($_REQUEST["campaignID"])
{
    $campaignID = $_REQUEST["campaignID"];

    // GET THE TITLE FOR DISPLAY
    $sql_campaign = "SELECT title FROM campaigns WHERE id = '$campaignID'";
    $campaign_query = mysqli_query($conn, $sql_campaign) or die(mysqli_error($conn));
    $campaign_row = mysqli_fetch_assoc($campaign_query);
    $title = $campaign_row['title'];
    
    // REMOVE CAMPAIGN
    mysqli_query($conn, "DELETE FROM campaigns WHERE id = '$campaignID'") or die(mysqli_error($conn));

    // REMOVE IMAGES FROM CAMPAIGN IF PRESENT
    $image_query = mysqli_query($conn, "SELECT filename FROM images WHERE campaignID = '$campaignID'") or die('Error looking up images: ' . mysqli_error($conn));

    if (mysqli_num_rows($image_query) > 0)
    {
        $image_row = mysqli_fetch_assoc($image_query);
        $image = $path.$image_row['filename'];
        unlink($image);

        mysqli_query($conn, "DELETE FROM images WHERE campaignID = '$campaignID'") or die(mysqli_error($conn));
    }


    $msg = "Campaign '".$title."' removed";
    $msgType = "alert-success";
}


  header('location:campaigns_list.php?msg='.$msg.'&msgType='.$msgType);
  exit;

?>
