<?php 
session_start(); 
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
  //Request identified as ajax request


    if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1 ){

?>
<script>

var donorID;

function donorChoice(donor){
	donorID = donor.id.substr(0, donor.id.indexOf('c')); 
	document.getElementById("recipientList").disabled = true;
	document.getElementById("searchUser").disabled = true;
	//$('#recipientList').find('*').attr('disabled', true);
	document.getElementById("recipient").style.display = 'block';
	document.getElementById("successMSG").innerHTML = " ";
	document.getElementById("failMSG").innerHTML = " ";
	
	document.getElementById(donorID+"tr").style.border = '1px solid black';
	var elem = document.getElementsByName("recipientChoice");
	
	for(var i=0;i<elem.length;i++){
			elem[i].className = "buttonDisabled";
	}
	
}
function cancelRecipient(){
	document.getElementById("day").value = "";
	document.getElementById("month").value = "";
	document.getElementById("year").value = "";
	document.getElementById("lastName").value = "";
	document.getElementById("firstName").value = "";
	document.getElementById("hospital").value = "";
	document.getElementById("hospitalCity").value = "";
	document.getElementById("flasks").value = "";
	document.getElementById("recipient").style.display = 'none';
	document.getElementById("searchUser").disabled = false;
	$('#recipientList').find('*').attr('disabled', false);
	document.getElementById(donorID+"tr").style.border = '';
	var elem = document.getElementsByName("recipientChoice");
	
	for(var i=0;i<elem.length;i++){
			elem[i].className = "button1";
	}

}

function confirmRecipient(){
	var allizwell = true;
	var lastName = document.getElementById("lastName").value;
	var firstName = document.getElementById("firstName").value;
	var hospital = document.getElementById("hospital").value;
	var hospitalCity = document.getElementById("hospitalCity").value;
	if(document.getElementById("day").value>31){
		allizwell = false;
		document.getElementById("day").style.border = "1px solid red";
	}else{
		document.getElementById("day").style.border = "1px solid gray";
	}
	if(document.getElementById("month").value>12){
		allizwell = false;
		document.getElementById("month").style.border = "1px solid red";
	}else{
		document.getElementById("month").style.border = "1px solid gray";
	}
	if(document.getElementById("year").value<1980 && document.getElementById("year").value!=""){
		allizwell = false;
		document.getElementById("year").style.border = "1px solid red";
	}else{
		document.getElementById("year").style.border = "1px solid gray";
	}
	if((document.getElementById("year").value!="" && document.getElementById("month").value!="" && document.getElementById("day").value!="") || (document.getElementById("year").value=="" && document.getElementById("month").value=="" && document.getElementById("day").value=="")){
	
	}else{
		allizwell = false;
		$(".dateFields").css("border-color", "red");
	}
	var flasks = document.getElementById("flasks").value;
	if(onlyNumCheck(flasks)!=1){
		allizwell = false;
		document.getElementById("flasks").style.border = "1px solid red";
	}else{
		document.getElementById("flasks").style.border = "1px solid gray";
	}
	var date = document.getElementById("day").value+"/"+document.getElementById("month").value+"/"+document.getElementById("year").value;
	//alert("a" + " donorID: "+ donorID+" "+lastName+" "+firstName+" "+hospital+" "+hospitalCity+" "+date);
	if(allizwell){
		if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else { // code for IE6, IE5
		
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		var a = 1;
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementsByClassName("mainColumnField")[0].innerHTML = xmlhttp.responseText;
				
			}
		}
		xmlhttp.open("POST","pages/recipientsPanel/recipientPanel.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("lastName="+lastName+"&firstName="+firstName+"&hospital="+hospital+"&hospitalCity="+hospitalCity+"&date="+date+"&flasks="+flasks+"&donorID="+donorID);
	}
}
function recipientsListSearch() {
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var a = 1;
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			//alert(xmlhttp.responseText);
			document.getElementById("recipientList").innerHTML = xmlhttp.responseText;
		}
	}
	var searchUser = document.getElementById("searchUser").value;
	xmlhttp.open("POST","pages/recipientsPanel/recipientPanel.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("&searchUser="+searchUser);
  
}
function recipientRemove(recipient) {
	//recipient = recipient.id.substr(0, recipient.id.indexOf('rec')); 
	recipient = recipient;
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var a = 1;
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			location.hash = "#!/pages/recipientsPanel/recipients";
			//document.getElementById("recipientListArray").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST","pages/recipientsPanel/recipients.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("recipient="+recipient);
  
}
</script>
	<?php
	 }else {
     //echo 'userT';
    }
  
}
else {
  echo 'request';
}
?>
