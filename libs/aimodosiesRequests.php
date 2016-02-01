<?php 
	require_once("db.php");
	$dbConnection = connectToDB();
	require_once("sql.php");
	
		if(isset($_POST['insert'])){
			$insert = $_POST['insert'];
			$result1 = mysql_query("INSERT INTO dates set date = '$insert'; ");
			fillDropDown(false,'');
		}
		if(isset($_POST['edit'])){
			$edit = $_POST['edit'];
			$date = $_POST['date'];
			$result1 = mysql_query("update dates set date = '$date' where id = $edit ;");
			fillDropDown(false,'');
		}
		if(isset($_POST['deleteId'])){
			$removeID = mysql_real_escape_string($_POST['deleteId']);
			$create = mysql_query("DELETE FROM dates ".
							  "WHERE id = '$removeID';");
							  console.log('ok');
			}
			
?>
