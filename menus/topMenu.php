<link rel="stylesheet" type="text/css" href="menus/topMenu.css">
<ul>
	<li><a href="index.php">Αρχική</a></li>
	<li><a href="#!/pages/news">Νέα</a></li>
	<li><a href="#!/pages/aimodosia&p=1">Αιμοδοσία</a>
	<ul><li><a href="#!/pages/aimodosia&p=1">Τι είναι η αιμοδοσία</a></li>
		<li><a href="#!/pages/aimodosia&p=2">Πόσο αίμα δίνει ο εθελοντής αιμοδότης</a></li>
	</ul>
	</li>
	<li><a href="#!/pages/aimodosia&p=3">Αιτίες Αποκλεισμού</a></li>
	<li><a href="#!/pages/blood&p=1">Το Αίμα</a>
	<ul><li><a href="#!/pages/blood&p=1">Τι είναι το αίμα</a></li>
		<li><a href="#!/pages/blood&p=2">Η σύσταση του αίματος</a></li>
		<li><a href="#!/pages/blood&p=3">Τύποι αίματος</a></li>
	</ul>
	</li>
	<li><a href="#!/pages/contact/contact">Επικοινωνια</a></li>
	<li><a href="#!/pages/statistics/statistics">Στατιστικά ΑΤΕΙΘ</a></li>
	<!--li><a href="#!/pages/test/client/client">test</a></li-->
	<?php 
	if(isset($_SESSION['userType'])){
		if($_SESSION['userType']=='1'){?>
			
			<?php
		}
	}
	?>
</ul>

