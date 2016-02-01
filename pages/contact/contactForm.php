<link rel="stylesheet" type="text/css" href="pages/contact/contact.css">
<?php
	session_start();
	if(isset($_SESSION['userType'])){
		require_once("../../libs/db.php");
		$dbConnection = connectToDB();
		echo '<div id="ticketsDiv">';
		echo '<div style="width:100%;text-align:center;">';
		echo '<input type="button" id="crMSG" class="button2" value="Δημιουργία Συζήτησης" name="createTicket" onclick="ticketFormPanel(this.name)">';
		echo '<input type="button" id="olderPosts" class="button2" name="olderMessages" value="Παλαιότερες Συζητήσεις" onclick="ticketFormPanel(this.name)">';
		echo '</br><span id="respondMessage" style="color:green;"></span>';
		echo '</br><input id="respondMessageButton" style="display:none;" type="button" class="button2" value="Πίσω" onclick="postCancel()">';
		echo '</div>';
		if(!isset($_POST['op'])){
			$userID=mysql_real_escape_string($_SESSION['userID']);
			$message = "";
			$answered = mysql_query("select * from tickets where userID='$userID' order by date desc;");
			//echo '<table class="ticketTables"><thead><th colspan=5><h3 align="left">Μηνύματα που αναμένεται απάντηση</h3></th></thead><tbody>';
			echo '<table class="ticketTables"><br><h3 align="center">Νέα Μηνύματα/Αναμονή Απάντησης</h3><thead align="left"><th width="15%">Συζήτηση</th><th width="35%">Τίτλος</th><th width="15%">Ημερομηνία</th><th width="15%">Κατάσταση</th><th></th></thead><tbody>';
			if(mysql_num_rows($answered)>=1){
				while($row = mysql_fetch_array($answered)){
					if($row['answered']==0 || ($row['readMSG']==0 && $row['root']==1)){
						if($row['answered']==0){
							$message = '<span>Αναμονή</span>';
						}else{
							$message = '<span style="color:green;">Απαντήθηκε</span>';
						}
						$formatted_value = sprintf("%08d", $row['id']);
						echo '<tr><td>'."T".$formatted_value.'</td><td>'.(strlen($row['title'])>37 ? substr($row['title'], 0, 37).'...' : $row['title']).'</td><td>'.substr($row['date'],0,10).'</td><td>'.$message.'</td>';
						echo '<td><input type="button" name="view" class="button1" value="Προεπισκόπιση" id="'.$row['id'].'tickets" onclick="ticketFormPanel(this.name,this.id)"></td></tr>';
					}
				}
			}
		}
		
		echo '<div id="mainTickets">';
		
				if(isset($_POST['op']) && json_decode($_POST['op'])=='createTicket'){
			?><table width="100%"><tr>
				<td width="15%"><label for="title">Τίτλος:</label></td>
				<td width="80%"><input class="textBox" type="text" id="title"></td>
				</tr><tr>
				<td width="15%"><label for="message">Μήνυμα:</label></td>
				<td width="80%"><textarea class="textBox" id="message"></textarea></td></tr></table>
				<br><div class="rightalignment">
				<input type="button" class="button2" value="Αποστολή" onclick="postMessage()">
				<input type="button" class="button2" value="Ακύρωση" onclick="postCancel()">
				</div>
			<?php 
			}
			if(isset($_POST['op']) && json_decode($_POST['op'])=='olderMessages'){
				$userID=$_SESSION['userID'];
				$answered = mysql_query("select * from tickets where userID='$userID' order by date desc;");
				echo '<div class="rightalignment"><input type="button" class="button2" value="Πίσω" onclick="postCancel()"></div><h3 align="center">Όλα τα Μηνύματα</h3><br>';
				//echo '<table class="ticketTables"><thead><th colspan=5><h3 align="left">Παλαιότερα Μηνύματα</h3></th></thead><tbody>';
				echo '<table class="ticketTables"><thead align="left"><th width="15%">Συζήτηση</th><th width="35%">Τίτλος</th><th width="15%">Ημερομηνία</th><th width="15%">Κατάσταση</th><th></th></thead><tbody>';
				$message = '';
				if(mysql_num_rows($answered)>=1){
					while($row = mysql_fetch_array($answered)){
						if($row['answered']==0){
							$message = '<span>Αναμονή</span>';
						}else{
							$message = '<span style="color:green;">Απαντήθηκε</span>';
						}
						if($row['root'] == 1){
							$formatted_value = sprintf("%08d", $row['id']);
							echo '<tr><td>'."T".$formatted_value.'</td><td>'.(strlen($row['title'])>37 ? substr($row['title'], 0, 37).'...' : $row['title']).'</td><td>'.substr($row['date'],0,10).'</td><td>'.$message.'</td>';
							echo '<td><input type="button" name="view" class="button1" value="Προεπισκόπιση" id="'.$row['id'].'tickets" onclick="ticketFormPanel(this.name,this.id)"></td></tr>';
						}
					}
				}echo '</tbody></table>';
			}
			if(isset($_POST['op']) && json_decode($_POST['op'])=='view'){
				$userID=mysql_real_escape_string($_SESSION['userID']);
				$postID=mysql_real_escape_string(json_decode($_POST['ticket']));
				$updateRead = mysql_query("update tickets set readMSG=1 where id = '$postID';");
				$answered = mysql_query("select u.username as username, t.title, t.message, t.date, t.id, t.root, t.answered from tickets as t left join users as u on u.id=t.userID where (t.userID='$userID' && t.id='$postID') or (t.forUser = '$userID' && t.forID='$postID');");
				echo '<div id="ticketViewTable">';
				echo '<div class="rightalignment"><input type="button" class="button2" value="Πίσω" onclick="postCancel()"></div>';
				$isAnswered=0;
				if(mysql_num_rows($answered)>=1){
					while($row = mysql_fetch_array($answered)){
						if($row['root']==1){
							if($row['answered']==1){
								$isAnswered = 1;
							}
						}
						echo '<div id="ticketViewTitle"><h3>'.$row['title'].'</h3></div><div id="ticketViewBody"><p>'.$row['message'].'</p></div>';
						echo '<div id="ticketViewTableBuffer">'.$row['username'].' στις '.$row['date'].'</div>';
					}
				}
				echo '</div><div id="answerPanel">';
				if($isAnswered==1){
					echo '<input type="button" class="button2" value="Δημιουργία Απάντησης" onclick="createAnswer()">';
				}else{
					echo '<input type="button" class="button2" value="Προσθήκη Λεπτομεριών" onclick="createAnswer()">';
				}
				echo '<input type="button" class="button2" value="Πίσω" onclick="postCancel()">';
				echo '</div>';
				echo '<div id="answerCreation" style="display:none;"><textarea class="textBox" id="repostMessage"></textarea><br>';
				
				echo '<input type="button" id="'.$postID.'" class="button2" value="Απάντηση" onclick="postAnswer(this.id)">';
				echo '<input type="button" class="button2" value="Άκυρο" onclick="createAnswer()">';
				echo '</div>';
			}
			echo '</div>';
		echo '</div>';
	
	if(isset($_POST['op']) && json_decode($_POST['op'])=='answered'){
		?><script>document.getElementById("respondMessage").innerHTML="Πετυχημένη Δημιουργία Απάντησης"; document.getElementById("respondMessageButton").style.display="block";</script><?php
	}
	}
	?>