<?php 
session_start(); 
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
  //Request identified as ajax request


    if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1 ){

?>
<script>

function createUser() {
	
	
	var emptyFlag = false;
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	var firstName = document.getElementById("firstName").value;
	var lastName = document.getElementById("lastName").value;
	var gender = document.getElementsByName("gender");
	var i = 0;
	while(i<gender.length){
		if (gender[i].checked) {
			gender = gender[i].value;
			break;
		}i++;
		if(i == gender.length){
			gender = "";
		}
	}
	var bloodType = document.getElementById("bloodType").value;
	var fatherName = document.getElementById("fatherName").value;
	var day = document.getElementById("day").value;
	var month = document.getElementById("month").value;
	var year = document.getElementById("year").value;
	if(day.length==1){
		day = "0" + day;
	}
	if(month.length==1){
		month = "0" + month;
	}
	if(month > 12 || day > 31 || (day.length !=0 && year < 1920) || (day.length != 0 && month.length == 0) || (day.length == 0 && month.length != 0)){
		emptyFlag = true;
		document.getElementById("birthDateLabel").style.color='red';
	}else{
		document.getElementById("birthDateLabel").style.color='black';
	}
	
	var birthDate = day + "/" + month + "/" + year;
	var email = document.getElementById("email").value;
	var phone = document.getElementById("phone").value;
	var mobile = document.getElementById("mobile").value;
	var city = document.getElementById("city").value;
	var address = document.getElementById("address").value;
	var TK = document.getElementById("TK").value;
	if(usernameCheck(username)!=1){
		document.getElementById("usernameLabel").style.color='red';
		document.getElementById("usernameMSG").innerHTML = "* πεδίο υποχρεωτικό";
		emptyFlag = true;
	}
	if(passwordCheck(password)!=1){
		document.getElementById("passwordLabel").style.color='red';
		document.getElementById("passwordMSG").innerHTML = "* πεδίο υποχρεωτικό";
		emptyFlag = true;
	}
	if(onlyStringCheck(firstName)!=1){
		document.getElementById("firstNameLabel").style.color='red';
		emptyFlag = true;
	}
	if(onlyStringCheck(lastName)!=1){
		document.getElementById("lastNameLabel").style.color='red';
		emptyFlag = true;
	}
	if(onlyStringCheck(gender)!=1){
		document.getElementById("genderLabel").style.color='red';
		emptyFlag = true;
	}
	
	if(usernameCheck(username)==-1){
		document.getElementById("usernameMSG").innerHTML = "* Λάθος τιμή";
		emptyFlag = true;
	}else if(usernameCheck(username)==1){
		document.getElementById("usernameMSG").innerHTML = "*";
		document.getElementById("usernameLabel").style.color='black';
	}
	if(passwordCheck(password)==-1){
		document.getElementById("passwordMSG").innerHTML = "* Λάθος τιμή";
		emptyFlag = true;
	}else if(passwordCheck(password)==1){
		document.getElementById("passwordMSG").innerHTML = "*";
		document.getElementById("passwordLabel").style.color='black';
	}
	if(onlyStringCheck(firstName)==0){
		document.getElementById("firstNameMSG").innerHTML = "* πεδίο υποχρεωτικό";
		emptyFlag = true;
	}else if(onlyStringCheck(firstName)==-1){
		document.getElementById("firstNameMSG").innerHTML = "* A-Z -- Α-Ω";
		emptyFlag = true;
	}else{
		document.getElementById("firstNameMSG").innerHTML = "* ";
		document.getElementById("firstNameLabel").style.color='black';
	}
	if(onlyStringCheck(lastName)==0){
		document.getElementById("lastNameMSG").innerHTML = "* πεδίο υποχρεωτικό";
		emptyFlag = true;
	}else if(onlyStringCheck(lastName)==-1){
		document.getElementById("lastNameMSG").innerHTML = "* A-Z -- Α-Ω";
		emptyFlag = true;
	}else{
		document.getElementById("lastNameMSG").innerHTML = "* ";
		document.getElementById("lastNameLabel").style.color='black';
	}
	if(onlyStringCheck(gender)==0){
		document.getElementById("genderMSG").innerHTML = "  * πεδίο υποχρεωτικό";
		emptyFlag = true;
	}else{
		document.getElementById("genderMSG").innerHTML = "  * ";
		document.getElementById("genderLabel").style.color='black';
	}
	/*if(password && password.length<4){
		document.getElementById("passwordMSG").innerHTML = "* >4 Χαρακτήρες";
		emptyFlag = true;
	}else if(password && password.length>=4){
		document.getElementById("passwordMSG").innerHTML = "*";
		document.getElementById("passwordLabel").style.color='black';
	}*/
	
	if(!emptyFlag){
		if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else { // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		var a = 1;
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				if(xmlhttp.responseText==0){
					document.getElementById("usernameLabel").style.color='red';
					document.getElementById("usernameMSG").innerHTML = "* Το username υπάρχει";
				}else{
					document.getElementById("createUser").innerHTML = xmlhttp.responseText;
				}
				//document.getElementById("createUser").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("POST","pages/createUser/createUser.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("username="+username+"&password="+password+"&firstName="+firstName+"&lastName="+lastName+"&gender="+gender+"&bloodType="+bloodType+"&fatherName="+fatherName+"&birthDate="+birthDate+"&email="+email+"&phone="+phone+"&mobile="+mobile+"&city="+city+"&address="+address+"&TK="+TK);
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