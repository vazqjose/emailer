<?php 

	class Msg
	{
		function PrintMsg($message, $msgType, $msgIcon) 
		{
			echo 
				"<div class='alert alert-dismissible  ".$msgType."' alert-dismissible fade show' role='alert'><i class='".$msgIcon."'></i> <strong>".$message."</strong>
				</div>";
		}
	}

	class getTableColumn
	{
		function showField($fieldname, $tablename, $tableID, $value, $connection)
		{
			$querystring = "SELECT ".$fieldname." FROM ".$tablename." WHERE ".$tableID." = '".$value."'";
			$myquery = mysqli_query($connection, $querystring) or die(mysqli_error($connection));
			$myrow = mysqli_fetch_assoc($myquery);
			return $myrow[$fieldname];
		}
	}

	class Errors
	{
		function printErrors($inputArray) 
		{
					$msg = "<div class='alert alert-danger' role='alert' style='margin:10px'>";
					$msg .= "";
					$msg .= "<h4><span class='glyphicon glyphicon-alert' style='margin-right:10px;'></span> ".count($inputArray)." errors found, please correct them accordingly</h4>";
					$msg .= "<ul style='margin:10px auto;'>";

					for ($i=0; $i < count($inputArray); $i++)
					{
						$msg .= "<li>".$inputArray[$i]."</li>";
					}
					
					$msg .= "</ul>";
					$msg .= "</div>";

					return $msg;
		}
	}



?>