<?php
	function aimodotes() {
		$result = mysql_query("select * " .
							  "from users " .
							  "where usertype=2 order by lastName;");
		if (!$result) {
			echo(mysql_error());
			exit();
		}
		return $result;
	}

	function fillDropDown($flag,$onchange){
		$pinakas = datesAimodosies();
		if($flag){
			echo '<select class="dropDownBox " id="dateDropDown" name="dates" onchange="'.$onchange.'">';
		}else{
			echo '<select class="dropDownBox " id="dateDropDown" name="dates">';
		}
		while($row = mysql_fetch_array($pinakas)){
			echo '<option class"opt" value="'.$row['id'].'">'.$row['date'].'</option>';
		}
		echo '</select>';
	}
	function datesAimodosies() {
		$result = mysql_query("select * " .
							  "from dates ;") ;
		if (!$result) {
			echo(mysql_error());
			exit();
		}
		return $result;
	}
	function deleteUser($id){
		$result = mysql_query("DELETE FROM users " .
							  "where id =".$id.";");
	}
	function createAimodosia($date){
		$result = mysql_query("select * " .
								  "from dates " .
								  "where date = '$date'");
		$rows = mysql_num_rows($result);
		if($rows == 1) {
			return false;
		}else{
			$result1 = mysql_query("INSERT INTO dates ".
							  "set date = '$date'; ");
			if (!$result1) {
				echo(mysql_error());
				exit();
			}	
			return $result1;	
		}
	}
	
?>