<?php 
session_start(); 
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
  //Request identified as ajax request


    if(isset($_SESSION['userType'])){

?>
<script>

// ~~~~~~~~ Diagrafi Xristh ~~~~~~~~~~



function cancelEditProfile(userId){
	location.reload();
	document.getElementById("cancelEdit").style.display = "none";
}
var editPassFlag = false;
function changePassword(cancel){
	if(cancel){
		document.getElementById("changePass").style.display = "none";
		document.getElementById("changePassButton1").style.display = 'inline';
		document.getElementById('changePassMSG').innerHTML = ""
		document.getElementById("newPassword").value = "";
		document.getElementById('confirmPassword').value = "";
		editPassFlag = false;
	}else{
		if(editPassFlag){
			var username = document.getElementById("username").innerHTML;
			var password = document.getElementById("newPassword").value;
			var password2 = document.getElementById("confirmPassword").value;
			if(password == password2 && passwordCheck(password)==1){
				if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
				}else { // code for IE6, IE5
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				var a = 1;
				xmlhttp.onreadystatechange=function() {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						document.getElementById("changePass").style.display = "none";
						document.getElementById("changePassButton1").style.display = 'inline';
						document.getElementById('changePassMSG').innerHTML = "Αλλαγή Επιτυχής!";
						document.getElementById('changePassMSG').style.color = 'green';
						document.getElementById("newPassword").value = "";
						document.getElementById('confirmPassword').value = "";
						editPassFlag = false;
					}
				}
				alert(password);
				xmlhttp.open("POST","pages/userProfile/userProfileEdit.php",false);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("username="+username+"&password="+password);
			}else if (password != password2){ 
				document.getElementById('changePassMSG').style.color = 'red';
				document.getElementById('changePassMSG').innerHTML = 'Διαφορετικές Τιμές';
			}else{
				document.getElementById('changePassMSG').style.color = 'red';
				document.getElementById('changePassMSG').innerHTML = 'Λάθος κωδικός';
			}
		}
		else{
			document.getElementById("changePass").style.display = "block";
			document.getElementById("changePassButton1").style.display = 'none';
			document.getElementById('changePassMSG').innerHTML = "";
			editPassFlag = true;
		}
	}
}

