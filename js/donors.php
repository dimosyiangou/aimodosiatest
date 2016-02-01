<?php 
session_start(); 
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
  //Request identified as ajax request

    if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1 ){

?>
<script>

//~~~~~~~~~~~~~~~~~ Anazitisi/Fill Table me vasi DropDown kai searchText ~~~~~~~~~~~

function donateDonorListAdd() {
	var selected = document.getElementById("dateDropDown").value;
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
			document.getElementById("bodyAimodosiesTable").innerHTML = xmlhttp.responseText;
		}
	}
	var searchUser = document.getElementById("searchUser").value;
	xmlhttp.open("POST","pages/aimodotes/donateDonorAdd.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("list="+selected+"&searchUser="+searchUser);
  
}

//~~~~~~~~~~~~~~~~~ Anazitisi/Fill Table me vasisearchText ~~~~~~~~~~~

function donateDonorListSearch() {
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
			firstTime = false;
			
			window.location.hash = "#!/pages/aimodotes/aimodotes&searchUsers="+document.getElementById("searchUser").value+"&searchRezouss="+rezous;
			document.getElementById("aimodotesList").innerHTML = xmlhttp.responseText;
		}
	}
	var rezous = 0;
	var searchUser = document.getElementById("searchUser").value;
	
	if(document.getElementById("checkboxRezous").checked){
		document.getElementById("bloodTypeDropDown").disabled = false;
		rezous = document.getElementById("bloodTypeDropDown").value;
		
	}else{
	document.getElementById("bloodTypeDropDown").disabled = true;
	rezous = 0;
	}
	xmlhttp.open("POST","libs/aimodosiesRequests.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("searchUser="+searchUser+"&searchRezous="+encodeURIComponent(rezous));
  
}
/*
function deleteDonation(id)
{
var selected = document.getElementById("dateDropDown").value;
alert(selected);
}
*/
//~~~~~~~~~~~~~~~ Anairesi se pinaka aimodosiwn ana Lista Aimodotwn~~~~~~~~~~~

function donateDonorAddButton(donorId, anairesi) {
	if (confirm('Είστε σίγουρος για την ενέργεια αυτή?')) {
		var selected = document.getElementById("dateDropDown").value;
		if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else { // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		var a = 1;
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			//document.getElementById("arrayDonationDonor").innerHTML = xmlhttp.responseText;
			document.getElementById("bodyAimodosiesTable").innerHTML = xmlhttp.responseText;
			
			}
		}
		xmlhttp.open("POST","pages/aimodotes/donateDonorAdd.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("donateId="+selected+"&donorId="+donorId+"&anairesi="+anairesi+"&list="+selected);
	}
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
