
<div id="aimodosies">
<div id="topAimodosies">
<label for="date">Ημερομηνία:</label>
<span id="dropDownSpan">
<?php

	require_once("../../libs/sql.php");
	require_once("../../libs/db.php");
	$dbConnection = connectToDB();
			fillDropDown(false,'');
		
	
		?>
</span>
<input align="right" type="button" name="button" id="changeDate" value="Επεξεργασία ημ/νίας" onclick="aimodosiesAdd(true)">
<input align="right" type="button" name="button" id="insertDate" value="Εισαγωγή ημ/νίας" onclick="aimodosiesAdd(false)">

<p id="message"></p>
</div>
<div id="fixAimodosies"></div>

</div>