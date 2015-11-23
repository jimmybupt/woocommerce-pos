function verify() {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if(xmhlttp.readyState == 4 && xmhlttp.status == 200) {
			document.getElementById("main").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","verify.php",true);
	xmlhttp.send();
}
