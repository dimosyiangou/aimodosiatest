
<script>
<?php 
session_start();
if(isset($_SESSION['userType'])){
	if(isset($_SESSION['userType']) && $_SESSION['userType']==1){ ?>
		function ticketFormPanelAdmin(name,postID){
			try{
				postID = postID.split('tickets')[0];
				window.location.hash = "#!/pages/contact/adminForm&op="+name+"&ticket="+postID;
			}catch(e){
				window.location.hash = "#!/pages/contact/adminForm&op="+name;
			}
		}

	function postCancelAdmin(){
	window.location.hash = "#!/pages/contact/adminForm";
	}

	function postMessageAdmin(postID){
		if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else { // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				alert(xmlhttp.responseText);
				window.location.hash = "#!/pages/contact/adminForm";
			}
		}
		message = document.getElementById('message').value;
		
		xmlhttp.open("POST","libs/tickets.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("postID="+postID+"&message="+message);

	}
	function closeTicketCheck(postID){
		postID = postID.split('close')[1];
		if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else { // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				alert("Η συζήτηση αυτή έχει κλείσει και βρίσκετε πλέον στα παλαιότερα μηνύματα.");
				window.location.hash = "#!/pages/contact/adminForm";
			}
		}
		message = document.getElementById('message').value;
		
		xmlhttp.open("POST","libs/tickets.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("closedID="+postID);
	
	}

	<?php } ?>


	function ticketFormPanel(name,postID){
		try{
		postID = postID.split('tickets')[0];
		window.location.hash = "#!/pages/contact/contactForm&op="+name+"&ticket="+postID;
		}catch(e){
		window.location.hash = "#!/pages/contact/contactForm&op="+name;
		}
		
	}



	function postCancel(){
	window.location.hash = "#!/pages/contact/contactForm";
	}
	function postMessage(){
		if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else { // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				alert(xmlhttp.responseText);
				window.location.hash = "#!/pages/contact/contactForm";
			}
		}
		title = document.getElementById('title').value;
		message = document.getElementById('message').value;
		
		xmlhttp.open("POST","libs/tickets.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("title="+title+"&message="+message);

	}
	function createAnswer(){
		if(document.getElementById("answerCreation").style.display == 'none'){
			document.getElementById("answerPanel").style.display = 'none';
			document.getElementById("answerCreation").style.display = 'block';
		}else{
			document.getElementById("answerPanel").style.display = 'block';
			document.getElementById("answerCreation").style.display = 'none';
		}
	}
	function postAnswer(postID){
		if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else { // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				alert(xmlhttp.responseText);
				window.location.hash = "#!/pages/contact/contactForm&v=answered";
			}
		}
		message = document.getElementById('repostMessage').value;
		xmlhttp.open("POST","libs/tickets.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("answer="+message+"&message="+message+"&postID="+postID);

	}
	<?php } 
	?>
	  function mailContact(){
		if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else { // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				//alert(xmlhttp.responseText);
				//window.location.hash = "#!/pages/contact/contact";
				document.getElementsByClassName('mainColumnField')[0].innerHTML = xmlhttp.responseText;
				if (!subject) {
					document.getElementById('subject').style.border = "1px solid red";
				}if (!message) {
					document.getElementById('message').style.border = "1px solid red";
				}
				if (!from) {
					document.getElementById('from').style.border = "1px solid red";
				}
				if (!captcha) {
					document.getElementById('captcha').style.border = "1px solid red";
				}
			}
		}
		var from = document.getElementById('from').value;
		var subject = document.getElementById('subject').value;
		var message = document.getElementById('message').value;
		var captcha = document.getElementById('captcha').value;
		//alert( from +" "+  subject  +" "+   message  +" "+   captcha);
		xmlhttp.open("POST","pages/contact/contact.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("from="+from+"&subject="+subject+"&message="+message+"&captcha="+captcha);

	}
		
</script>