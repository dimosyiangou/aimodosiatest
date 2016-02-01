<?php 
session_start();
if(isset($_SESSION['userType']) && $_SESSION['userType']==1){
	require_once("../../libs/db.php");
	require_once("../../libs/user.php");
	$dbConnection = connectToDB();
	if(isset($_POST['username'])) {
		$username = $_POST['username'];
		$result = mysql_query("select * " .
								  "from users " .
								  "where username = '$username'");
		$rows = mysql_num_rows($result);
		if($rows == 1) {
			return 0;
		}
	}
		?>
		<div id="createUser">
<link rel="stylesheet" type="text/css" href="pages/createUser/createUser.css">
<?php
define('ROOTPATH', dirname(__FILE__));
	
	
	if(isset($_POST['username'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$gender = $_POST['gender'];
		$bloodType = $_POST['bloodType'];
		$fatherName = $_POST['fatherName'];
		$birthDate = $_POST['birthDate'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$mobile = $_POST['mobile'];
		$city = $_POST['city'];
		$address = $_POST['address'];
		$TK = $_POST['TK'];
		
		$password = md5($username.$password);
			$create = mysql_query("INSERT INTO users ".
							  "set username = '$username', " .
								  "password = '$password', " .
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
								  "TK = '$TK', " .
								  "usertype = '2';");
			
			if($create){
				echo '<h3>Ο χρήστης με username '.$username.' δημιουργήθηκε με επιτυχία!</h3>';
			}else {
				echo "na";
				  //echo "<button onclick=\"window.location='index.php?p=createUser'\">Προσπαθήστε ξανά</button>";
			}	
		}else{
		
?>

<fieldset>
		<legend> Δημιουργία Αιμοδότη </legend>
		<form id="createUser" action="index.php?p=createUser/createUser" method="post">
			<div align="left" style="margin-left:120px">
			<span class="error">* Απαιτούμενα πεδία</span>
			<br>
			<label id = "usernameLabel" for="username">Username:</label>
			<input class="textBox" type="text" name="username" id="username" placeholder="username"><span id="usernameMSG">*</span>
			<br>
			<label id = "passwordLabel" for="password">password:</label>
			<input class="textBox" type="password" name="password" id="password" placeholder="password"><span id="passwordMSG">*</span>
			<br>
			<label id="firstNameLabel" for="firstName">Όνομα:</label>
			<input class="textBox" type="text" name="firstName" id="firstName"><span id="firstNameMSG">*</span>
			<br>
			<label id="lastNameLabel" for="lastName">Επώνυμο:</label>
			<input class="textBox" type="text" name="lastName" id="lastName"><span id="lastNameMSG">*</span>
			<br>
			<label id="genderLabel" for="gender">Φύλο:</label>
			<input type="radio" name="gender" value="Γυναίκα">Γυναίκα
			<input type="radio" name="gender" value="Άνδρας">Άνδρας<span id="genderMSG">  *</span>
			<br>
			<label id="bloodTypeLabel" for="bloodType">Τύπος Αίματος:</label>
			<select class="textBox" id="bloodType" name="bloodType">
				<option value="O+">Ο+</option>
				<option value="A+">Α+</option>
				<option value="B+">Β+</option>
				<option value="AB+">ΑΒ+</option>
				<option value="O-">Ο-</option>
				<option value="A-">Α-</option>
				<option value="B-">Β-</option>
				<option value="AB-">ΑΒ-</option>
			</select><span id="bloodTypeMSG"> *</span>
			<br>
			<label id="fatherNameLabel" for="fatherName">Όνομα Πατρός:</label>
			<input class="textBox" type="text" name="fatherName" id="fatherName">
			<br>
			<label id="birthDateLabel" for="birthDate">Ημερομηνία Γέννησης</label>
			<input class="textBox" Style="width:20px;" type="text" name="day" id="day" maxlength="2" onkeypress="return onpressNumCheckZeroIn(event)">
			<label Style="width:50px;" id="dayLabel" for="day">Μέρα</label>
			<input class="textBox" Style="width:20px;" type="text" name="month" id="month" maxlength="2" onkeypress="return onpressNumCheckZeroIn(event)">
			<label Style="width:50px;" id="monthLabel" for="month">Μήνας</label>
			<input class="textBox" Style="width:35px;" type="text" name="year" id="year" maxlength="4" onkeypress="return onpressNumCheckZeroIn(event)">
			<label Style="width:50px;" id="yearLabel" for="year">Χρονιά</label>
			<br>
			<label id = "emailLabel" for="email">email:</label>
			<input class="textBox" type="text" name="email" id="email">
			<br>
			<label id="phoneLabel" for="phone">Τηλέφωνο:</label>
			<input class="textBox" type="text" name="phone" id="phone">
			<br>
			<label id="mobileLabel" for="mobile">Κινητό:</label>
			<input class="textBox" type="text" name="mobile" id="mobile">
			<br>
			<label id="cityLabel" for="city">Πόλη:</label>
			<input class="textBox" type="text" name="city" id="city">
			<br>
			<label id="addressLabel" for="address">Διεύθυνση:</label>
			<input class="textBox" type="text" name="address" id="address">
			<br>
			<label id="TKLabel" for="TK">ΤΚ:</label>
			<input class="textBox" type="text" name="TK" id="TK">
			<br>
			<input style="margin-left:400px" class="button2" type="button" name="submitCreateUser" id="submitCreateUser" value="Δημιουργία" onclick="createUser()">
			</div>
		</form>
	</fieldset>

<?php } ?>

			</div>
			
			<?php } ?>
			
