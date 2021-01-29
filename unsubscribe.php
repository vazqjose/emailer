
<?php

if ($_REQUEST["email"])
{
    $email = $_REQUEST["email"];
?>
        <script type="text/javascript">
            confirm('Desea eliminar su email '+ <?php echo $email ?>+' ?');
        </script>
<?php
    
    include_once "db/db.php";
    // REMOVE 
    mysqli_query($conn, "DELETE FROM recipients WHERE email = '$email'") or die(mysqli_error($conn));

    $msg = "<p align=center style='margin-top:10%'>".$email." ha sido removido de nuestra lista</p>";
    die($msg);
}


?>
