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
	if(isset($_REQUEST['searchbox'])){
		$sql="select * from imagetable where Tag='".$_REQUEST['searchbox']."'";
		$jsonString= getJSONFromDB($sql);
		$pic=json_decode($jsonString);
	}
?>
<html> 
	<body> 
			<a href="homepage.php" style="text-decoration:none"> <input type="button" value="Back To HomePage" /> </a> <br/> <br/>
			<div> 
				<table>
					<?php for($i=0; $i<count($pic); $i+=3){ ?>
						<tr >
							<td>
								 <img  src="<?php echo $pic[$i]->ImagePath; ?>" width="300px" height="300px" />
							</td>
							<?php if($i+1 < count($pic)) { ?>
								<td>
									<img  src="<?php echo $pic[$i+1]->ImagePath; ?>" width="300px" height="300px" /> 
								</td> 
							<?php } 
							if($i+2 < count($pic)) { ?>
								<td>
									 <img    src="<?php echo $pic[$i+2]->ImagePath; ?>" width="300px" height="300px" /> 
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