<?php
require_once('../../../../../wp-config.php');
if(wp_get_current_user()->user_level == 10) {
	//print real page
	echo(file_get_contents("body.html"));
} else {
	echo "This is an administration page.\n";
}
?>
