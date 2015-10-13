<?php

/*
Functions for Esmeer customizations to WooPOS
*/

function verify(){
	$current_user = wp_get_current_user();
	$dbname = "pos";
	// Create connection
	$conn = connectmysql();
	$conn->query("USE " . $dbname);

	$sql = "SELECT storename FROM username_store WHERE username = '" . $current_user->user_login . "'";
	$result = $conn->query($sql);
	$row = $result->fetch_row();
	$conn->close();
	
	if( count($row)>=1){
		return $row[0];
	}
	if($current_user->user_level == 10){
		return 1;
	}
	else{
		return -1;
	}
}

function connectmysql(){
	$servername = "localhost";
	$username = "root"; //this should change later
	$password = "root"; //this too
	$conn = new mysqli($servername, $username, $password);
	if($conn->connect_error) {
		die("Couldn't connect to MySQL: " . $conn->connect_error);
	}
	return $conn;
}
