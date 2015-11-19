<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
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
?>
</body>
</html>
