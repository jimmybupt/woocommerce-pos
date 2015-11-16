<?php

	$con = mysqli_connect('localhost','root','root','pos');
	if(!$con) {
		die();
	}

	$uname = $_GET['q'];
	$cname = $_GET['r'];
	$uname = mysqli_real_escape_string($con,$uname);
	$cname = mysqli_real_escape_string($con,$cname);
	$query = "INSERT INTO username_store VALUES (";
	$query .= '"'.$uname;
	$query .= '","'."$cname".'");';
	if(!mysqli_query($con,$query)) echo mysqli_error($con);
	mysqli_close($con);
?>
