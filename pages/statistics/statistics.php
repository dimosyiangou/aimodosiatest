<link rel="stylesheet" type="text/css" href="pages/statistics/statistics.css">
<?php 
	require_once("../../libs/sql.php");
	require_once("../../libs/db.php");
	$dbConnection = connectToDB();
	
	//$query = "select count(bloodType) as donors from users";
	//$countDonors = odbc_exec($dbConnection, $query); 
	$countDonors = mysql_query("select count(bloodType) as donors from users where userType = 2 ");
	
	if(mysql_num_rows($countDonors)==1){
		while($row = mysql_fetch_array($countDonors)){
			$donors = $row['donors'];
		}
	}
	
	$query = "select bloodType , count(bloodType) as myCount from users where userType = 2 group by bloodType;";
	//$bloodTypeRes = odbc_exec($dbConnection, $query); 
	$bloodTypeRes = mysql_query($query);
	$query = "select d.date, count(dd.donorID) as myCount from donationdonor as dd left join dates d on dd.donationID=d.id group by dd.donationID ORDER BY d.date DESC;";
	//$imerominiesRes = odbc_exec($dbConnection, $query); 
	$imerominiesRes = mysql_query($query);
	$query = "select gender, count(gender) as myCount from users where userType = 2 group by gender;";
	//$genosRes = odbc_exec($dbConnection, $query);  
	$genosRes = mysql_query($query);
	
	
	echo '<div id="statistics" class="fadeIn">';
		echo '<p>';
		echo 'Το πλήθος των εγγεγραμμένων αιμοδοτών του ιατρείου του ΑΤΕΙΘ ανά ομάδα αίματος.';
		echo '</p><table>';
		echo '<thead><tr><th>Τύπος Αίματος</th><th>Αιμοδότες</th><th>%</th></tr></thead>';
		echo '<tbody>';
		while($row = mysql_fetch_array($bloodTypeRes)){
		
			echo '<tr><td>'.$row["bloodType"].'</td><td>'.$row["myCount"].'</td><td>'.round(($row["myCount"]*100)/$donors).'%</td></tr>';
		}
		echo '</tbody></table>';
		echo '<div class="statisticsSeparator"></div>';
		
		echo '<p>';
		echo 'Ο αριθμός των αιμοδοτών που δώσαν αίμα για κάθε μία άπο τις αιμοδοσίες που λάβαν χώρα στο ιατρείο του ΑΤΕΙΘ.';
		echo '</p><table class="datesTable">';
		echo '<thead><tr><th width="50%">Ημερομηνία</th><th width="45%">Αιμοδότες</th></tr></thead>';
		echo '<tbody>';
		while($row = mysql_fetch_array($imerominiesRes)){
			echo '<tr><td width="50%">'.$row["date"].'</td><td width="45%">'.$row["myCount"].'</td></tr>';
		}
		echo '</tbody></table>';
		echo '<div class="statisticsSeparator"></div>';
		
		echo '<div class="statisticsField"><p>';
		echo 'Το πλήθος και το ποσοστό των αιμοδοτών επί τοις εκατό χωρισμένο με βάση το φύλο.';
		echo '</p><table>';
		echo '<thead><tr><th>Φύλο</th><th>Πλήθος</th><th>%</th></tr></thead>';
		echo '<tbody>';
		while($row = mysql_fetch_array($genosRes)){
			echo '<tr><td>'.$row["gender"].'</td><td>'.$row["myCount"].'</td><td>'.round(($row["myCount"]*100)/$donors).'%</td></tr>';
		}
		echo '</tbody></table>';
		echo '<div class="statisticsSeparator"></div>';
	echo '</div>';
	?>
	