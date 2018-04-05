<?php	session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<script>
			function validate(){
				flag=true;
				if(document.mfm.fileToUpload.value.length==0){
					flag=false;
					al
				}
				return flag;
			}
		</script>
	</head>
	<body>
		<form action="uploadProfilePicture.php" method="post" enctype="multipart/form-data" name="mfm"><pre>
		
			Select image to upload : <input type="file" name="fileToUpload" id="fileToUpload">
		 
			<input type="submit" onclick="return validate();" value="Upload File" name="submit"><pre>
		</form>
	</body>
</html>