<link rel="stylesheet" type="text/css" href="pages/accountTransactions/accountTransactions.css">
<?php
	session_start();
	if(isset($_SESSION['userType']) && $_SESSION['userType']==2){
		require_once("../../libs/db.php");
		$dbConnection = connectToDB();
		$id = $_SESSION['userID'];
		$pinakas = mysql_query("select * from recipient where donorID='$id';");
		if(mysql_num_rows($pinakas)!=0){
			?>
			<div id="transactionsDiv" class="fadeIn">
				<table id="transactionsTable" align="center">
					<thead>
						<tr><th width="20%">Επώνυμο</th><th width="20%">Όνομα</th><th width="10%">Φιάλες</th><th width="15%">Ημερομηνία</th><th width="15%">Νοσοκομείο</th><th width="15%">Πόλη</th><tr>
					</thead>
					<tbody>
					<?php
						while($row = mysql_fetch_array($pinakas)){
							echo '<tr><td width="20%">'.$row['lastName'].'</td><td width="20%">'.$row['firstName'].'</td><td width="10%">'.$row['flasks'].'</td><td width="15%">'.$row['date'].'</td><td width="15%">'.$row['hospital'].'</td><td width="15%">'.$row['hospitalCity'].'</td></tr>';
						}
					?>
					</tbody>
				</table>
			</div>
			<?php 
		}else{
			echo 'Δεν έχετε κάνει καμία δωρεά';
		}
	} 
?>
		