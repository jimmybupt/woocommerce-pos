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
					 forceEvaluation(xmlhttp.responseText);
                document.getElementById("main").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","verify.php",true);
        xmlhttp.send();
		
		  var main = document.getElementById("main");
		  var arr = main.getElementsByTagName('script')
			  for (var n = 0; n < arr.length; n++)
					{
						eval(arr[n].innerHTML);
					}
}
