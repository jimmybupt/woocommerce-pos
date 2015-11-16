<?php

	$con = mysqli_connect('localhost','root','root','pos');
	if(!$con) {
		die();
	}

	$uname = $_GET['q'];
	$uname = mysqli_real_escape_string($con, $uname);
	$query = "DELETE FROM username_store WHERE username=".'"';
	$query .= "$uname";
  $query .= '";';
	mysqli_query($con,$query);
	mysqli_close($con);
?>
