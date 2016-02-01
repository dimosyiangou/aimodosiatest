<?php 

session_start();
if(isset($_SESSION['userType']) && $_SESSION['userType']==1){
require_once("../../libs/sql.php");
require_once("../../libs/db.php");
$dbConnection = connectToDB();


	
	
		if(isset($_POST['donorID'])){
	
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$hospital = $_POST['hospital'];
		$hospitalCity = $_POST['hospitalCity'];
		$date = $_POST['date'];
		$flasks = $_POST['flasks'];
		$donorID = $_POST['donorID'];
		$check = mysql_query("select flasks from users where id=$donorID;");
		while($row = mysql_fetch_array($check)){
			if(intval($row['flasks'])-intval($flasks)>=0){
	
			$create = mysql_query("INSERT INTO recipient ".
							  "set firstName = '$firstName', " .
								  "lastName = '$lastName', " .
								  "hospital = '$hospital', " .
								  "hospitalCity = '$hospitalCity', " .
								  "date = '$date', " .
								  "flasks = '$flasks', " .
								  "donorID = '$donorID' ;");
			
				if($create){
				$result1 = mysql_query("UPDATE users set flasks = flasks - '$flasks' where id = '$donorID' ;");
					return 1;
				}else {
					return 0;
					  //echo "<button onclick=\"window.location='index.php?p=createUser'\">Προσπαθήστε ξανά</button>";
				}
			}else{
				return 0;
				
				}
			}
			
		}
	
}

		?>