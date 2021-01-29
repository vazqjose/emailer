<?php

include_once "db/db.php";

	function resize_image($file, $max_resolution)
	{
		if(file_exists($file))
		{
			$original_image = imagecreatefromjpeg($file);
			// resolution
			$original_width = imagesx($original_image);
			$original_height = imagesy($original_image);

			//try width first
			$ratio = $max_resolution / $original_width;
			$new_width = $max_resolution;
			$new_height = $original_height * $ratio;

			//if that iddnt work
			if ($new_height > $max_resolution) 
			{
				$ratio = $max_resolution / $original_height;
				$new_height = $max_resolution;
				$new_width = $original_width * $ratio;
			}

			if ($original_image)
			{
				$new_image = imagecreatetruecolor($new_width, $new_height);
				imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
				imagejpeg($new_image, $file, 90);
			}
		}
	}

    	if(isset($_FILES['image']) && $_FILES['image']['type'] == 'image/jpeg')
    	{
    		print_r($_FILES);
			$path = 'uploads/';
    		move_uploaded_file($_FILES['image']['tmp_name'], $path.$_FILES['image']['name']);
    		
    		$tmp_file = $_FILES['image']['tmp_name'];
    		$filename = $_FILES['image']['name'];
    		resize_image($path.$filename, "200");
			$myfile = addslashes(file_get_contents($path.$filename));
		    
		    // add campaign image
		    mysqli_query($conn, "INSERT INTO images(filename, campaignID) VALUES ('$filename', '2')") or die("Error adding image --> ".mysqli_error($conn));
    		echo "<img src='$path$filename' />";
    	}
    
    
/*---------------------------------------------------------------------------*/
 ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>IMAGE UPLOAD TEST</title>

</head>

<body>

<form method="post" enctype='multipart/form-data'>
    <input type='file' name='image' /><br/>
    <input type='submit' value="post image" />
  </form>

</body>
</html>
