<?php
	$uname = $_GET['q'];
	$uname = escapeshellcmd($uname);
	shell_exec("sed -i '/$uname/d' pc.dat");
?>
