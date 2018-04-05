<?php
	session_start();
	$target_dir = "images/";
	$temp = $_FILES['fileToUpload']['type'];
	$a = explode("/",$temp);
	$target_file = $target_dir.$_REQUEST['imageLocation'].rand(10,10000).".".end($a);
	if($a[0] !="image"){
		echo "Select a image file";
	}
	else if (file_exists($target_file)) {
		echo "Sorry, file already exists<br>";
	}
	else if ($_FILES["fileToUpload"]["size"] > 500000000) {
		echo "File size exceeded<br>";
	}
	else{
		if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$sql="INSERT INTO imagetable (UserID, ImagePath, ImageLocation, Tag)
					VALUES ('". $_SESSION["currentUserID"]."','". $target_file ."','". $_REQUEST['imageLocation']."','".$_REQUEST['imageTag']."')";

			$conn = mysqli_connect("localhost", "root", "", "traveldatabase");
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			if (mysqli_query($conn, $sql)) {
				echo "Image Uploaded successfully";
				header('Location: profile.php');
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}	
		}else {
			echo "Sorry, there was an error uploading your file<br>";
		}
	}
?>