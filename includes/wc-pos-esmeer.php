<?php

/*
Functions for Esmeer customizations to WooPOS
 */

function verify() {
	$current_user = wp_get_current_user();
	if($current_user->user_level == 10) {
		return 1;//if they're an admin don't bother with lookup
	}

	$data = __DIR__ . "/stores/pc.dat";
	if(!file_exists($data)) {
		return -1;
	}

	$result = strstr(shell_exec("grep $current_user $here/stores/pc.dat"),',');//look them up in table, keep the category info
	if($result) {
		return substr($result,1); //remove leading comma
	}
	return -1;
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
	shell_exec("mv $here/$backupdir/$patchdir/* $here/$backupdir");
	shell_exec("rm -R $here/$backupdir/$patchdir");
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


//do all activation tasks
function esmeer_activator() {
	patch();
}
