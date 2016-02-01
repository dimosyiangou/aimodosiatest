<?php 
session_start(); 
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
  //Request identified as ajax request

  
    

?>

<script>
/*
[].forEach.call(document.querySelectorAll("a"),function(e) {
    e.addEventListener("click", function(evt) {
      var title = this.textContent;
      var url = this.href;
 
      //Change the URL
      history.pushState(null, title, url.split(".php")[0]);
		alert(url);
		//function loadContent(url) {
    //$('div.mainColumnField').load(url);
    //}
      //Do some ajax stuff
 $.ajax({
         type:"POST",
         url:url,
         success: function (html) {
            $('div.mainColumnField').html(html);
			alert(html);
         }
      });
      //Prevent the browsers default behaviour of navigating to the hyperlink
      evt.preventDefault();
    })
});

$(window).bind("popstate", function() {
    alert(window.location);
});
*/

var firstTime = true;
$(window).on('hashchange', function (e) {
    //alert(location.hash);
	/*
	if (location.hash === "#paes/news") 
    {
        phpLoadClass('mainColumnField','pages/news.php',3,0,0);
    }
	if (location.hash === "#recipients") 
    {
        phpLoadClass('mainColumnField','pages/recipientsPanel/recipients.php',3,0,'Δωρεές/Πίνακας Δωρεών');
    }
	
	
 */
	var hash = window.location.hash;
	if(hash){
		if(firstTime || hash.indexOf('search') == -1){
			hashUrl = hash.split("#!")[1];
			
			var param=0;
			var formData = $(this).serializeArray();
			/*
			var hashUrlSecond = 0;
			var paramSecond=0;
			var formDataSecond = $(this).serializeArray();
			if(hash.split("#!")[2]){
				//alert("defined: "+hash.split("#!")[2]);
				hashUrlSecond = hash.split("#!")[2];
				for(var i = 1;i<hashUrlSecond.split("&").length;i++){
				
					var temp = hashUrlSecond.split("&")[i];
					temp = temp.split("=")[1];
					//param = JSON.stringify(hashUrl.split("#")[i]);
					paramSecond = JSON.stringify(temp);
					formDataSecond.push({name: 'param'+i, value: param});
				}
				hashUrlSecond = hashUrlSecond.split("&")[0]+".php";
			}else alert("not defined");
			//alert(hashUrlSecond);
			*/
			//alert(hashUrl.split("#").length);
			for(var i = 1;i<hashUrl.split("&").length;i++){
			
				var temp = hashUrl.split("&")[i];
				tempParam = temp.split("=")[0];
				temp = temp.split("=")[1];
				//param = JSON.stringify(hashUrl.split("#")[i]);
				param = JSON.stringify(temp);
				//if(!hash.indexOf('search')){
					//formData.push({name: 'param'+i, value: param});
				//}else{
					formData.push({name: tempParam, value: param});
				//}
			}
			
			hashUrl = hashUrl.split("&")[0]+".php";
			//alert(hashUrl);
			$.ajax({
				 type:"POST",
				 url:hashUrl,
				 //data: {page:param},
				 data: formData,
				 success: function (html) {
					//document.getElementsByClassName('mainColumnField')[0].innerHTML = html;
					html=html;
					//alert(html);
					$('div.mainColumnField').html(html);
					fixFooter();
				 }
			  });/*
			  if(hashUrlSecond!=0){
				$.ajax({
				 type:"POST",
				 url:hashUrlSecond,
				 //data: {page:param},
				 data: formDataSecond,
				 success: function (html) {
					//document.getElementsByClassName('mainColumnField')[1].innerHTML = html;
					$('div#mainColumnHeader').html(html);
					fixFooter();
				 }
			  });
			  }*/
		}
	}else{
		fixFooter();
	}
	      
   
}).trigger('hashchange');
  
  

 //////////////////////////////////////////////////////////////
 function fixFooter(){
			var winHeight = $(window).height();
		   var bufferPos = $('#buffer').position().top;
   if (bufferPos < winHeight-100) {
    $('#footer').css('top',(winHeight - 40)+'px');
   }else{
   
	$('#footer').css('top',(bufferPos+40)+'px');
   }
 
 }
////////////~~~~~~~~~~~~~~~~~~~~~ Push State ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
 /*
$(function() {
    $('a').on('click', function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        loadContent(href);
        history.pushState({}, '', href);
    });
    $(window).on('popstate', function() {
        loadContent(location.pathname);
    });
	
});

function loadContent(url) {
    $('div.mainColumnField').load(url);
}
 
 */
 
 
 function myError(msg){
	alert(msg);
}
 function checkWidth(){
	alert(document.getElementById("container").offsetWidth);
 }
function myLogOut(){
if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("topBar").innerHTML=xmlhttp.responseText;
			window.location = 'index.php';
		}
	}
	xmlhttp.open("POST","gadgets/topSingin.php",false);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("logoutMy="+"a");
}


function clearContent(idEl){
	var elem = document.getElementById(idEl);
	elem.parentNode.removeChild(elem);
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


function importDB(file){
if (confirm('Είστε σίγουροι ότι θέλετε να γίνει επαναφορά τις βάσεις στην κατάσταση: '+file)) {
    if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			alert('Επιτυχής Επαναφορά');
		}
	}
	xmlhttp.open("POST","pages/adminPanel/import.php",false);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("file="+file);
	return xmlhttp.responseText;
} else {
}
}


function downloadDB(file){
	file = file.split("dl")[1];
	alert(file);
    if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			//alert(xmlhttp.responseText);
		}
	}
	xmlhttp.open("POST","pages/adminPanel/download.php",false);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("file="+file);
	return xmlhttp.responseText;

}
function defineUserID(){
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
	xmlhttp.open("POST","libs/uID.php",false);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	return xmlhttp.responseText;
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
			window.location.hash = page.substr(0, page.indexOf('.php')); 
			alert('js');
			//history.pushState({}, document.title, '?x=' + page);
			
		}
	}
	xmlhttp.open("POST",page,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("page="+variable);
  
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



<?php 
	if(isset($_SESSION['userType'])){	?>
var flag = false ;
function openpopup(elem){
	if(!flag){
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
			//alert(xmlhttp.responseText);
				document.getElementById("accountPopup").innerHTML = xmlhttp.responseText;
			document.getElementById("accountPopup").style.display = 'block';
			}
		}
		xmlhttp.open("POST","menus/topPopup.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send();
	}
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
	flag = false;
  });
  $('#account').click(function(event){
	if(flag){
		$('#accountPopup').css('display','none');
		flag = false;
	}
    //$('#accountPopup').toggle();
    //event.stopPropagation();
  });


});

<?php  }   ?>


// ~~~~~~~~~~~~~~~~~~~~~~~~~~footer stays down ~~~~~~~~~~~~~~~~~~~~~~~
/*
$(document).ready(function(){
     var docHeight = $(window).height();
   var footerHeight = $('#footer').height();
   var footerTop = $('#footer').position().top + footerHeight;
   
   if (footerTop < docHeight) {
    $('#footer').css('margin-top',(docHeight - footerTop-100)+'px');
   }
   
  });
  */

	</script>
	<?php
	 
  
}
else {
  echo 'request';
}
?>
