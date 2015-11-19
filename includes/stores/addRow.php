<?php
	$uname = $_GET['q'];
	$cname = $_GET['r'];
	$uname = escapeshellcmd($uname);
  //$cname = escapeshellcmd($cname);
	if(!shell_exec("grep $uname, pc.dat")) {
		file_put_contents("pc.dat","$uname,$cname\n",FILE_APPEND);
	}
?>
