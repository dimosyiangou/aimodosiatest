<?php 
session_start(); 
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
  //Request identified as ajax request

 
    if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1 ){

?>
<script>

function addNews() {
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var a = 1;
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("newsPanel").innerHTML = xmlhttp.responseText;
			window.location.hash = window.location.hash.split('&')[0]+"&v=created";
		}
	}
	var header = document.getElementById("toPostHeader").value;
	var body = document.getElementById("toPostBody").value;
	xmlhttp.open("POST","pages/news.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("header="+header+"&body="+body);
  
}
function removeNews(idDelete) {
	var idDelete= idDelete.substr(0, idDelete.indexOf('d')); 
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var a = 1;
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("newsPanel").innerHTML = xmlhttp.responseText;
			window.location.hash = window.location.hash.split('&')[0]+"&v=deleted"+idDelete;
		}
	}
	xmlhttp.open("POST","pages/news.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("idDelete="+idDelete);
  
}

function editNews(idEdit) {
	var idEdit= idEdit.substr(0, idEdit.indexOf('e')); 
	
	// Ksexorizw tin id tou header kai topothetw to periexomeno sto textbox
	var header = document.getElementById(idEdit+"header").innerHTML;
	document.getElementById(idEdit+"header").innerHTML = "<input class='textBox' type='text' id='editHeader' >";
	document.getElementById("editHeader").value = header;
	
	// Ksexorizw tin id tou body kai topothetw to periexomeno sto textbox
	var body = document.getElementById(idEdit+"body").innerHTML;
	document.getElementById(idEdit+"body").innerHTML = "<textarea class='textBox' id='editBody'></textarea>";
	document.getElementById("editBody").innerHTML = body;
	
	document.getElementById(idEdit+"edit").value = "Αποθήκευση";
	document.getElementById(idEdit+"edit").onclick = function(){saveNews(this.id);};
	
	document.getElementById(idEdit+"delete").value = "Άκυρο";
	document.getElementById(idEdit+"delete").onclick = function(){cancelNews();};
	
	var elem = document.getElementsByName("editNewsButton");
	
	for(var i=0;i<elem.length;i++){
		if(elem[i].id != (idEdit+"edit")){
			elem[i].disabled = true;
			elem[i].className = "buttonDisabled";
		}
	}
}
function saveNews(idEdit) {

	var idEdit= idEdit.substr(0, idEdit.indexOf('e')); 
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var a = 1;
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("newsPanel").innerHTML = xmlhttp.responseText;
			window.location.hash = window.location.hash.split('&')[0]+"#edited"+idEdit;
		}
	}
	var header = document.getElementById("editHeader").value;
	var body = document.getElementById("editBody").innerHTML;
	xmlhttp.open("POST","pages/news.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("idEdit="+idEdit+"&editedHeader="+header+"&editedBody="+body);
}
function cancelNews() {

	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var a = 1;
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("newsPanel").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST","pages/news.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	}
	</script>
	<?php
	 }else {
     //echo 'user';
    }
}
else {
  echo 'request';
}
?>
