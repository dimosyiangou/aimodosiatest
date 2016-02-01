<?php
	function loginUser($username, $password) {
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
			$password = md5($username.$password);
		
		$result = mysql_query("select * " .
							  "from users " .
							  "where username = '$username' and ".
							  "password = '$password';");
		$rows = mysql_num_rows($result);
		if($rows = 1) {
			$row = mysql_fetch_array($result);
			$_SESSION['userID'] = $row['id'];
			$_SESSION['userType'] = $row['usertype'];
			$_SESSION['username'] = $row['username'];
			return true;
		} else {
			return false;
		}
	}
	function logoutUser() {
		unset($_SESSION['userID']);
		unset($_SESSION['userType']);
		unset($_SESSION['username']);
	}
	function userExist($username){
		$result = mysql_query("select * " .
								  "from users " .
								  "where username = '$username'");
		$rows = mysql_num_rows($result);
		if($rows == 1) {
			return true;
		}else return false;
	}
	function createUser($username, $password, $email){
		$result = mysql_query("select * " .
								  "from users " .
								  "where username = '$username'");
		$rows = mysql_num_rows($result);
		if($rows == 1) {
			return false;
		}else{
			$result1 = mysql_query("INSERT INTO users ".
							  "set username = '$username', " .
								  "password = '$password', " .
								  "email = '$email', " .
								  "usertype = '2';");
			if (!$result1) {
				echo(mysql_error());
				exit();
			}	
			return $result1;	
		}
	}
?>







