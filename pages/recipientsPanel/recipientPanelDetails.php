<link rel="stylesheet" type="text/css" href="pages/recipientsPanel/recipientPanelDetails.css">
		
<?php 
	session_start();
	if(isset($_SESSION['userType'])){
	
		if(isset($_POST['recID'])) {
			require_once("../../libs/db.php");
			require_once("../../libs/user.php");
			$dbConnection = connectToDB();
			$id = json_decode($_POST['recID']);
			if($_SESSION['userType']==1){
			$result = mysql_query("SELECT CONCAT(u.lastName,' ',u.firstName) as donorName, u.flasks as allflasks, u.sent as allsents,r.lastName as lastName, r.firstName firstName, bloodType, hospital, hospitalCity, r.flasks as flasks, date, r.id as id FROM recipient r left join users as u on u.id = r.donorID where r.id='$id';");
			$rows = mysql_num_rows($result);
			if($rows == 1) {
			 while($row = mysql_fetch_array($result)){
			?>
			
	<div id="recipientDetails">
	<fieldset>
			<legend> Στοιχεία Δωρεάς </legend>
			
			<form id="userProfile" action="index.php" method="post">
				<div align="left" style="margin-left:120px">
				<br>
				<label id="donorNameLabel" for="donorName">Δωρητής:</label>
				<label class="editable" id="donorName"><?php echo $row['donorName']; ?></label>
				<br>
				<label id="lastNameLabel" for="lastName">Παραλήπτης:</label>
				<label class="editable" id="lastName"><?php echo $row['lastName']. ' '.$row['firstName'] ; ?></label>
				<br>
				<label id="bloodLabel" for="blood">Τύπος Αίματος:</label>
				<label class="editable" id="blood"><?php echo $row['bloodType']; ?></label>
				<br>
				<label id="hospitalLabel" for="hospital">Νοσοκομείο:</label>
				<label class="editable" id="hospital"><?php echo $row['hospital']; ?></label>
				<br>
				<label id="hospitalCityLabel" for="hospitalCity">Πόλη Νοσοκομείου:</label>
				<label class="editable" id="hospitalCity"><?php echo $row['hospitalCity']; ?></label>
				<br>
				<label id="dateLabel" for="date">Ημερομηνία:</label>
				<label class="editable" id="date"><?php echo $row['date']; ?></label>
				<br>
				<label id="flasksLabel" for="flasks">Φιάλες:</label>
				<label class="editable" id="flasks"><?php echo $row['flasks']; ?></label>
				<br>
				<label id="remainLabel" for="remain">Υπόλοιπο:</label>
				<label class="editable" id="remain"><?php echo ($row['allflasks']-$row['allsents']);; ?></label>
				<br>
				
				<?php 
				if ($_SESSION['userType']==1){?>
					<input  style="float: right;" class="button2" type="button" id="removeRecipient" value="Αναίρεση" onclick="recipientRemove(<?php echo $id; ?>);">
				<?php }?>
				</div>
			</form>
		</fieldset>
	</div>
	<?php } 
		}
}		
		}else {
			echo 'not found';
		}
	}else{
		echo 'Negative!';
		header( "refresh:2;index.php" );
	}
?>
