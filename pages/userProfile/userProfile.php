<link rel="stylesheet" type="text/css" href="pages/userProfile/userProfile.css">
		
<?php 
	session_start();
	if(isset($_SESSION['userType'])){
	
		if(isset($_POST['user'])) {
			require_once("../../libs/db.php");
			require_once("../../libs/user.php");
			$dbConnection = connectToDB();
			$adminFlag = false;
			if($_SESSION['userType']==1){
				$id = json_decode($_POST['user']);
				$_SESSION['chosenUser'] = json_decode($_POST['user']);
			}else if($_SESSION['userType']==2){
				$id = $_SESSION['userID'];
			}
			
			$result = mysql_query("select * " .
									  "from users " .
									  "where id = '$id'");

			$don=mysql_query("select firstName, lastName, date, flasks".
					"from recipient".
					"where donorID = '$id'");

			$rows = mysql_num_rows($result);
			if($rows == 1) {
			 while($row = mysql_fetch_array($result)){
			?>
			
	<div id="aimodotesList">
	<fieldset>
			<legend> Στοιχεία Αιμοδότη </legend>
			
			<form id="userProfile" action="index.php" method="post">
				<div align="left" style="margin-left:120px">
				<br>
				<label id="usernameLabel" for="username">Username:</label>
				<label id="username"><?php echo $row['username']; ?></label>
				<a href="pages/userProfile/createPdf.php" target="_blank"><input style="float:right;" class="button2" type="button" value="Δημιουργία PDF" ></a>
				<br>
				<label id = "passwordLabel" for="password">password:</label>
				<!--label id = "password"><?php echo $row['password']; ?></label-->
				<input class="button1"type="button" id="changePassButton1" onclick="changePassword()" value="Αλλαγή">
				<div id="changePass">
				<label id="" for="newPassword">Νέος κωδικός:</label>
				<input type="password" id="newPassword">
				<br>
				<label id="" for="confirmPassword">Επιβεβαίωση:</label>
				<input type="password" id="confirmPassword"><input class="button3" id="changePassButton2"  type="button" onclick="changePassword()" value="Αλλαγή">
															<input class="button2" id="changePassButton3"  type="button" onclick="changePassword(true)" value="Άκυρο">
				</div>
				<label id="changePassMSG"></label>
				<br>
				<label id="firstNameLabel" for="firstName">Όνομα:</label>
				<label class="aded" id="firstName"><?php echo $row['firstName']; ?></label>
				<br>
				<label id="lastNameLabel" for="lastName">Επώνυμο:</label>
				<label class="aded" id="lastName"><?php echo $row['lastName']; ?></label>
				<br>
				<label id="genderLabel" for="gender">Φύλο:</label>
				<input type="radio" name="gender" value="Γυναίκα" id="radioWoman" <?php if ($row['gender'] == "Γυναίκα"): echo 'checked'; endif; ?> >Γυναίκα
				<input type="radio" name="gender" value="Άνδρας" id="radioMan" <?php if ($row['gender'] == "Άνδρας"): echo 'checked'; endif; ?>>Άνδρας
				<br>
				<label id="bloodTypeLabel" for="bloodType">Τύπος Αίματος:</label>
				<select id="bloodType" name="bloodType">
				<?php
				
					$options = array("O+", "A+", "B+", "AB+", "O-", "A-", "B-", "AB-"); ?>
					<?php foreach ($options as $option): ?>
						<option value="<?php echo $option; ?>"<?php if ($row['bloodType'] == $option): ?> selected="selected"<?php endif; ?>>
						<?php echo $option; ?>
						</option>
					<?php endforeach; 
			 
					?>
				</select>
				<br><script>document.getElementById("bloodType").disabled = true;document.getElementById("radioWoman").disabled = true;document.getElementById("radioMan").disabled = true;</script>
				<label id="flasksLabel" for="flasks">Συμμετοχές(Φιάλες):</label>
				<label id="flasks"><?php echo $row['flasks']; ?></label>
				<label id="sentLabel" for="sent">Δωρεές:</label>
				<label id="sent"><?php echo $row['sent']; ?></label>
				<label id="restLabel" for="rest">Υπόλοιπο:</label>
				<label id="rest"><?php echo ($row['flasks']-$row['sent']); ?></label>
				<br>
				<label id="fatherNameLabel" for="fatherName">Όνομα Πατρός:</label>
				<label class="aded" id="fatherName"><?php echo $row['fatherName']; ?></label>
				<br>
				<label id="birthDateLabel" for="birthDate">Ημερομηνία Γέννησης:</label>
				<label class="aded" id="birthDate"><?php echo $row['birthDate']; ?></label>
				<br>
				<label id = "emailLabel" for="email">email:</label>
				<label class="editable aded" id="email"><?php echo $row['email']; ?></label>
				<br>
				<label id="phoneLabel" for="phone">Τηλέφωνο:</label>
				<label class="editable aded" id="phone"><?php echo $row['phone']; ?></label>
				<br>
				<label id="mobileLabel" for="mobile">Κινητό:</label>
				<label class="editable aded" id="mobile"><?php echo $row['mobile']; ?></label>
				<br>
				<label id="cityLabel" for="city">Πόλη:</label>
				<label class="editable aded" id="city"><?php echo $row['city']; ?></label>
				<br>
				<label id="addressLabel" for="address">Διεύθυνση:</label>
				<label class="editable aded" id="address"><?php echo $row['address']; ?></label>
				<br>
				<label id="TKLabel" for="TK">ΤΚ:</label>
				<label class="editable aded" id="TK"><?php echo $row['TK']; ?></label>
				<br>
				
				

				<?php 
				if ($_SESSION['userType']==1){?>
					<input  style="float: left; display:none;" class="button2" type="button" id="cancelEdit" value="Άκυρο" onclick="cancelEditProfile()">
					<?php if($row['id']!=$_SESSION['userID']){?>
					<input style="float: right;" class="button2" type="button" id="deleteProfile" value="Διαγραφή" onclick="removeUser(<?php echo $row['id']; ?>);">
					<?php } ?>
					<input  style="float: right;" class="button2" type="button" id="editProfile" value="Επεξεργασία" onclick="editFieldsAdmin()">
				<?php } else if($_SESSION['userType']==2){ ?>
					<input  style="float: left; display:none;" class="button2" type="button" id="cancelEdit" value="Άκυρο" onclick="cancelEditProfile()">
					<input style="float: right;" class="button2" type="button" id="editProfile" value="Επεξεργασία" onclick="editFieldsUser()">
				<?php } ?>
				</div>
			</form>
		</fieldset>
	</div>
	<?php } 
		} 
		}else {
			echo 'not found';
		}
	}else{
		echo 'Negative!';
		header( "refresh:2;index.php" );
	}
?>
