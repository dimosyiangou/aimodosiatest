<link rel="stylesheet" type="text/css" href="pages/recipientsPanel/recipient.css">
<?php 
session_start();
require_once("../../libs/sql.php");
require_once("../../libs/db.php");
$dbConnection = connectToDB();

if(isset($_SESSION['userType']) && $_SESSION['userType']==1){
	
		if(isset($_POST['var1'])){
			deleteUser($_POST['var1']);
			}
			?>
			<div id="recipientList">
	<table class="scroll" id="recipientListArray">
	<thead class="fixedHeader">
		<tr><th width="10%">ID</th><th width="39%">Δωρητής</th><th width="9%">Αίμα</th><th width="9%">Φιάλες</th><th width="14%">Ημ/νία</th><th width="13%"></th>
		</tr>
		</thead>
		<tbody>
		
			
		<?php
		if (isset($_POST['recipient'])){
			$recipient = $_POST['recipient'];
			$pinakas = mysql_query("select * from recipient where id = '$recipient';");
			if(mysql_num_rows($pinakas)==1){
				while($row = mysql_fetch_array($pinakas)){
					$donor = $row['donorID'];
					$flasks = $row['flasks'];	
				}
			}
			$pinakas = mysql_query("delete from recipient where id = '$recipient';");
			$result1 = mysql_query("UPDATE users set sent = sent - '$flasks' where id = '$donor' ;");
		}
		$pinakas = mysql_query("SELECT CONCAT(u.lastName,' ',u.firstName) as donorName, CONCAT(r.lastName , ' ' , r.firstName) as name, bloodType, hospital, hospitalCity, r.flasks as flasks, date, r.donorID as did, r.id as id FROM recipient r left join users as u on u.id = r.donorID;");
		while($row = mysql_fetch_array($pinakas)){
			echo '<tr><td width="10%">' .$row['did'].'</td><td width="39%">'.$row['donorName'].'</td><td width="9%">'.$row['bloodType'].'</td><td width="9%">'.$row['flasks'].'</td><td width="14%">'.$row['date'].'</td>';
			echo '<td width="13%"><a href="#!/pages/recipientsPanel/recipientPanelDetails&recID='.$row['id'].'"><button class="button2" id="'.$row['id'].'rec">Λεπτομέρειες</button></a></td>';
			 ?>
			 <?php echo '</tr>';
		}
		
		?>
		
		</tbody>
	</table>
</div>
<?php 
	
} else {echo 'Negative!';
header( "refresh:2;index.php" );
}

?>
