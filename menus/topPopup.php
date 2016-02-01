<?php 
	session_start(); 
	if(isset($_SESSION['userType'])){?>
		<div id="firstLevel">
		<p>
<?php 
		require_once("../libs/sql.php");
		require_once("../libs/db.php");
		$dbConnection = connectToDB();
		$id = $_SESSION['userID']; 
		$pinakas = mysql_query("select * from users where id = '$id';");
		while($row = mysql_fetch_array($pinakas)){
?>
			<label id="popupLastName"><?php echo $row['lastName'];?></label>
			<label id="popupFirstName"><?php echo $row['firstName'];?></p></label><hr width="95%">
			<p>
			<label for="popupUsername">username:</label>
			<label id="popupUsername"><?php echo $row['username'];?></label>
			<br>
			<label for="popupFlasks">Φιάλες:</label>
			<label id="popupFlasks"><?php echo $row['flasks'];?></label>
			<label for="popupSent">Δωρεές:</label>
			<label id="popupSent"><?php echo $row['sent'];?></label>
			<br>
			<label for="popupRest">Υπόλοιπο:</label>
			<label id="popupRest"><?php echo ($row['flasks']-$row['sent']);?></label>
			<br>
			<label for="popupFlasks">Τύπος Αίματος:</label>
			<label id="popupFlasks"><?php echo $row['bloodType'];?></label>

		</p>
<?php } ?>
		</div>
		<div id="secondLevel">
			<form action="index.php?p=topSingin" method="post">
				<input class="button2" type="button" name="logOut" value="Αναλυτικά" id="logOut" onclick="userProfile(<?php echo $_SESSION['userID'];?>)">
				<input class="button2" type="submit" name="logOut" value="Έξοδος" id="logOut">
			</form>
		</div>
<?php 
	}else{ 
		echo 'negative!';
		header( "refresh:2;index.php" );
	}
?>