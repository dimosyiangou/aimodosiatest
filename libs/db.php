<?php
	function connectToDBb() {
	
		$data_source='myVir';
		$user='';
		$password='';

		// Connect to the data source and get a handle for that connection.
		$conn=odbc_connect($data_source,$user,$password);
		if (!$conn){
			if (phpversion() < '4.0'){
				exit("Connection Failed: . $php_errormsg" );
			}
			else{
				exit("Connection Failed:" . odbc_errormsg() );
			}
		}else{
			return $conn;
		}
	
	}
	
	
	function connectToDB() {
		$server	  = "localhost";
		$username = "root";
		$password = "1234";
		$dbName   = "mydb"; 
		$dbConnection = mysql_connect("$server", "$username", "$password");
		if(!$dbConnection) {
			die("<p>Could not connect to server: "  . mysql_error() . "</p>");
		}
			mysql_query('SET character_set_results=utf8');
			mysql_query('SET names=utf8');
			mysql_query('SET character_set_client=utf8');
			mysql_query('SET character_set_connection=utf8');
			mysql_query('SET character_set_results=utf8');
			mysql_query('SET collation_connection=utf8_unicode_ci');
	
		$dbSelection = mysql_select_db("$dbName", $dbConnection);
		if(!$dbSelection) {
			die("<p>Could not select database: " . mysql_error() . "</p>");
		}
		
		return $dbConnection;
	}
	include_once('library/HTMLPurifier.auto.php');
	function htmlencode($str) {
		$str = HTMLPurifier_Encoder::cleanUTF8($str);
		$str = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
		return $str;
}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlentities($data);
   return $data;
}

?>
