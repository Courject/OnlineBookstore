<?php
	$con = mysqli_connect("localhost","root","root");
	if (!$con)
	{
		die('Could not connect: '.mysqli_error($con));
	}
	$name = $_POST["name"];
	$password = $_POST["password"];
	$sql="select * from person where name='$name' and pw='$password'";
	mysqli_set_charset($con,"utf-8");
	mysqli_select_db( $con,"onlinebook");
	$result=mysqli_query($con,$sql);
	if(mysqli_num_rows($result)!=0){
		$row = mysqli_fetch_array($result);
		echo $row['identity'];
	}
	else{
		echo "false";
	}
	mysqli_close($con);