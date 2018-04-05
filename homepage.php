 <?php
	function getJSONFromDB($sql){
		$conn = mysqli_connect("localhost", "root", "","traveldatabase");
		$result = mysqli_query($conn, $sql)or die(mysqli_error());
		$arr=array();
		while($row = mysqli_fetch_assoc($result)) {
			$arr[]=$row;
		}
		return json_encode($arr);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<style>
			h1 { position: absolute; top: 5px; left: 40%; }
			#topImage{	position:absolute; height: 120px; left: 50px; }
			#topSearch{ position: absolute; top: 140px; left: 20px; margin: 20px; }
			#login{ position: absolute; top: 140px; left: 820px;}
			table{ position: absolute; top: 260px; width: 80%; };
		</style>
		<script>
			
		</script>
	</head>
	<body>
		<img id="topImage"  src="./images/Camera.png"><h1>PHOTOGRAPHIA</h1>
		<hr>
		<div id="topSearch"> 
			<form action="search.php"  name="searchForm">
				<input type="text" name="searchbox" id="searchInboxId"/>
				<input type="button" value="Search" onclick="searchFunction()"/>	
			</form>
			
		</div>
		<div id="login"> 
			<a href="registration.html"> <img src="./images/signin.png"  style="width:90px;height:40px; margin-left:50px;"> </a>
			<a href="login.php"> <img src="./images/login.png"  style="width:90px;height:40px; margin-left: 40px; ">  </a>
		</div>
		<br>
		<div>Latest blog</div>
		<div id="table"> 
			<table >
				<?php
					$sql="select * from imagetable";
					$jsonString= getJSONFromDB($sql);

					$pic=json_decode($jsonString);
					for($i=0; $i<count($pic); $i+=3){ ?>
						<tr >
							<td>
								<img  id="imgAnimation"  src="<?php echo $pic[$i]->ImagePath; ?>" width="300px" height="300px" />
							</td>
							<?php if($i+1 < count($pic)) { ?>
								<td>
									<img id="imgAnimation"  src="<?php echo $pic[$i+1]->ImagePath; ?>" width="300px" height="300px" />
								</td> 
							<?php } 
							if($i+2 < count($pic)) { ?>
								<td>
									<img  id="imgAnimation" src="<?php echo $pic[$i+2]->ImagePath; ?>" width="300px" height="300px" />
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
	<script> 
			function searchFunction(){
				var value=document.getElementById('searchInboxId').value;
				if(value !=""){ 
					document.searchForm.submit();
				}
				else{ 
					alert("Please Type a keyword to Search");  
				}
			}
	</script>
</html>