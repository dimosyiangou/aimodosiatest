<!doctype html>



<?php
	session_start();
	require_once("libs/sql.php");
	require_once("libs/user.php");
	require_once("libs/db.php");
	require_once("gadgets/captcha.php");
	//require_once("pages/test/server/server.php");
	$dbConnection = connectToDB();
		$resu=mysql_query("select count(*) as maxus from users where userType=2");
		$maxusers=mysql_fetch_assoc($resu);	
	if(isset($_SESSION['views']))
	$_SESSION['views']=$_SESSION['views']+1;
	else
	$_SESSION['views']=1;
	//echo "Views=". $_SESSION['views'];
?>
<html>

	<head>
	<meta name="fragment" content="!">
	
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" >
		<meta content='width=device-width' name='viewport'>
		<!--meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' /-->
		<script src="./js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
  $.ajax({
    url: './js/createUser.php',
    type:'POST',
    cache: false,
    success: function(data){
      if(data){
        $('body').append(data);
      }
    }
  }); 
  $.ajax({
    url: './js/recipients.php',
    type:'POST',
    cache: false,
    success: function(data){
      if(data){
        $('body').append(data);
      }
    }
  }); 
  $.ajax({
    url: './js/userProfile.php',
    type:'POST',
    cache: false,
    success: function(data){
      if(data){
        $('body').append(data);
      }
    }
  }); 
    $.ajax({
    url: './js/news.php',
    type:'POST',
    cache: false,
    success: function(data){
      if(data){
        $('body').append(data);
      }
    }
  }); 
      $.ajax({
    url: './js/jsMy.php',
    type:'POST',
    cache: false,
    success: function(data){
      if(data){
        $('body').append(data);
      }
    }
  }); 
        $.ajax({
    url: './js/donations.php',
    type:'POST',
    cache: false,
    success: function(data){
      if(data){
        $('body').append(data);
      }
    }
  }); 
          $.ajax({
    url: './js/donors.php',
    type:'POST',
    cache: false,
    success: function(data){
      if(data){
        $('body').append(data);
      }
    }
  }); 
           $.ajax({
    url: './js/tickets.php',
    type:'POST',
    cache: false,
    success: function(data){
      if(data){
        $('body').append(data);
      }
    }
  }); 
  
})

</script>

		<!--script type="text/javascript" src="./js/jsMy.js"></script-->
		<script type="text/javascript" src="./js/menuPanel.js"></script>
		<!--script type="text/javascript" src="./js/news.js"></script-->
		<!--script type="text/javascript" src="./js/recipients.js"></script-->
		<!--script type="text/javascript" src="./js/userProfile.js"></script-->
		<script type="text/javascript" src="./js/inputChecks.js"></script>
		<!--script type="text/javascript" src="./js/createUser.js"></script-->
		
		<link rel="stylesheet" media="screen and (max-device-width : 480px)" href="/css/small.css" />

		<link rel="stylesheet" media="screen and (min-device-width: 480px)" type="text/css" href="/css/styles.css">
		<link rel="stylesheet" type="text/css" href="/css/items.css">
		<noscript>For full functionality of this page it is necessary to enable JavaScript. Here are the <a href="http://www.enable-javascript.com" target="_blank"> instructions how to enable JavaScript in your web browser</a></noscript>
		
		<title> Εθελοντική Αιμοδοσία ΑΤΕΙΘ </title>
		<script>
	
	  
</script>
	</head>
	
	<body>
	
	<div id="accountPopup">
	</div>
	<div id="topBackGround">
	</div>
		<div id="container">
			<div id="topBar">
				<?php require('./gadgets/topSingin.php'); ?>
			</div>
			<div id="header">
				
				<span id="firstSpan"><h3>Γίνε Εθελοντής Αιμοδότης</h3></span>
				<label id="maximUsers" >Εγγεγραμμένοι Αιμοδότες: </label>
				<label class="aded" id="maximUsers"><?php echo $maxusers['maxus']; ?></label>
				<span id="thirdSpan"><p><h3>ΙΑΤΡΕΙΟ ΑΤΕΙΘ <br>Τηλέφωνο Επικοινωνίας: 2310-013 122 </h3></p></span>
				<span id="fourthSpan"><img src="assets/teithe.png" alt="teithe" height="80" width="80"></span>
			</div>
			<div id="menuBar">
				<?php require('./menus/topMenu.php'); ?>
			</div>
			<div id="mainColumn">
				<div id="mainColumnHeader"></div>
				<div class="mainColumnField">
				<?php 
				   //if (isset($_GET['p'])){
					  //include('pages/'.$_GET['p'].'.php');
				   //}
				   //else 
					  include('pages/home.php'); 
						
				 ?>
				</div>
			</div>
			
			<div id="rightBar">
				<div  style="border:0px;margin:25px 0px;">
					<?php require('./menus/menuPanel.php'); ?>
				</div>
				<div class="rightBarField">
				<?php require('./gadgets/teitheMap/teitheMap.php'); ?>
				</div>
				
				<div class="rightBarField">
				<?php require('./gadgets/facts/didYouKnow.php'); ?>
				</div>
		
				
			</div>
			<div id="buffer">
			</div>
		</div>
		<div id="footer">
		<div id="footerContainer">
		<span style="float:right;"> Πτυχιακή Εργασία Πετράκη Πυρετζίδη Στέφανου </span><br><span style="float:right;">Τμήμα Μηχανικών Υπολογιστών ΑΤΕΙΘ</span>
			</div>
			</div>
	
	
	</body>

</html>
