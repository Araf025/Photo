<html>
	<head>
		<style> 
				#userLogin { position:absolute; top: 180px; left: 750px; }
				h1{ position:absolute; top: 70px; left: 800px; }
		</style>
		<script type="text/javascript">
			function Verify(msd) {
				var username=document.getElementById('uname').value;
				var password=document.getElementById('upass').value;
				if(username==""){
						document.getElementById('usernameId').innerHTML = "Username Field cann't be Empty";
				}
				else if(password==""){
						document.getElementById('passwordId').innerHTML = "Password Field cann't be Empty";
				}
				else if(msd.getAttribute("type")=="button"){
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							var str = xmlhttp.responseText;
							if(str=="validUser"){ document.db.submit(); }
							else{ alert(str); }
						}
					};
					var url="registrationValidation.php?signal=loginValidation&name="+username+"&pass="+password;
					xmlhttp.open("GET", url, true);
					xmlhttp.send();
				}
				else{
					document.getElementById('passwordId').style.display = "none";
					document.getElementById('usernameId').style.display = "none";
				}
			}
		</script>
	</head>
	<body >
		<div > <img src="./images/giphy.gif"  style="width:700px; height:100%;">	</div> <br/> <br/>
		<h1> Login Here </h1>
		<div id="userLogin" > 
			<form action="profile.php" name="db" method="POST" >
				Username : <input type="text" name="username" id="uname" onkeyup="Verify(this)"> 	<div id="usernameId"></div>	<br/> <br/>
				Password : <input type="password" id="upass" onkeyup="Verify(this)"> <div id="passwordId"></div>	<br><br>	
				<input type="button" name="lgButton" value="Login" onclick="Verify(this)"> <br/> <br/>
				<a href="registration.html" style="font-size: 150%; text-decoration:none; ">Click here ,for Registration.......</a>
			</form>
		</div>
	</body>
</html>