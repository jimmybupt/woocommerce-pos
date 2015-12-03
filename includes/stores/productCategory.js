function printTable() {

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("tableView").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","viewTable.php",true);
        xmlhttp.send();
}

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
		printTable();
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
	printTable();
}

function verify() {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("main").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","verify.php",true);
        xmlhttp.send();
		  printTable();
}
