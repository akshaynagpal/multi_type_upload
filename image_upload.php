<?php
$allowedExts = array("jpg", "jpeg", "gif", "png","wmv");
//$extension = pathinfo($_FILES['uploadimage']['name'], PATHINFO_EXTENSION);
$temp = explode(".", $_FILES["uploadimage"]["name"]);
$extension = end($temp);

if (
	$_FILES["uploadimage"]["type"] == "image/pjpeg"||
	$_FILES["uploadimage"]["type"] == "image/gif"|| 
	$_FILES["uploadimage"]["type"] == "image/jpeg"||
	$_FILES["uploadimage"]["type"] == "video/x-ms-wmv"
	&&
	in_array($extension, $allowedExts)
	)
  	{
			$fileName = $_FILES["uploadimage"]["name"]; // The file name
			$fileTmpLoc = $_FILES["uploadimage"]["tmp_name"]; // File in the PHP tmp folder
			$fileType = $_FILES["uploadimage"]["type"]; // The type of file it is
			$fileSize = $_FILES["uploadimage"]["size"]; // File size in bytes
			$fileErrorMsg = $_FILES["uploadimage"]["error"]; // 0 for false... and 1 for true
			
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
	echo "PHP!Not an image! ".$extension." ".$_FILES["uploadimage"]["type"];
	}
?>