<link rel="stylesheet" type="text/css" href="pages/donationsPanel/donationsPanel.css">
<?php 
session_start();
if(isset($_SESSION['userType'])){
	if($_SESSION['userType']==1){
		if(!isset($_POST['list'])){
				?>

		<?php }
			require_once("../../libs/sql.php");
			require_once("../../libs/db.php");
			$dbConnection = connectToDB();
			if(!isset($_POST['list'])){
				?>
				<div id="bodyAimodosies">
					<div id="searchUserAdd">
						<label for="searchUser">Ονοματεπώνυμο:</label>
						<input class="textBox" type="text" id="searchUser" onkeyup="donateDonorListAdd()">
						<label for="dateDropDown">για ημερομηνία:</label>
				<?php
						fillDropDown(true,"donateDonorListAdd()"); ?> 
					</div> <?php
					
					$lista=mysql_query("select * from dates;");
					if(mysql_num_rows($lista)>=1){
						while($row = mysql_fetch_array($lista)){
							$datesList = $row['id'];
							break;
						}
					}else{
						$datesList=-1;
					}
			}else{
				$datesList = $_POST['list'];
			}
				
				if(isset($_POST['donateId'])){
					$donor = $_POST['donorId'];
					$donate = $_POST['donateId'];
					$anairesi = $_POST['anairesi'];
					//$result1 = mysql_query("insert into donationdonor set donationID = '$donate', donorID = $donor ;");

					if($anairesi=='true'){
						$errorFlag = false;
						$check = mysql_query("select flasks, sent from users where id = '$donor';");
						while($row = mysql_fetch_array($check)){
							if((intval($row['flasks'])-intval($row['sent'])) == 0){
								$errorFlag=true;
							}
						}
						if($errorFlag==false){
							$result1 = mysql_query("delete from donationdonor where donationID = '$donate' and donorID = $donor ;");
							$result1 = mysql_query("UPDATE users set flasks = flasks - 1 where id = '$donor' ;");
						}else{
							echo "<style onload='myError(\"Δεν επαρκεί το υπόλοιπο!\");'></style>";
						}
					
					}else{
						$result1 = mysql_query("insert into donationdonor set donationID = '$donate' , donorID = $donor ;");
						$result1 = mysql_query("UPDATE users set flasks = flasks + 1 where id = '$donor' ;");
					}
				}
			?>
			<div class = "fadeIn" id="bodyAimodosiesTable">
			<?php if($datesList!=-1){ ?>
				<table id="arrayDonationDonor" align="center" class="scroll"> 
					<thead>
						<tr><th width="10%">ID</th><th width="25%">Επωνυμο</th><th width="25%">Όνομα</th><th width="10%">Αίμα</th><th width="10%">Υπόλοιπο</th><th width="15%"></th></tr>
					</thead>
		<?php

					if(isset($_POST['searchUser'])){
						$searchUser = $_POST['searchUser'];
						$searchUser = strtoupper($searchUser);
						$pinakas=mysql_query("select * from (SELECT u.id as id, firstName, lastName, bloodType, flasks, sent, (true) as iparxei FROM users u where u.usertype = 2 and u.id IN (select dd.donorID from donationdonor dd where dd.donationID='$datesList') union SELECT u.id as id, firstName, lastName, bloodType, flasks, sent, (false) as iparxei FROM users u where u.usertype = 2 and u.id not IN (select dd.donorID from donationdonor dd where dd.donationID='$datesList')) as t where UPPER(t.firstName) like '%$searchUser%' or UPPER(t.lastName) like '%$searchUser%' order by id  ;");
					}else{
						$pinakas=mysql_query("select * from (SELECT u.id as id, firstName, lastName, bloodType, flasks, sent, (true) as iparxei FROM users u where u.usertype = 2 and u.id IN (select dd.donorID from donationdonor dd where dd.donationID='$datesList') union SELECT u.id as id, firstName, lastName, bloodType, flasks, sent, (false) as iparxei FROM users u where u.usertype = 2 and u.id not IN (select dd.donorID from donationdonor dd where dd.donationID='$datesList')) as t order by id  ;");
					}
					?><tbody><?php
					while($row = mysql_fetch_array($pinakas)){
							echo '<tr><td width="10%">'.$row['id'].'</td><td width="25%">'.$row['lastName'].'</td><td width="25%">'.$row['firstName'].'</td><td width="10%">'.$row['bloodType'].'</td><td width="10%">'.($row['flasks']-$row['sent']).'</td>';
							if($row['iparxei']==0){
								echo '<td width="15%"><a><button class="button3" id="'.$row['id'].'" onclick="donateDonorAddButton(this.id,false);">Προσθήκη</button></a></td>';
							}else echo '<td width="15%"><a><button class="button2" id="'.$row['id'].'" onclick="donateDonorAddButton(this.id,true);">Αναίρεση</button></a></td>';
								echo '</tr>';
					}
					
					
					?>
					</tbody>
				</table>
			<?php }else { echo 'Δεν έχει οριστεί καμία ημερομηνία αιμοδοσίας'; 
							echo '<script>document.getElementById("searchUser").onkeyup="";</script>';
			}?>
		</div>
		<?php
			if(!isset($_POST['list'])){
				?>
				</div>
				<?php 
			}
		}else if($_SESSION['userType']==2){ 
			echo 'Negative!';
			header( "refresh:2;index.php" );
		}
	}else{
	echo 'Negative!';
	header( "refresh:2;index.php" );
}
	?>
