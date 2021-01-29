<?php

include_once "include/checksession.php";
include_once "db/db.php";
require_once 'include/objects.php';
require_once 'include/functions.php';

$path = 'http://crosswebstudios.com/emailer';

if ($_REQUEST["campaignID"])
{
    $campaignID = $_REQUEST["campaignID"];

    $sql_campaign = "SELECT * FROM campaigns, email_headers WHERE campaigns.headerID = email_headers.id AND campaigns.id = '$campaignID'";
    $campaign_query = mysqli_query($conn, $sql_campaign) or die(mysqli_error($conn));
    $campaign_row = mysqli_fetch_assoc($campaign_query);

    $subject = $campaign_row['title'];
    $email_from = $campaign_row['email_from'];
    $sender_name = $campaign_row['sender_name'];
    $content = stripslashes($campaign_row['content']);
    $headerID = $campaign_row['headerID'];
    $header_name = $campaign_row['filename'];
    $description = $campaign_row['description'];

    $sender = '=?UTF-8?B?' . base64_encode($sender_name) . '?= <' . $email_from . '>';

    $images_query = mysqli_query($conn, "SELECT * FROM images WHERE campaignID = '$campaignID'") or die(mysqli_error($conn));

    if (mysqli_num_rows($images_query) > 0)
        {
          $images_row = mysqli_fetch_assoc($images_query);
          $image = $images_row['filename'];
          $mainimage = "<img src='$path/uploads/$image' align='center' style='display:block' />";
        }

    $message = "

    <table style='
            
            margin:20px auto; 
            width: 700px !important;
    '>
    <tr>
        <td>
        <img src='$path/images/$header_name' align='center' />
        $mainimage
        </td>
    </tr>
    <tr>
        <td style='
                padding:20px 0 0;
                color:#000;
                font-size: 150% !important;
                font-family: Open Sans;
                line-height:1.6 !important;
        '>
          $content
        </td>
    </tr>
    </table>
     ";
    
    $recipient_query = mysqli_query($conn, "SELECT email FROM recipients") or die(mysqli_error($conn));
    $myrows = mysqli_num_rows($recipient_query);

    if ($myrows > 0)
    { 
        while ($recipient_row = mysqli_fetch_assoc($recipient_query)) 
        {   
            $email_to[] = $recipient_row['email'];
        }

        for ($i=0; $i < $myrows; $i++)
        {    
                $footer = "
                <table style='
                        font-family: Open Sans;
                        margin:auto; 
                        width: 700px !important;
                        color:#000;
                '>
                <tr>
                <td style='
                    border-top:1px dotted #666;
                    text-align:center !important;
                    padding:20px 0 !important;
                    font-size: 100% !important;
                '>
                  <p>Netsky Store, IT Warehouse | 2421 Perla Del Sur Ponce By Pass Ponce, PR 00730</p>
                  <p><a href='$path/unsubscribe.php?email=".$email_to[$i]."' target='_new'>Para no recibir estas promociones, presione aqui</p>
                </td>
                </tr>
                </table>
                ";
                
               //sendemail($message.$footer, $subject, $email_to[$i], $sender);     
        }
        //die($message.$footer);
        
        for ($i=0; $i < $myrows; $i++)
        {
          echo $i."--".$email_to[$i]."<br>";
        }

        exit;
        
          $msg = "Campaign '" .$subject. "' sent!";
          $msgType = "alert-success";
          $msgIcon = "far fa-check-circle";
    }
    
}

        header('location:campaigns_list.php?msg='.$msg.'&msgType='.$msgType.'&msgIcon='.$msgIcon);
        exit;

?>
