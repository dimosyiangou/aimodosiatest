<?php 
	require_once("../../libs/db.php");
	require_once("../../libs/user.php");
	$dbConnection = connectToDB();
	session_start();
	if(isset($_SESSION['userType'])){
		if($_SESSION['userType']==1){
			if(isset($_POST['firstName'])) {
				$username = mysql_real_escape_string($_POST['username']);
				$password = mysql_real_escape_string($_POST['password']);
				$firstName = mysql_real_escape_string($_POST['firstName']);
				$lastName = mysql_real_escape_string($_POST['lastName']);
				$bloodType = mysql_real_escape_string($_POST['bloodType']);
				$fatherName = mysql_real_escape_string($_POST['fatherName']);
				$birthDate = mysql_real_escape_string($_POST['birthDate']);
				$email = mysql_real_escape_string($_POST['email']);
				$phone = mysql_real_escape_string($_POST['phone']);
				$mobile = mysql_real_escape_string($_POST['mobile']);
				$city = mysql_real_escape_string($_POST['city']);
				$address = mysql_real_escape_string($_POST['address']);
				$TK = mysql_real_escape_string($_POST['TK']);
				$gender = mysql_real_escape_string($_POST['gender']);
		
	
			$create = mysql_query("update users ".
							  "set password = '$password', " .
								  "firstName = '$firstName', " .
								  "lastName = '$lastName', " .
								  "gender = '$gender', " .
								  "bloodType = REPLACE('$bloodType', ' ', '+'), " .
								  "fatherName = '$fatherName', " .
								  "birthDate = '$birthDate', " .
								  "email = '$email', " .
								  "phone = '$phone', " .
								  "mobile = '$mobile', " .
								  "city = '$city', " .
								  "address = '$address', " .
								  "TK = '$TK' " .
								  "where username = '$username';");
								  
			}else if(isset($_POST['password'])) {
				$username = mysql_real_escape_string($_POST['username']);
				$password = mysql_real_escape_string($_POST['password']);
				$password = md5($username.$password);
				$create = mysql_query("update users ".
							  "set password = '$password' " .
							  "where username = '$username';");
							  echo 'ok '.$password.' '.$username;
			}else if(isset($_POST['removeID'])) {
				$removeID = mysql_real_escape_string($_POST['removeID']);
				$check = mysql_query("SELECT * FROM donationDonor WHERE donorID = '$removeID';");
				if(mysql_num_rows($check)>=1){
					echo 'fail remove';
				}else{
				$create = mysql_query("DELETE FROM users ".
							  "WHERE id = '$removeID';");
							  echo 'ok '.$password.' '.$username;
				}
			}
		}else if($_SESSION['userType']==2){
			$id = mysql_real_escape_string($_SESSION['userID']);
			
				if(isset($_POST['bloodType'])) {
					$username = mysql_real_escape_string($_POST['username']);
					$firstName = mysql_real_escape_string($_POST['firstName']);
					$lastName = mysql_real_escape_string($_POST['lastName']);
					$bloodType = mysql_real_escape_string($_POST['bloodType']);
					$fatherName = mysql_real_escape_string($_POST['fatherName']);
					$birthDate = mysql_real_escape_string($_POST['birthDate']);
					$email = test_input($_POST['email']);
					$phone = htmlentities(mysql_real_escape_string($_POST['phone']));
					$mobile = htmlentities(mysql_real_escape_string($_POST['mobile']));
					$city = htmlentities(mysql_real_escape_string($_POST['city']));
					$address = htmlentities(mysql_real_escape_string($_POST['address']));
					$TK = htmlentities(mysql_real_escape_string($_POST['TK']));
					
					$check = mysql_query("select * from users where id = '$id';");
					if(mysql_num_rows($check)==1){
						while($row = mysql_fetch_array($check)){
							$create = mysql_query("update users ".
								  "set email = '$email', " .
									  "phone = '$phone', " .
									  "mobile = '$mobile', " .
									  "city = '$city', " .
									  "address = '$address', " .
									  "TK = '$TK' " .
									  "where id = '$id';");
						}
				
					}
				}else if(isset($_POST['password'])) {
					$username = mysql_real_escape_string($_POST['username']);
					$password = mysql_real_escape_string($_POST['password']);
					$password = md5($username.$password);
					$create = mysql_query("update users ".
								  "set password = '$password' " .
								  "where id = '$id';");
				}
		}
		if($create){
				echo '1';
			}else {
				echo "0";
				  //echo "<button onclick=\"window.location='index.php?p=createUser'\">Προσπαθήστε ξανά</button>";
			}	
								  }
								  ?>