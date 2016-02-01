<?php	
	require_once("../../libs/db.php");
	require_once("../../libs/user.php");
	$dbConnection = connectToDB();
	$result = mysql_query("select * " .
								  "from users " .
								  "where username = '$username'");
	$rows = mysql_num_rows($result);
	if($rows == 1) {
		return false;
	
	}	
?>