<link rel="stylesheet" type="text/css" href="pages/contact/contact.css">
<?php
	session_start();
	if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1){
		require_once("../../libs/db.php");
		$dbConnection = connectToDB();
		echo '<div id="ticketsDiv">';
	
		//echo '<input type="button" class="button2" value="Δημιουργία Μηνύματος" name="createTicket" onclick="ticketFormPanelAdmin(this.name)">';
		echo '<input type="button" class="button2" name="olderMessages" value="Παλαιότερες Συζητήσεις" onclick="ticketFormPanelAdmin(this.name)">';
		if(!isset($_POST['op'])){
			$userID=$_SESSION['userID'];
			$answered = mysql_query("select * from tickets where answered = 0 and root = 1 order by date desc;");
			//echo '<table class="ticketTables"><thead><th colspan=4><h3 align="left">Νέα Μηνύματα</h3></th></thead><tbody>';
			echo '<table class="ticketTables">';
			echo '<br><h3 align="center">Νέα Μηνύματα</h3><br><thead align="left"><th width="15%">Συζήτηση</th><th width="35%">Τίτλος</th><th width="15%">Ημερομηνία</th><th width="20%">Κατάσταση</th><th></th></thead><tbody>';
			if(mysql_num_rows($answered)>=1){
				while($row = mysql_fetch_array($answered)){
				
					$formatted_value = sprintf("%08d", $row['id']);
					echo '<tr><td>'."T".$formatted_value.'</td><td>'.(strlen($row['title'])>44 ? substr($row['title'],0,44).'...' : $row['title']).'</td><td>'.substr($row['date'],0,10).'</td><td><span style="color:red;">Δεν Απαντήθηκε</span></td>';
					echo '<td><input type="button" name="answer" class="button1" value="Απάντηση" id="'.$row['id'].'tickets" onclick="ticketFormPanelAdmin(this.name,this.id)"></td></tr>';
				
				}
			}
		}
		
		echo '<div>';
				if(isset($_POST['op']) && json_decode($_POST['op'])=='createTicket'){
			?>
				<label for="title">Τίτλος:</label>
				<input type="text" id="title">
				<br>
				<label for="message">Μήνυμα:</label>
				<textarea class="textbox" id="message"></textarea>
				<br>
				<input type="button" class="button2" value="Αποστολή" onclick="postMessage()">
				<input type="button" class="button2" value="Ακύρωση" onclick="postCancelAdmin()">
			<?php 
			}
			if(isset($_POST['op']) && json_decode($_POST['op'])=='olderMessages'){
				$userID=$_SESSION['userID'];
				$message = '';
				$answered = mysql_query("select * from tickets where root = 1 order by date desc;");
				
				echo '<div style="width:100%;text-align:right;"><input type="button" class="button2" value="Πίσω" onclick="postCancelAdmin()"></div><h3 align="center">Παλαιότερες Συζητήσεις</h3><br>';
				//echo '<table class="ticketTables"><thead><th colspan=5><h3 align="left">Παλαιότερα Μηνύματα</h3></th></thead><tbody>';
				echo '<table class="ticketTables"><thead align="left"><th width="15%">Συζήτηση</th><th width="35%">Τίτλος</th><th width="15%">Ημερομηνία</th><th width="20%">Κατάσταση</th><th></th></thead><tbody>';
				if(mysql_num_rows($answered)>=1){
					while($row = mysql_fetch_array($answered)){
					if($row['answered']==0){
							$message = '<span style="color:red;">Δεν Απαντήθηκε</span>';
						}else{
							$message = '<span style="color:green;">Απαντήθηκε</span>';
						}
						$formatted_value = sprintf("%08d", $row['id']);
						echo '<tr><td>'."T".$formatted_value.'</td><td>'.(strlen($row['title'])>44 ? substr($row['title'],0,44).'...' : $row['title']).'</td><td>'.substr($row['date'],0,10).'</td><td>'.$message.'</td>';
						echo '<td><input type="button" name="answer" class="button1" value="Απάντηση" id="'.$row['id'].'tickets" onclick="ticketFormPanelAdmin(this.name,this.id)"></td></tr>';
					}
				}echo '</tbody></table>';
			}				
			if(isset($_POST['op']) && json_decode($_POST['op'])=='answer'){
				
				$postID=json_decode($_POST['ticket']);
				$answered = mysql_query("select u.username as username, t.title, t.message, t.date, t.id from tickets as t left join users as u on u.id=t.userID where t.id='$postID' or t.forID = '$postID';");
				echo '<div style="width:100%;text-align:right;"><input type="button" class="button2" value="Πίσω" onclick="postCancelAdmin()"></div>';
				echo '<div id="ticketViewTable">';
				if(mysql_num_rows($answered)>=1){
					while($row = mysql_fetch_array($answered)){
						echo '<div id="ticketViewTitle"><h3>'.$row['title'].'</h3></div><div id="ticketViewBody"><p>'.$row['message'].'</p></div>';
						echo '<div id="ticketViewTableBuffer">'.$row['username'].' στις '.$row['date'].'</div>';
					}
				}
				echo '</div><div id="adminAnswerPanel">';
				?>
				<label style="float:left;" for="message">Μήνυμα:</label>
				<textarea class="textBox" id="message"></textarea>
				<br>
				<input type="checkbox" id="<?php echo 'close'.$postID; ?>" name="closeTicket" value="closeTicket" onclick="closeTicketCheck(this.id)">Μαρκάρισμα για κλείσιμο συζήτησης
				<input type="button" class="button2" id="<?php echo $postID; ?>" value="Αποστολή" onclick="postMessageAdmin(this.id)">
				<input type="button" class="button2" value="Ακύρωση" onclick="postCancelAdmin()">
				</div>
				<div style="width:100%;text-align:right;"><input type="button" class="button2" value="Πίσω" onclick="postCancelAdmin()"></div>
			<?php 
			}
			echo '</div>';
		echo '</div>';
	
	}
?>
	
	