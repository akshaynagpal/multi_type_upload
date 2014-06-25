<?php

$allowedExts = array("mp4","wmv","mpeg");
//$extension = pathinfo($_FILES['uploadimage']['name'], PATHINFO_EXTENSION);
$temp = explode(".", $_FILES["uploadvideo"]["name"]);
$extension = end($temp);

if (
	$_FILES["uploadvideo"]["type"] == "video/x-ms-wmv"||
	$_FILES["uploadvideo"]["type"] == "video/x-ms-mp4"||
	$_FILES["uploadvideo"]["type"] == "video/x-mpeg"||
	$_FILES["uploadvideo"]["type"] == "video/mp4"
	&&
	in_array($extension, $allowedExts)
	)
  	{
		
		if(($_FILES["uploadvideo"]["size"])<=51242880)
		{
			$fileName = $_FILES["uploadvideo"]["name"]; // The file name
			$fileTmpLoc = $_FILES["uploadvideo"]["tmp_name"]; // File in the PHP tmp folder
			$fileType = $_FILES["uploadvideo"]["type"]; // The type of file it is
			$fileSize = $_FILES["uploadvideo"]["size"]; // File size in bytes
			$fileErrorMsg = $_FILES["uploadvideo"]["error"]; // 0 for false... and 1 for true
			
			/*
			if (!$fileTmpLoc) { // if file not chosen
				echo "ERROR: Please browse for a file before clicking the upload button.";
				exit();
				}
			*/
			
			if(move_uploaded_file($fileTmpLoc, "test_uploads/".$fileName)){
				
				echo "$fileName upload is complete".$_FILES["uploadvideo"]["type"];
				
				//thumbnail from video
				
				$ffmpeg = 'C:\\wamp\\bin\\ffmpeg.exe';
				$video = 'test_uploads/'.$_FILES["uploadvideo"]["name"];
				$thumb = 'test_uploads/snaps/thumb_'.$temp[0].'.jpg';
				$thumb2='test_uploads/snaps/thumb2_'.$temp[0].'.jpg';
				$interval = 25;
				$size = '150x150';
				$size2= '300x300';
				
				//making 150 thumb
				$cmd = "$ffmpeg -i $video -an -ss $interval -s $size $thumb";
				if (shell_exec($cmd))
				echo "<br />ERROR Making Thumbnail 1! please try again!";
				
				//making 300 thumb
				$cmd2 = "$ffmpeg -i $video -an -ss $interval -s $size2 $thumb2";
				if (shell_exec($cmd2))
				echo "<br />ERROR Making Thumbnail 2! please try again!";
				
				
				
			} 
			else {
				echo "move_uploaded_file function failed";
			}

		}
		else
		{
		  echo "File size exceeds 5 MB! Please try again!";
		}
}
else
{
	echo "PHP! Not a video! ";//.$extension." ".$_FILES["uploadimage"]["type"];
	}
?>