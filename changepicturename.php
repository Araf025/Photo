<html>
	<head>
		<script type="text/javascript">
			function changeName(){
				var oldName =document.getElementById('oldNameId').value;
				var newName =document.getElementById('newNameId').value;
				if(oldName =="" || newName==""){
					alert("Fields can't be empty");
				}else {
					var xmlhttp = new XMLHttpRequest();
						
					xmlhttp.onreadystatechange = function(){
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							alert(xmlhttp.responseText);
						}
					};
					var url="registrationValidation.php?signal=namechangeValidation&newPassword="+newPassword+"&oldPassword="+oldPassword;
					xmlhttp.open("GET", url, true);
					xmlhttp.send();
				}
			}
		</script>
	</head>
	<body > 
			<form action="" name="db" method="POST" >
				Old Name : <input type="text" name="oldName" id="oldNameId"> <br/> <br/>
				New Name : <input type="text" id="newNameId" > <div id="Hint"></div>	<br><br>	
				<input type="button" name="cnButton" value="Update Name" onclick="changeName()">
				<a href="profile.php">Go Back To Profile</a>
			</form>
	</body>
</html>