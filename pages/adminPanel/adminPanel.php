<?php
	session_start();
	if(isset($_SESSION['userType'])){
		if($_SESSION['userType']==1){
		
		?>
<link rel="stylesheet" type="text/css" href="pages/adminPanel/adminPanel.css">
Εξαγωγή αντιγραφου ασφαλειας της βάσης δεδομένων
<a href="pages/adminPanel/export.php" target="_blank"><input style="margin-left:30px;" class="button2" type="button" value="Εξαγωγή" ></a>
<br>
<hr>
<br>
Επαναφορά βάσης δεδομένων σε προγενέστερη μορφή (Προσοχή μπορεί να χαθούν καταχωρήσεις που δεν έχουν σωθεί. Κάντε εξαγωγή βάσης πρώτα).
<br><br>
<table class="scroll" ><tbody>
<?php

 foreach(glob('backups/'.'*.php') as $filename){
	sort($filename);
	list($folder, $file) = explode("/", $filename);
     echo '<tr><td>'.$file.'</td><td><a><button class="button2" id="'.$file.'" onclick="importDB(this.id);">Επαναφορά</button></a></td><td><a href="/pages/adminPanel/download.php?fileName='.$file.'"><button class="button2">Download</button></a></td></tr>';
 }

 ?>
 </tbody>
 </table>
 
 <?php
  }
  }
  ?>
