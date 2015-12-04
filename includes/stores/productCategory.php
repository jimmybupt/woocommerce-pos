<html>
<head>
	<link rel="stylesheet" type = "text/css" href = "style.css">
	<script src="productCategory.js"></script>
	</head>
	
<body>
<p> <a href="../../../../../pos">Return to POS</a> </p>
<?php
require_once('../../../../../wp-config.php');
if(wp_get_current_user()->user_level == 10) {
	if(isset($_GET["addUName"]) && isset($_GET["addCName"]) ){
		$uname = escapeshellcmd($_GET["addUName"]);
		$cname = $_GET["addCName"];
		if(!shell_exec("grep $uname, pc.dat")) {
			file_put_contents("pc.dat","$uname,$cname\n",FILE_APPEND);
		}
	}
	if( isset($_GET["deleteUName"])){
		$uname = $_GET['deleteUName'];
		$uname = escapeshellcmd($uname);
		shell_exec("sed -i '/$uname/d' pc.dat");
	}
	//print real page
	echo "<div class = \"title\">
<p>Current Associations</p>";

	echo "<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>";

if(!file_exists("pc.dat")) {
	shell_exec("touch pc.dat");
}
$h = fopen("pc.dat","r");

echo "<table>
<tr>
<th>Username</th>
<th>Product Category</th>

</tr>";
while($line = fgets($h)) {
	$words = explode(',',$line);
	if(count($words) == 2) {
    	echo "<tr>";
    	echo "<td>" . $words[0] . "</td>";
    	echo "<td>" . $words[1] . "</td>";
	 	echo "</tr>";
	}
}
echo "</table>";
fclose($h);
//end table

echo"</br>
<div class = \"title\">

<p>Delete user:</p>

<div class = \"box\">
<form id=\"deleteRow\" action=\"$PHP_SELF \" method=\"GET\">
	<input type=\"text\" id=\"deleteUName\" name=\"deleteUName\">
	<input type=\"submit\" value=\"Delete\">
</form>
</div>
</div>
</br>
<div class = \"title\">

<p>Add user:</p>

<div class = \"box\">
<form id=\"addRow\" action=\"$PHP_SELF \" method=\"GET\">
	<p>Username</p>
	<input type=\"text\" id=\"addUName\" name=\"addUName\">
</br>
<p>Product Category</p>

	<input type=\"text\" id=\"addCName\" name=\"addCName\">
	<input type=\"submit\" value=\"Add\">
</form>
</div>
</div>";

	
} else {
	echo "This is an administration page.\n";
}
?>
</body>
</html>