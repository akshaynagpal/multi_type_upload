<?php
$allowedExts = array("mp4","wmv");
//$extension = pathinfo($_FILES['uploadimage']['name'], PATHINFO_EXTENSION);
$temp = explode(".", $_FILES["uploadvideo"]["name"]);
$extension = end($temp);

if (
	$_FILES["uploadvideo"]["type"] == "video/x-ms-wmv"
	&&
	in_array($extension, $allowedExts)
	)
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
				echo "$fileName upload is complete";
			} 
			else {
				echo "move_uploaded_file function failed";
			}


}
else
{
	echo "PHP!Not an image! ";//.$extension." ".$_FILES["uploadimage"]["type"];
	}
?>