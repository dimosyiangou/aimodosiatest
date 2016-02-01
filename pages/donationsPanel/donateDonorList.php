<link rel="stylesheet" type="text/css" href="pages/donationsPanel/donationsPanel.css">
<?php 
	session_start();
	if(isset($_SESSION['userType'])){
		if($_SESSION['userType']==1){
		?>

<?php 
	require_once("../../libs/sql.php");
	require_once("../../libs/db.php");
	$dbConnection = connectToDB();
	if(!isset($_POST['list'])){
	?><div id="bodyAimodosies">
		<div id="searchUserAdd">
		<label for="dateDropDown">Αιμοδότες που λάβαν μέρος στις:</label>
		<?php
		fillDropDown(true,"donateDonorList()"); ?>
		<a href="pages/donationsPanel/createPdf.php" target="_blank"><input style="margin-left:100px;" class="button2" type="button" value="Δημιουργία PDF" ></a>
		<td width="15%"><a><button class="button2" id="'.$_SESSION['donationID'].'" onclick="deleteDonation(this.id);">Delete Donation</button></a></td>
	
		<?php



		echo '</div>';
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
		$_SESSION['donationID'] = $_POST['list'];
	}
	
				if($datesList!=-1){
					if (isset($_POST['item'])){
								$errorFlag = false;
								$item = $_POST['item'];
								$check = mysql_query("select flasks, sent from users where id = '$item';");
								while($row = mysql_fetch_array($check)){
									if((intval($row['flasks'])-intval($row['sent'])) == 0){
										$errorFlag=true;
									}
								}
								if($errorFlag==false){
									$pinakas = mysql_query("delete from donationdonor where donationID = '$datesList' and donorID = '$item';");
									$result1 = mysql_query("UPDATE users set flasks = flasks - 1 where id = '$item' ;");
								}else{
									echo "<style onload='myError(\"Δεν επαρκεί το υπόλοιπο!\");'></style>"; 
								}
							}
					?>
					<div id = "bodyAimodosiesTable"  class="fadeIn">
						<table id="arrayDonationDonor" class="scroll" align="center"> 
							<thead>
								<tr><th width="15%">ID</th><th width="25%">Επωνυμο</th><th width="25%">Όνομα</th><th width="15%">Αίμα</th><th width="15%">Υπόλοιπο</th><th width="16%"></th></tr>
							</thead>
							<tbody>
							<?php
							$array=array();
							
							
							$pinakas = mysql_query("select u.id as id, username, firstName, lastName, bloodType, flasks, sent, date, dd.donorID from donationdonor as dd inner join dates d on dd.donationID=d.id inner join users u on dd.donorID = u.id where d.id = '$datesList'");
						
							while($row = mysql_fetch_array($pinakas)){ 
							$array[]=$row;
								echo '<tr><td class="tableItem"  value='.$row['id'].' width="15%">'.$row['id'].'</td><td  value='.$row['lastName'].' width="25%">'.$row['lastName'].'</td><td  value='.$row['firstName'].' width="25%">'.$row['firstName'].'</td><td  value='.$row['bloodType'].' width="15%">'.$row['bloodType'].'</td><td  value='.(intval($row['flasks'])-intval($row['sent'])).' width="15%">'.(intval($row['flasks'])-intval($row['sent'])).'</td>'.
								// '<td width="16%"><a><button class="button2" id="'.$row['id'].'" onclick="donateDonorListRemove(this.id);">Αναίρεση</button></a></td>'.
								 '</tr>';
							}
							?>		
							</tbody>

						</table>
			
				
					</div>
			<?php
		
			}else{
				echo 'Δεν υπάρχουν καταχωρημένες αιμοδοσίες';
			}
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



