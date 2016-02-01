<link rel="stylesheet" type="text/css" href="pages/accountTransactions/accountTransactions.css">
<?php
	session_start();
	if(isset($_SESSION['userType']) && $_SESSION['userType']==2){
		require_once("../../libs/db.php");
		$dbConnection = connectToDB();
		$id = $_SESSION['userID'];
		$pinakas = mysql_query("select d.date from donationdonor dd left join dates as d on dd.donationID=d.id where dd.donorID = '$id';");
		if(mysql_num_rows($pinakas)!=0){
			?>
			<div id="transactionsDiv" class="fadeIn">
				<table id="donationsTable" align="center">
					<thead>
						<tr><th width="100%">Ημερομηνίες</th><tr>
					</thead>
					<tbody>
					<?php
						while($row = mysql_fetch_array($pinakas)){
							echo '<tr><td width="100%">'.$row['date'].'</td></tr>';
						}
					?>
					</tbody>
				</table>
			</div>
			<?php 
		}else{
			echo 'Δεν έχετε συμμετέχει σε καμία αιμοδοσία';
		}
	} 
?>
		