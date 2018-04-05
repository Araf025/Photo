<?php
	session_start();
	$target_dir = "images/";
	$temp = $_FILES['fileToUpload']['type'];
	$a = explode("/",$temp);
	$target_file = $target_dir.$_SESSION["currentUserID"].rand(10,10000).".".end($a);
	if($a[0] !="image"){
		echo "Select a image file";
	}
	else if (file_exists($target_file)) {
		echo "Sorry, file already exists<br>";
	}
	else if ($_FILES["fileToUpload"]["size"] > 50000000) {
		echo "File size exceeded<br>";
	}
	else{
		if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$sql ="update userinfotable set ProfilePic='".$target_file."' WHERE userID=".$_SESSION["currentUserID"]; 
			$conn = mysqli_connect("localhost", "root", "", "traveldatabase");		
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			if (mysqli_query($conn, $sql)) {
				echo "Profile Picture updated successfully";
				header('Location: profile.php');
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			
			echo "The file ".  $_FILES["fileToUpload"]["name"]. " has been uploaded<br>";
		}else {
			echo "Sorry, there was an error uploading your file<br>";
		}
	}
?>