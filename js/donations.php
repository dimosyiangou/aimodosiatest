<?php 
session_start(); 
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
  //Request identified as ajax request

  
    if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1 ){

?>
<script>

var globalEdit;
var globalID;

function deleteDonation(id)
{
var selected = document.getElementsByClassName("tableItem");	
if (selected.length!=0)
{
alert("Δεν μπορείτε να διαγράψετε την αιμοδοσία γιατί δεν είναι κενή");
}else {
if (confirm('Είστε σίγουρος για την διαγραφή?')) {
		if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var a = 1;
		xmlhttp.onreadystatechange=function() {
			console.log('in function');
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				if(xmlhttp.responseText.indexOf("fail remove")>0){
				
				alert("Η Αιμοδοσία δεν μπορεί να διαγραφή απο το σύστημα. Υπάρχουν δεδομένα στο σύστημα ενωμένα με αυτην την αιμοδοσία. ");
				}else{
					
					window.location.hash = '#!/pages/donationsPanel/donateDonorList';
				}
			}
		}
		
		var sele= document.getElementById("dateDropDown").value;
		xmlhttp.open("POST","libs/aimodosiesRequests.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded"); 
		xmlhttp.send("deleteId="+sele);
		window.location.reload();
		}

	}

}

//~~~~~~~~~~~~~ Eisagei imerominies aimodosiwn ~~~~~~~~~~~~~~~~~
function aimodosiesAdd(edit){
	if(edit){
		var selected = document.getElementById("dateDropDown").value;
		var selectedDate = document.getElementById("dateDropDown").options[document.getElementById("dateDropDown").selectedIndex].text;
	}
	
	//globalEdit=edit;
	//globalID=selected;
	//alert(selected);
	var dummy = '<div id="divaki" class="confirmDate" align="center">';
	
	if(edit==true){
		dummy += '<label for="date"><h3>Επεξεργασία Ημερομηνίας:</h3></label>';
		dummy += '<label class="confirmDate" for="date">Ημερομηνία:</label>';
		dummy += '<input class="confirmDate" type="date" name="date" id="date" value="'+selectedDate+'">';
		dummy += '<input class="confirmDate" type="button" name="confirmDate" value="Επικύρωση ημ/νίας" onclick="updateDate('+selected+')">';
		
	}else{
		selected=-1;
		dummy += '<label for="date"><h3>Δημιουργία Αιμοδοσίας:</h3></label>';
		dummy += '<label class="confirmDate" for="date">Ημερομηνία:</label>';
		dummy += '<input class="confirmDate" type="date" name="date" id="date" value="">';
		dummy += '<input class="confirmDate" type="button" name="confirmDate" value="Επικύρωση ημ/νίας" onclick="updateDate('+selected+')">';
		
	}
	dummy += '<input class="confirmDate" type="button" name="Cancel" value="Ακυρο" onclick="confirmDate()"></div>';
	document.getElementById('fixAimodosies').innerHTML += dummy;
	var nodes = document.getElementById('topAimodosies').childNodes;
	disableElementChild(nodes,true);
	
}

// ~~~~~~~~~~~~~~~~~~~~~ Update / confirm imerominiwn kai diaxeirisi elements ~~~~~~~~~~~~~~~~~~

function updateDate(editID) {
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var a = 1;
		
	xmlhttp.onreadystatechange=function() {
		
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("dropDownSpan").innerHTML = xmlhttp.responseText;
			if(editID==-1){
				var theSelect = document.getElementById("dateDropDown");
				var lastValue = theSelect.options[theSelect.options.length - 1].value;
				document.getElementById("dateDropDown").value = lastValue;
			}else {
				document.getElementById("dateDropDown").value = editID;
			}
			confirmDate();
		}
	}
	xmlhttp.open("POST","libs/aimodosiesRequests.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	if(editID==-1){
		xmlhttp.send("insert="+document.getElementById("date").value);
	}else{
		xmlhttp.send("edit="+editID+"&date="+document.getElementById("date").value);
	}
  
}

function confirmDate(){
	var elem = document.getElementById("divaki");
	elem.parentNode.removeChild(elem);
	elem = document.getElementById('topAimodosies').childNodes;
	disableElementChild(elem,false);
}

function disableElementChild(elem, disable){
	for(var i=0;i<elem.length;i++){
		elem[i].disabled=disable;
		var childOfChild = elem[i].childNodes;
		for(var j=0;j<childOfChild.length;j++){
			childOfChild[j].disabled=disable;
		}
	}
}

//~~~~~~~~~~~~~~~~ DROP DOWN on change event Imerominies gemizei table ~~~~~~~~~~~~~~

function donateDonorList() {
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
			document.getElementById("bodyAimodosiesTable").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST","pages/donationsPanel/donateDonorList.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("list="+selected);
  
}



//~~~~~~~~~~~~~~~~~ Anairesi se pinaka aimodosiwn ana imerominia~~~~~~~~~~~~~~

function donateDonorListRemove(item) {
	if (confirm('Είστε σίγουρος για την λειτουργία Αναίρεσης?')) {
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
				document.getElementById("arrayDonationDonor").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("POST","pages/donationsPanel/donateDonorList.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("list="+selected+"&item="+item);
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
