<script type="text/javascript" src="gadgets/facts/didYouKnow.js"></script>
<link rel="stylesheet" type="text/css" href="gadgets/facts/didYouKnow.css">
<?php if(!isset($_POST['fact'])){ ?>
<h3>Το ήξερες ότι</h3>
<div id="facts">
<?php } 
	if(isset($_POST['fact'])){
		if($_POST['fact']==1){ ?>
<p>Πάνω απο το <span>25%</span> των ανθρώπων χρειάζονται αίμα τουλάχιστον μία φορά στη ζωή τους...</p>
<?php } else if($_POST['fact']==2){ ?>
<p>Το <span>8%</span> των αιμοδοτών, ειναι συγχρόνως και η πρώτη τους φορά</p>
<?php } else if($_POST['fact']==3){ ?>
<p><span>25.000</span>Αιμοδοσίες σε μία μέρα είναι το παγκόσμιο ρεκόρ στο Μουμπάι το 2010</p>
<?php } else if($_POST['fact']==4){ ?>
<p><span>Η ομάδα αίματος ΑΒ είναι η πιο σπάνια</span><br>Μόνο το 4% του πληθυσμού της Ελλάδας εχει ΑΒ</p>
<?php } 
	}else{
	echo '<script type="text/javascript">';
    echo 'facts();';
	echo '</script>';
   }
	
	if(!isset($_POST['fact'])){
	?>
</div>
<button id="button10" onclick="facts()">'Αλλο γεγονός</button>
<?php } ?>