function userProfile(userId) {
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
			  document.getElementById("bloodType").disabled=true;
			  window.location.hash = '#!/pages/userProfile/userProfile&user='+userId;
		}
	}
		xmlhttp.open("POST","pages/userProfile/userProfile.php",false);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("user="+userId);
	
}
function editFieldsUser() {
/*
  document.getElementById("email").setAttribute('contenteditable',true);
  document.getElementById("phone").setAttribute('contenteditable',true);
  document.getElementById("mobile").setAttribute('contenteditable',true);
  document.getElementById("city").setAttribute('contenteditable',true);
  document.getElementById("address").setAttribute('contenteditable',true);
  document.getElementById("TK").setAttribute('contenteditable',true);
  
  document.getElementById("email").style.border = '1px solid black';
  document.getElementById("phone").style.border = '1px solid black';
  document.getElementById("mobile").style.border = '1px solid black';
  document.getElementById("city").style.border = '1px solid black';
  document.getElementById("address").style.border = '1px solid black';
  document.getElementById("TK").style.border = '1px solid black';
  
  document.getElementById("email").style.lineHeight = '20px';
  document.getElementById("phone").style.lineHeight = '20px';
  document.getElementById("mobile").style.lineHeight = '20px';
  document.getElementById("city").style.lineHeight = '20px';
  document.getElementById("address").style.lineHeight = '20px';
  document.getElementById("TK").style.lineHeight = '20px';
  

 for(var i=0;i<document.getElementsByClassName("editable").length;i++){
	  document.getElementsByClassName("editable")[i].style.border =  '1px solid black';
	  document.getElementsByClassName("editable")[i].setAttribute('contenteditable',true);
	  document.getElementsByClassName("editable")[i].style.lineHeight = '20px';
	  document.getElementsByClassName("editable")[i].style.height = '20px';
	  document.getElementsByClassName("editable")[i].style.background =  'white';
	  
  } */
  $( ".editable" ).replaceWith( function() {
    return "<input type=\"text\" value=\"" + $( this ).html() + "\" id=\"" + $( this ).attr('id') + "\" class=\"" + $( this ).attr('class') + "\"/>";
});
  document.getElementById("cancelEdit").style.display = "inline";
  document.getElementById("editProfile").value = "Αποθήκευση";
document.getElementById("editProfile").onclick = function(){saveProfile(2);};
}
<?php 
	if($_SESSION['userType']==1){ ?>
	
	function removeAlert(elementId, page, var1, var2){

	if (confirm('Είστε σίγουρος για την διαγραφή?')) {
		phpLoadId(elementId, page, var1, var2)
	} else {
	}
}

function removeUser(userID){
	if (confirm('Είστε σίγουρος για την διαγραφή?')) {
		if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else { // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		var a = 1;
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				if(xmlhttp.responseText.indexOf("fail remove")>0){
					alert("Ο χρήστης δεν μπορεί να διαγραφεί από το σύστημα. Υπάρχει υπόλοιπο κινήσεων στον λογαριασμό του.");
				}else{
					window.location.hash = '#!/pages/aimodotes/aimodotes';
				}
			}
		}
		xmlhttp.open("POST","pages/userProfile/userProfileEdit.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("removeID="+userID);
	}
}

function editFieldsAdmin() {
/*
  document.getElementById("firstName").setAttribute('contenteditable',true);
  document.getElementById("lastName").setAttribute('contenteditable',true);
  document.getElementById("fatherName").setAttribute('contenteditable',true);
  document.getElementById("birthDate").setAttribute('contenteditable',true);
  document.getElementById("email").setAttribute('contenteditable',true);
  document.getElementById("phone").setAttribute('contenteditable',true);
  document.getElementById("mobile").setAttribute('contenteditable',true);
  document.getElementById("city").setAttribute('contenteditable',true);
  document.getElementById("address").setAttribute('contenteditable',true);
  document.getElementById("TK").setAttribute('contenteditable',true);
  
  document.getElementById("firstName").style.border = '1px solid black';
  document.getElementById("lastName").style.border = '1px solid black';
  document.getElementById("fatherName").style.border = '1px solid black';
  document.getElementById("birthDate").style.border = '1px solid black';
  document.getElementById("email").style.border = '1px solid black';
  document.getElementById("phone").style.border = '1px solid black';
  document.getElementById("mobile").style.border = '1px solid black';
  document.getElementById("city").style.border = '1px solid black';
  document.getElementById("address").style.border = '1px solid black';
  document.getElementById("TK").style.border = '1px solid black';


  document.getElementById("firstName").style.lineHeight = '20px';
  document.getElementById("lastName").style.lineHeight = '20px';
  document.getElementById("fatherName").style.lineHeight = '20px';
  document.getElementById("birthDate").style.lineHeight = '20px';
  document.getElementById("email").style.lineHeight = '20px';
  document.getElementById("phone").style.lineHeight = '20px';
  document.getElementById("mobile").style.lineHeight = '20px';
  document.getElementById("city").style.lineHeight = '20px';
  document.getElementById("address").style.lineHeight = '20px';
  document.getElementById("TK").style.lineHeight = '20px';
*/
    $( ".aded" ).replaceWith( function() {
    return "<input type=\"text\" value=\"" + $( this ).html() + "\" id=\"" + $( this ).attr('id') + "\" class=\"" + $( this ).attr('class') + "\"/>";
});

  document.getElementById("bloodType").disabled=false;
  document.getElementById("radioWoman").disabled = false;
  document.getElementById("radioMan").disabled = false;
  document.getElementById("cancelEdit").style.display = "inline";
  
  document.getElementById("editProfile").value = "Αποθήκευση";
document.getElementById("editProfile").onclick = function(){saveProfile(1);};
}
<?php } ?>

