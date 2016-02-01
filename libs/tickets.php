<?php
	session_start();
	if (isset($_SESSION['userType']) && $_SESSION['userType'] == 2){
		require_once("db.php");
		$dbConnection = connectToDB();
		
		if(isset($_POST['title'])){
			$title = mysql_real_escape_string($_POST['title']);
			$message = mysql_real_escape_string($_POST['message']);
			$date = date('d/m/Y H:i');
			$userID = mysql_real_escape_string($_SESSION['userID']);
			$create = mysql_query("insert into tickets set title='$title', readMSG=1, root=1, message='$message', date='$date', userID='$userID';");
			if($create){
				echo 'success';
			}else
				echo 'fail';
		}
		if(isset($_POST['answer'])){
			$message = mysql_real_escape_string($_POST['message']);
			$date = date('d/m/Y H:i');
			$userID = mysql_real_escape_string($_SESSION['userID']);
			$postID = mysql_real_escape_string($_POST['postID']);
			$check = mysql_query("select * from tickets where id='$postID' and userID = '$userID' ;");
			if(mysql_num_rows($check)==1){
				$create = mysql_query("insert into tickets set answered=1, root=0, message='$message', date='$date', userID='$userID', forID='$postID', forUser='$userID';");
				if($create){
					$updateInfo=mysql_query("update tickets set answered = 0 where id = '$postID';");
					if($updateInfo){
						echo 'success';
					}
				}else
					echo 'fail';
			}
		}
	}else if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1){
		require_once("db.php");
		$dbConnection = connectToDB();
		
		if(isset($_POST['message'])){
			$postID = $_POST['postID'];
			$message = $_POST['message'];
			$date = date('d/m/Y H:i');
			$adminID = $_SESSION['userID'];
			$userID = 0;
			$getInfo = mysql_query("select userID from tickets where id = '$postID';");
			if(mysql_num_rows($getInfo)==1){
				while($row = mysql_fetch_array($getInfo)){
					$userID = $row['userID'];
				}
			}
			if($getInfo){
				$create = mysql_query("insert into tickets set message='$message', answered = 1, userID='$adminID', date='$date', forUser='$userID', forID='$postID';");
				if($create){
					$updateTicket = mysql_query("update tickets set readMSG = 0, answered = 1 where id = '$postID';");
					echo 'success';
				}else
					echo 'fail';
			
			}else echo 'info fail';
			
		}if(isset($_POST['closedID'])){
			$postID = $_POST['closedID'];
			$updateTicket = mysql_query("update tickets set readMSG = 1, answered = 1 where id = '$postID';");
		}
	}
?>