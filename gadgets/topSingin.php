<?php
	
	
	if(isset($_POST['submitLogIN'])) {
		$found = loginUser($_POST['username'], $_POST['password']);
		if($found){
		?><script>var b = true;</script><?php
			//echo 'Καλώς Ήρθατε '.$_POST['username'];
			//header('Location: index.php');
		}else {
			  //echo '<h1>Λάθος Username ή Password</h1>';
			  //echo "<button onclick=\"window.location='index.php?p=login'\">Προσπαθήστε ξανά</button>";
			  ?><script>var a = true;</script><?php
		}	
	}else if(isset($_POST['logOut'])) {
	
	
		?><script>var msg = "Goodbye ";</script><?php
		//echo 'Goodbye '.$_SESSION['username'];
		logoutUser();
		

		header('Location: index.php');
	
	}else if(isset($_POST['logoutMy'])) {
	session_start();
	unset($_SESSION['userID']);
		unset($_SESSION['userType']);
		?><script>var msg = "Goodbye ";</script><?php
		//echo 'Goodbye '.$_SESSION['username'];
		unset($_SESSION['username']);
		//logoutUser();
		

		//header('Location: index.php');
	}

?>
<?php 	if(!isset($_SESSION['userID'])){ ?>
			<form action="/" method="post">
				
					<div class="topSingin">
						<label id="singInMSG" class=""></label>
						<script>document.getElementById("singInMSG").style.color='red'; if(a) document.getElementById("singInMSG").innerHTML="Λάθος Στοιχεία";</script>
						<!--label class="labelStyle" for="username">Username:</label-->
						
						<input class="textBox" size="10" type="text" name="username" id="username" placeholder="username">
					
						<!--label class="labelStyle" for="password">Κωδικός:</label-->
						
						<input class="textBox" size="10" type="password" name="password" id="password" placeholder="password"">
					
						<input class ="button2" type="submit" name="submitLogIN" value="Είσοδος" id="submitLogIN"  >
						<br>
					</div>
			</form>
<?php 	}else { ?>
<form action="index.php" method="post"><div class="topSingin">
<label id="singInMSG" class=""></label>
						<script>document.getElementById("singInMSG").style.color='green'; if(b) document.getElementById("singInMSG").innerHTML="Καλώς Ήρθατε ";</script>
			<input class="button2" type="button" name="account" value="Λογαριασμός" id="account" onclick="openpopup(this)">
			</div></form>
			<?php
		}
	
	?>