function saveProfile(type) {
	var okFlag = true;
	
	var username = document.getElementById("username").innerHTML;
	var firstName = document.getElementById("firstName").value;
	var lastName = document.getElementById("lastName").value;
	var fatherName = document.getElementById("fatherName").value;
	var birthDate = document.getElementById("birthDate").value;
	var email = document.getElementById("email").value;
	var phone = document.getElementById("phone").value;
	var mobile = document.getElementById("mobile").value;
	var city = document.getElementById("city").value;
	var address = document.getElementById("address").value;
	var TK = document.getElementById("TK").value;
	var bloodType = document.getElementById("bloodType").value;
	var gender;
	
	if (onlyStringCheck(firstName)==-1){
		okFlag = false;
		document.getElementById("firstNameLabel").style.color = 'red';
	} else { document.getElementById("firstNameLabel").style.color = 'black';
	}
	if (onlyStringCheck(lastName)==-1){
		okFlag = false;
		document.getElementById("lastNameLabel").style.color = 'red';
	} else { document.getElementById("lastNameLabel").style.color = 'black';
	}
	if (onlyStringCheck(fatherName)==-1){
		okFlag = false;
		document.getElementById("fatherNameLabel").style.color = 'red';
	} else { document.getElementById("fatherNameLabel").style.color = 'black';
	}
	if(okFlag){
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
				endEditingFields(type);
				
			}
		}
		if($('input[id=radioWoman]:checked').length >0){
			gender = document.getElementById("radioWoman").value;
		}else if($('input[id=radioMan]:checked').length >0){
			gender = document.getElementById("radioMan").value;
		}
		xmlhttp.open("POST","pages/userProfile/userProfileEdit.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("username="+username+"&firstName="+firstName+"&lastName="+lastName+"&gender="+gender+"&bloodType="+bloodType+"&fatherName="+fatherName+"&birthDate="+birthDate+"&email="+email+"&phone="+phone+"&mobile="+mobile+"&city="+city+"&address="+address+"&TK="+TK);
	}
}

function endEditingFields(type) {
/*
  document.getElementById("firstName").setAttribute('contenteditable',false);
  document.getElementById("lastName").setAttribute('contenteditable',false);
  document.getElementById("fatherName").setAttribute('contenteditable',false);
  document.getElementById("birthDate").setAttribute('contenteditable',false);
  document.getElementById("email").setAttribute('contenteditable',false);
  document.getElementById("phone").setAttribute('contenteditable',false);
  document.getElementById("mobile").setAttribute('contenteditable',false);
  document.getElementById("city").setAttribute('contenteditable',false);
  document.getElementById("address").setAttribute('contenteditable',false);
  document.getElementById("TK").setAttribute('contenteditable',false);
  
  document.getElementById("firstName").style.border = '';
  document.getElementById("lastName").style.border = '';
  document.getElementById("fatherName").style.border = '';
  document.getElementById("birthDate").style.border = '';
  document.getElementById("email").style.border = '';
  document.getElementById("phone").style.border = '';
  document.getElementById("mobile").style.border = '';
  document.getElementById("city").style.border = '';
  document.getElementById("address").style.border = '';
  document.getElementById("TK").style.border = '';
  
  document.getElementById("firstName").style.lineHeight = '28px';
  document.getElementById("lastName").style.lineHeight = '28px';
  document.getElementById("fatherName").style.lineHeight = '28px';
  document.getElementById("birthDate").style.lineHeight = '28px';
  document.getElementById("email").style.lineHeight = '28px';
  document.getElementById("phone").style.lineHeight = '28px';
  document.getElementById("mobile").style.lineHeight = '28px';
  document.getElementById("city").style.lineHeight = '28px';
  document.getElementById("address").style.lineHeight = '28px';
  document.getElementById("TK").style.lineHeight = '28px';
  */
	if(type == 1){
	  $( ".aded" ).replaceWith( function() {
			return "<label value=\"" + $( this ).html() + "\" id=\"" + $( this ).attr('id') + "\" class=\"" + $( this ).attr('class') + "\">" + $( this ).val() + "</label>";
		});
	}else if(type == 2){
		$( ".editable" ).replaceWith( function() {
			return "<label value=\"" + $( this ).html() + "\" id=\"" + $( this ).attr('id') + "\" class=\"" + $( this ).attr('class') + "\">" + $( this ).val() + "</label>";
		});
	}
	
  document.getElementById("bloodType").disabled=true;
  document.getElementById("radioWoman").disabled = true;
  document.getElementById("radioMan").disabled = true;
  
  document.getElementById("cancelEdit").style.display = "none";
  document.getElementById("editProfile").value = "Επεξεργασία";
  
   for(var i=0;i<document.getElementsByClassName("editable").length;i++){
	  
	  document.getElementsByClassName("editable")[i].style.background =  '';
  } 
  
	if(type==1){
		document.getElementById("editProfile").onclick = function(){editFieldsAdmin();};
	}else if(type==2){
		document.getElementById("editProfile").onclick = function(){editFieldsUser();};
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
