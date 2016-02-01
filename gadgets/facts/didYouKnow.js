function facts(){
	
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var a = 1;
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("facts").innerHTML = xmlhttp.responseText;
		}
	}
	$random = Math.floor(Math.random() * 4) + 1;
	xmlhttp.open("POST","gadgets/facts/didYouKnow.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("fact="+$random)

	}