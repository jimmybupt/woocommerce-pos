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

//patch wordpress itself with all the files in the structure wp-patch saving the old files into wp-backup
function patch(){
	$patchdir = "wp-patch";
	$backupdir = "wp-backup";
	$here = __DIR__;
	$wppath = "../../../../";
	//use find to get the relpaths of all files in patchdir
	$files = explode("\n",shell_exec("find $here/$patchdir/. -type f"));
	//take out the mess that find put on front
	$files = preg_replace("|$here/$patchdir/\./|","",$files);
	shell_exec("cp -R $here/$patchdir $here/$backupdir");
	foreach($files as $filename) {
		if($filename) {
			shell_exec("cp $here/$wppath/$filename $here/$backupdir/$filename");
			shell_exec("cp $here/$patchdir/$filename $here/$wppath/$filename");
		}
	}
}

//restore wordpress to old state from backupdir
function unpatch(){
	$backupdir = "wp-backup";
	$here = __DIR__;
	$wppath = "../../../../";
	$files = explode("\n",shell_exec("find $here/$backupdir/. -type f"));
	$files = preg_replace("|$here/$backupdir/\./|","",$files);
	foreach($files as $filename) {
		shell_exec("cp $here/$backupdir/$filename $here/$wppath/$filename");
	}
	shell_exec("rm -rf $here/$backupdir");
}

