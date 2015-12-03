function deleteRow() {
	var uname = document.getElementById("deleteUName").value;
	if(uname == "") {
		return;
	}
	if (window.XMLHttpRequest) {
	   xmlhttp = new XMLHttpRequest();
	} else {
	 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	   xmlhttp.open("GET","deleteRow.php?q="+uname,true);
		xmlhttp.send();
}

function addRow() {
	var uname = document.getElementById("addUName").value;
	var cname = document.getElementById("addCName").value;
	if(uname == "" || cname == "") {
		return;
	}
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET", "addRow.php?q="+uname+"&r="+cname,true);
	xmlhttp.send();
}