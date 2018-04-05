
<?php
	session_start();
	function getJSONFromDB($sql){
		$conn = mysqli_connect("localhost", "root", "","traveldatabase");
		$result = mysqli_query($conn, $sql)or die(mysqli_error());
		$arr=array();
		while($row = mysqli_fetch_assoc($result)) {
			$arr[]=$row;
		}
		return json_encode($arr);
	}
	$sql="select * from userinfotable where userID=".$_SESSION["currentUserID"];
	$jsonString= getJSONFromDB($sql);

	$user=json_decode($jsonString);
?>
<!DOCTYPE html>
<html>
	<head>
		<style> 
				#topheader{ position: absolute; top: 15px; left:30%; }
				#profilesrc{ position: absolute; top: 15px; left:40px; width: 200px; height: 200px; }
				#profilechange{ position: absolute; top: 250px; left:40px; background-color: black; text-color: white; }
				#logoutID{ position: absolute; top: 310px; left:40px; background-color: red; text-color: white; }
				#passwordchang{ position: absolute; top: 280px; left:40px; background-color: yellow; text-color: red;	}
				#uploadPic{ position: absolute; top: 20px; left:550px; }
				#secondheader{ position: absolute; top: 255px; left:25%; }
				#allImages{ position: absolute; top: 390px; }
				#deleteButton {position: absolute; top: 340px; left: 40px; }
		</style>
		<script src="jquery.js"></script>
		<script>
		 var hold ;
			function validate(){
				var flag=true;
				if(document.mfm.fileToUpload.value.length==0){
					flag=false;
				}
				if(document.mfm.imageLocation.value.length==0 || document.mfm.imagetag.value.length==0){
					flag=false;
				}
				return flag;
			}
			function imageDelete(mm){
						$(".imageall").hide();
						$(mm).show();
						hold = mm.getAttribute("src");
						document.getElementById('deleteButton').style.visibility = "visible";
			}
			function deleteCurrentImage(){
				var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function(){
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							alert(xmlhttp.responseText);
							location.reload(true);
						}
					};
				var url="registrationValidation.php?signal=deleteimage&ImagePath="+hold;
				xmlhttp.open("GET", url, true);
				xmlhttp.send();
			}
		</script>
	</head>
	<body>
		<h1 id="topheader"> <?php echo "Welcome ".$user[0]->FullName;  ?> </h1>
		<img id="profilesrc" src="<?php echo $user[0]->ProfilePic;  ?>" width="99px" height="80px" />
		<form id="profilechange" action="changeProfilePic.php">
			<input type="submit" value="Change Profile Picture" />
		</form>
		<form id="passwordchang"	action="changePassword.php">
			<input type="submit" value="Change Password" />
		</form>
		<form id="namechang"	action="changepicturename.php">
			<input type="submit" value="Change Name" />
		</form>
		<input id="deleteButton" type="button" value="Delete this Pic" onclick="deleteCurrentImage()" style="visibility: hidden;">
		<form action="logout.php" id="logoutID">
			<input type="submit" value="Logout"/>
		</form>
		<div id="uploadPic"> 
			<form action="uploadPicture.php" method="post" enctype="multipart/form-data" name="mfm"><pre>
				ImageLocation: <input type="text" name="imageLocation"> <br/><br/>
				Image Tag: <input type="text" name="imageTag"> <br/><br/>
				Select image to upload : <input type="file" name="fileToUpload" id="fileToUpload"> <br/><br/>
		 
				<input type="submit" onclick="return validate();" value="Upload File" name="submit"><pre>
			</form>
		</div>
		<h1 id="secondheader"> Your Uploaded Pictures Are Shown Below </h1>
		<div id="allImages" > 
			<table >
				<?php
					$sql="select * from imagetable where userID=".$_SESSION["currentUserID"];
					$jsonString= getJSONFromDB($sql);

					$pic=json_decode($jsonString); 
					
					for($i=0; $i<count($pic); $i+=3){ ?>
						<tr >
							<td>
								<img class="imageall" onclick="imageDelete(this)" src="<?php echo $pic[$i]->ImagePath; ?>" width="300px" height="300px" />
							</td>
							<?php if($i+1 < count($pic)) { ?>
								<td>
									<img class="imageall" onclick="imageDelete(this)" src="<?php echo $pic[$i+1]->ImagePath; ?>" width="300px" height="300px" />
								</td> 
							<?php } 
							if($i+2 < count($pic)) { ?>
								<td>
									<img class="imageall" onclick="imageDelete(this)" src="<?php echo $pic[$i+2]->ImagePath; ?>" width="300px" height="300px" />
								</td>
							<?php } ?>
							
						</tr> 
						<tr > 
							<td> <?php echo $pic[$i]->ImageLocation." || ".$pic[$i]->Tag; ?></td>
							<?php if($i+1 < count($pic)) { ?>
								<td>
									<td> <?php echo $pic[$i+1]->ImageLocation." || ".$pic[$i+1]->Tag; ?></td>
								</td> 
							<?php } 
							if($i+2 < count($pic)) { ?>
								<td>
									<td> <?php echo $pic[$i+2]->ImageLocation." || ".$pic[$i+2]->Tag; ?></td>
								</td>
							<?php } ?>
						</tr>
						
					<?php } ?>
			</table>
		</div>
	</body>
</html>	