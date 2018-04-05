<html>
	<head>
		<script type="text/javascript">
			function changePasswod(){
				var oldPassword =document.getElementById('oldPasswordId').value;
				var newPassword =document.getElementById('newPasswordId').value;
				if(oldPassword =="" || newPassword==""){
					alert("Fields can't be empty");
				}else {
					var xmlhttp = new XMLHttpRequest();
						
					xmlhttp.onreadystatechange = function(){
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							alert(xmlhttp.responseText);
						}
					};
					var url="registrationValidation.php?signal=passwordchangeValidation&newPassword="+newPassword+"&oldPassword="+oldPassword;
					xmlhttp.open("GET", url, true);
					xmlhttp.send();
				}
			}
		</script>
	</head>
	<body > 
			<form action="" name="db" method="POST" >
				Old Password : <input type="text" name="oldPassword" id="oldPasswordId"> <br/> <br/>
				New Password : <input type="text" id="newPasswordId" > <div id="Hint"></div>	<br><br>	
				<input type="button" name="lgButton" value="Update Password" onclick="changePasswod()">
				<a href="profile.php">Go Back To Profile</a>
			</form>
	</body>
</html>