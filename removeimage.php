<?php

include_once "include/checksession.php";
include_once "db/db.php";
$path = 'uploads/';

if ($_REQUEST["filename"])
{   
    $campaignID = $_REQUEST["campaignID"];
    $filename = $_REQUEST["filename"];
    $sql = "DELETE FROM images WHERE filename = '$filename'";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

	if(file_exists($path.$filename))
    {
    	unlink($path.$filename);
	    $ImageMsg = "Image '".$filename."' removed successfuly";
	    $ImageMsgType = "alert-primary";
	    $msgImageIcon = "far fa-image";
	} 
	else 
	{
		$ImageMsg = "Error removing image ".$filename;
	    $ImageMsgType = "alert-danger";
	}
	

    header('location:edit_campaign.php?campaignID='.$campaignID.'&ImageMsg='.$ImageMsg.'&ImageMsgType='.$ImageMsgType."&msgImageIcon=".$msgImageIcon);
}
else 
{
  header('location:campaigns_list.php');
}

exit;