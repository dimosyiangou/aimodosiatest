<link rel="stylesheet" type="text/css" href="/menus/menuPanel.css">
<div id='cssmenu'>
<ul>
<?php 

	if(isset($_SESSION['userType'])){
			if($_SESSION['userType']=='1'){
			$count = 0;
			$messages = mysql_query('select id from tickets where answered = 0 and root = 1;');
			if($messages){
				while($row = mysql_fetch_array($messages)){
					$count += 1;
				}
			}
			?>
					<li class='active'><a href="#!/pages/home"><span>Αρχική</span></a></li>
		   		   	<li><a href='#!/pages/contact/adminForm'><span>Μηνύματα(<?php echo $count; ?>)</span></a></li>

					   <li class='has-sub'><a href='#'><span>Αιμοδότες</span></a>
						   <ul>
							<li><a href="#!/pages/createUser/createUser"><span>Εγγραφή Αιμοδότη</span></a></li>
							<li><a href="#!/pages/aimodotes/aimodotes"><span>Λίστα Αιμοδοτών</span></a></li>
							<li><a href="#!/pages/aimodotes/donateDonorAdd"><span>Καταχώρηση Σε Αιμοδοσία</span></a></li>
							</ul>
						</li>
					   <li class='has-sub'><a href='#'><span>Αιμοδοσίες</span></a>
						   <ul>
								<li><a href="#!/pages/donationsPanel/createDonations"><span>Δημιουργία Αιμοδοσίας</span></a></li>
								<li><a href="#!/pages/donationsPanel/donateDonorList"><span>Λίστα Αιμοδοσιών</span></a></li>
							</ul>
						</li>
						<li class='has-sub'><a href='#'><span>Δωρεές</span></a>
						   <ul>
								<li><a href="#!/pages/recipientsPanel/recipients">Πίνακας Δωρεών</a></li>
								<li><a href="#!/pages/recipientsPanel/recipientPanel">Δημιουργία Δωρεάς</a></li>
							</ul>
						</li>
						<li><a href='#!/pages/adminPanel/adminPanel'><span>Panel Διαχειριστή</span></a></li>
					<li class='last'><a href='javascript:myLogOut()'><span>Έξοδος</span></a></li>
					<?php
				}
		else if($_SESSION['userType']=='2'){
			$count = 0;
			$userMy = $_SESSION['userID'];
			$messages = mysql_query('select id from tickets where userID='.$userMy.' and readMSG = 0 and answered = 1 and root = 1;');
			if($messages){
				while($row = mysql_fetch_array($messages)){
					$count += 1;
				}
			}
		?>
		   <li class='active'><a href="index.php"><span>Αρχική</span></a></li>
		   </li>
		   			   <li><a href='#!/pages/contact/contactForm'><span>Επικοινωνία με Διαχειριστή (<?php echo $count; ?>)</span></a></li>
			   <li><a href='javascript:userProfile(<?php echo $_SESSION['userID'];?>);'><span>Στοιχεία Λογαριασμού</span></a></li>
				<li class='has-sub'><a href='#'><span>Κινήσεις Λογαριασμού</span></a>
				   <ul>
						<li><a href="#!/pages/accountTransactions/donationsTransactions">Συμμετοχές σε Αιμοδοσίες</a></li>
						<li><a href="#!/pages/accountTransactions/donatingTransactions">Οι Δωρεές μου</a></li>
					</ul>
				</li>
				
		   <li class='last'><a id="logOut" href='javascript:myLogOut()'><span>Έξοδος</span></a></li>
		   <?php
		}
	}
	?>
</ul>
</div>

<!--li class='last'><a href='#'><span>Sub Item</span></a></li-->