
var globalEdit;
var globalID;

function aimodosiesAdd(edit){
	if(edit){
		var selected = document.getElementById("dateDropDown").value;
		var selectedDate = document.getElementById("dateDropDown").options[document.getElementById("dateDropDown").selectedIndex].text;
	}
	
	//globalEdit=edit;
	//globalID=selected;
	//alert(selected);
	var dummy = '<div id="divaki" class="confirmDate" align="center"<label class="confirmDate" for="date">Ημερομηνία:</label>';
	
	if(edit==true){
		dummy += '<input class="confirmDate" type="date" name="date" id="date" value="'+selectedDate+'">';
		dummy += '<input class="confirmDate" type="button" name="confirmDate" value="Επικύρωση ημ/νίας" onclick="updateDate('+selected+')">';
		
	}else{
		selected=-1;
		dummy += '<input class="confirmDate" type="date" name="date" id="date" value="">';
		dummy += '<input class="confirmDate" type="button" name="confirmDate" value="Επικύρωση ημ/νίας" onclick="updateDate('+selected+')">';
		
	}
	dummy += '<input class="confirmDate" type="button" name="Cancel" value="Άκυρο" onclick="confirmDate()"></div>';
	document.getElementById('fixAimodosies').innerHTML += dummy;
	var nodes = document.getElementById('topAimodosies').childNodes;
	disableElementChild(nodes,true);
	
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

function clearContent(idEl){
	var elem = document.getElementById(idEl);
	elem.parentNode.removeChild(elem);
}

function confirmDate(){
	//if(cancel==false){
		//updateDate();
	//}
	var elem = document.getElementById("divaki");
	elem.parentNode.removeChild(elem);
	elem = document.getElementById('topAimodosies').childNodes;
	disableElementChild(elem,false);
}

function alertTest(){
	var a;
	a=1;
	alert(a);
}
function defineUserType(){
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		
		}
	}
	xmlhttp.open("POST","libs/uType.php",false);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	return xmlhttp.responseText;
}
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
				alert(lastValue);
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

function phpLoadClass(elementClass, page, variable, i, spanPath) {
	if(spanPath!=0){
		document.getElementById('mainColumnHeader').innerHTML=spanPath;
	}
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var a = 1;
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementsByClassName(elementClass)[0].innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST",page,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("page="+variable);
  
}
function removeAlert(elementId, page, var1, var2){

if (confirm('Είστε σίγουρος για την διαγραφή?')) {
	phpLoadId(elementId, page, var1, var2)
} else {
}
}
function phpLoadId(elementId, page, var1, var2) {

    // Save it!

	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var a = 1;
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById(elementId).innerHTML = xmlhttp.responseText;
			
		}
	}
	xmlhttp.open("POST",page,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("var1="+var1+"&var2="+var2);
  
}
function donateDonorAddButton(donorId, anairesi) {
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
	xmlhttp.open("POST","pages/donationsPanel/donateDonorAdd.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("donateId="+selected+"&donorId="+donorId+"&anairesi="+anairesi+"&list="+selected);
}



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
			document.getElementById("arrayDonationDonorDiv").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST","pages/donationsPanel/donateDonorList.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("list="+selected);
  
}
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
	xmlhttp.open("POST","pages/donationsPanel/donateDonorAdd.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("list="+selected+"&searchUser="+searchUser);
  
}
function donateDonorListRemove(item) {
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

var flag = false ;
function openpopup(elem){
	document.getElementById("accountPopup").style.left = elem.getBoundingClientRect().left-70+"px";
	document.getElementById("accountPopup").style.top = elem.getBoundingClientRect().top+50+"px";
	
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else { // code for IE6, IE5
	
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var a = 1;
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		flag = true;
			document.getElementById("accountPopup").innerHTML = xmlhttp.responseText;
		
		}
	}
	xmlhttp.open("POST","menus/topPopup.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
}
$(document).ready(function(){
  $('#accountPopup').click(function(event){
    console.log('click - form');
    event.stopPropagation();
  });
  $('html').click(function(event){
    console.log('click - body');
    //hide the form if the body is clicked
    $('#accountPopup').css('display','none');
  });
  $('#account').click(function(event){
    $('#accountPopup').toggle();
    event.stopPropagation();
  });


});
//alert($(document).height());


// ~~~~~~~~~~~~~~~~~~~~~~~~~~footer stays down ~~~~~~~~~~~~~~~~~~~~~~~

$(document).ready(function(){
     var docHeight = $(window).height();
   var footerHeight = $('#footer').height();
   var footerTop = $('#footer').position().top + footerHeight;
   
   if (footerTop < docHeight) {
    $('#footer').css('margin-top',(docHeight - footerTop-70)+'px');
   }
   
  });
  
