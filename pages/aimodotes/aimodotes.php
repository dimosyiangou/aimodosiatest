<link rel="stylesheet" type="text/css" href="pages/aimodotes/aimodotes.css">
<?php 
session_start();
require_once("../../libs/sql.php");
require_once("../../libs/db.php");
$dbConnection = connectToDB();

if(isset($_SESSION['userType'])){
	if($_SESSION['userType']==1){
	
		if(!isset($_POST['searchUser'])){
			?>
			<div id="searchUserAdd">
				<label for="searchUser">Ονοματεπώνυμο:</label>
				<input class="textBox" type="text" id="searchUser" onkeyup="donateDonorListSearch()" value="<?php if(isset($_POST['searchUsers'])){echo json_decode($_POST['searchUsers']);}?>">
				
				<input type="checkbox" id="checkboxRezous" value="rezous" onchange="donateDonorListSearch()" <?php if(isset($_POST['searchRezouss']) && json_decode($_POST['searchRezouss'])!='0'){echo ' checked';}?>>Ρέζους: 
				<select id="bloodTypeDropDown" name="bloodType" onchange="donateDonorListSearch()">
				<?php if(!isset($_POST['searchRezouss'])|| json_decode($_POST['searchRezouss']) == '0'){?><script>document.getElementById("bloodTypeDropDown").disabled = true;</script><?php } ?>
				<?php
				
					$options = array("O+", "A+", "B+", "AB+", "O-", "A-", "B-", "AB-"); ?>
					<?php foreach ($options as $option): ?>
						<option value="<?php echo $option;?>"<?php if(isset($_POST['searchRezouss']) && json_decode($_POST['searchRezouss'])==$option){ echo ' selected';}?>>
						<?php echo $option; ?>
						</option>
					<?php endforeach; 
			 
					?>
				</select>
				<a href="pages/aimodotes/createPdf.php" target="_blank"><input style="margin-left:100px;" class="button2" type="button" value="Δημιουργία PDF" ></a>
			</div> 
		<?php
		}
		?>
<div id="aimodotesList">	
	<table align="center" class="scroll">
		<thead>
		<tr><th width="10%">ID</th><th width="27%">Επώνυμο</th><th width="25%">Όνομα</th><th width="10%">Αίμα</th><th width="10%">Υπόλοιπο</th><th width="15%"></th>
		</tr>
		</thead>
		<tbody>
		<?php
		//if(isset($_POST['searchRezous']) || isset($_POST['param1'])){
		if(isset($_POST['searchUsers']) || isset($_POST['searchUser'])){
			//$searchUser = $_POST['searchUser'];
			$searchRezous = 0;
			if(isset($_POST['searchUsers'])){$searchUser = json_decode($_POST['searchUsers']);}
			if(isset($_POST['searchUser'])){$searchUser = $_POST['searchUser'];}
			if(isset($_POST['searchRezouss'])){$searchRezous = json_decode($_POST['searchRezouss']);}
			if(isset($_POST['searchRezous'])){$searchRezous = $_POST['searchRezous'];}
			//$searchRezous = $_POST['searchRezous'];
			//
			$searchUser = strtoupper($searchUser);
			
			if($searchRezous != '0'){
				$pinakas=mysql_query("select * from users where usertype = 2 and bloodType LIKE '$searchRezous'and (lastName like '%$searchUser%' or firstName like '%$searchUser%') order by lastName;");
			}else{
				$pinakas=mysql_query("select * from users where usertype = 2 and (lastName like '%$searchUser%' or firstName like '%$searchUser%') order by lastName;");
			}
		}else{			
		$pinakas = aimodotes();
		}
		while($row = mysql_fetch_array($pinakas)){
			echo '<tr><td width="10%">'.$row['id'].'</td><td width="27%">'.$row['lastName'].'</td><td width="25%">'.$row['firstName'].'</td><td width="10%">'.$row['bloodType'].'</td><td width="10%">'.($row['flasks']-$row['sent']).'</td>';
			 ?><td width="15%"><a href="javascript:userProfile(<?php echo $row['id']; ?>);"><button class="button1">Αναλυτικά</button></a></td>
			 <?php echo '</tr>';
		}
		
		?>
		</tbody>
	</table>
</div>
<?php 
	} 
} else {echo 'Negative!';
header( "refresh:2;index.php" );
}

?>
