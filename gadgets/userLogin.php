
<?php
	if(isset($_POST['submitLogIN'])) {
		$found = loginUser($_POST['username'], $_POST['password']);
		if($found){
			echo '<h1>Καλώς Ήρθατε</h1>';
			header('Location: index.php');
		}else {
			  //echo '<h1>Λάθος Username ή Password</h1>';
			  //echo "<button onclick=\"window.location='index.php?p=login'\">Προσπαθήστε ξανά</button>";
		}	
	}else if(isset($_POST['logOut'])) {
		logoutUser();
		echo '<h1>User has logged off</h1>';

		header('Location: index.php');
	}

?>
<?php 	if(!isset($_SESSION['userID'])){ ?>
			<form action="index.php?p=loginUser" method="post">
				<fieldset>
					<legend> Login </legend>
					<div class="userLogin">
						<label for="username">Username:</label>
						<br>
						<input type="text" name="username" id="username">
					</div>
					<div class="userLogin">
						<label for="password">Password:</label>
						<br>
						<input type="password" name="password" id="password" onkeydown="myAlert(this.id)">
					</div>
					<div class="userLogin">
						<input type="submit" name="submitLogIN" value="Login" id="submitLogIN" onclick="checkForm()" >
						<br>
						
						<p id="loginMessage"></p>
					</div>
				</fieldset>
			</form>
<?php 	}else {
			echo '<form action="index.php?p=loginUser" method="post">';
			echo '<input type="submit" name="logOut" value="logOut" id="logOut">';
			echo '</form>';
			echo $_SESSION['userType'];
			echo '<br>';
			if($_SESSION['userType']=='1'){
				echo '<a href="index.php?p=createUser">create new user σσ</a>';
			}
		}
	
	?>