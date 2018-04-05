<?php	session_start(); ?>
<?php
	function getJSONFromDB($sql){
		
		$con=mysqli_connect("localhost","root","","traveldatabase");
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$result = mysqli_query($con,$sql);	
		$arr=array();
		while($row = mysqli_fetch_assoc($result)) {
			$arr[]=$row;
		}
		return json_encode($arr);
	}
	if($_REQUEST["signal"]=="usernameCheck" && isset($_REQUEST['Username'])){
		$sql="select Username from userinfotable ";//where Username='".$_REQUEST['Username']."'";
		$jsonData= getJSONFromDB($sql);
		echo $jsonData;
	}
	if($_REQUEST["signal"]=="emailCheck" && isset($_REQUEST['emailName'])){
		$sql="select EmailAddress from userinfotable ";   //where EmailAddress='".$_REQUEST['emailName']."'";
		$jsonData= getJSONFromDB($sql);
		echo $jsonData;
	}
	if($_REQUEST["signal"]=="input"){
		$con=mysqli_connect("localhost","root","","traveldatabase");
		$sql="INSERT INTO userinfotable (FullName, EmailAddress, Username, Password) VALUES ('".$_REQUEST['FullName']."', '".$_REQUEST['email']."', '".$_REQUEST['Username']."', '".$_REQUEST['password']."')";

		if ($con->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}
	}
	if($_REQUEST["signal"]=="loginValidation"){
		$jsonData=getJSONFromDB("select userID, Username, Password from userinfotable");
		$jd=json_decode($jsonData);
		$value=0;

		for($i=0;$i<sizeof($jd);$i++){
			
			if( trim($jd[$i]->Username)==trim($_REQUEST['name']) && trim($jd[$i]->Password)==trim($_REQUEST['pass']) ){
			
				$value++;
				$_SESSION["currentUserID"] = $jd[$i]->userID; $value = 1;
				echo "validUser";
			}
		}
		if($value==0){ echo "Username and Password didn't match with the database"; }
	}
	if($_REQUEST["signal"]=="getUserDetails" && isset($_REQUEST['Username'])){
		$sql="select Username from userinfotable where Username='".$_REQUEST['Username']."'";
		$jsonData= getJSONFromDB($sql);
		echo $jsonData;
	}
	if($_REQUEST["signal"]=="passwordchangeValidation"){
		$con=mysqli_connect("localhost","root","","traveldatabase");
		$jsonData=getJSONFromDB("select Password from userinfotable WHERE userID=".$_SESSION["currentUserID"]);
		$jd=json_decode($jsonData);
		for($i=0;$i<sizeof($jd);$i++){
			
			if( trim($jd[$i]->Password)==trim($_REQUEST['oldPassword']) ){
				$ptr ="update userinfotable set Password='".$_REQUEST['newPassword']."' WHERE userID=".$_SESSION["currentUserID"]; 
				if (mysqli_query($con, $ptr)) {
					echo "Password updated successfully";
				} else {
					echo "Error: in Password Update"."<br>".mysqli_error($ptr);
				}			
			}else{
				echo "Old Password didn't match to the original Password";
			}
		}	
	}
	if($_REQUEST["signal"]=="deleteimage" && isset($_REQUEST['ImagePath'])){
		$sql="delete from imagetable where ImagePath='".$_REQUEST['ImagePath']."'";
		$con=mysqli_connect("localhost","root","","traveldatabase");
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		if (mysqli_query($con, $sql)) {
			echo "Image Deleted Successfully";
		} else {
			echo "Error: in Image Deleting "."<br>".mysqli_error($sql);
		}
	}
	if($_REQUEST["signal"]=="namechangeValidation"){
		$con=mysqli_connect("localhost","root","","traveldatabase");
		$jsonData=getJSONFromDB("select ImageLocation from imagetable WHERE userID=".$_SESSION["currentUserID"]);
		$jd=json_decode($jsonData);
		for($i=0;$i<sizeof($jd);$i++){
			
			if( trim($jd[$i]->name)==trim($_REQUEST['oldName']) ){
				$ptr ="update imagetable set imagelocation='".$_REQUEST['newName']."' WHERE userID=".$_SESSION["currentUserID"]; 
				if (mysqli_query($con, $ptr)) {
					echo "Name updated successfully";
				} else {
					echo "Error: in Name Update"."<br>".mysqli_error($ptr);
				}			
			}else{
				echo "Old Name didn't match to the original Name";
			}
		}	
	}
?>