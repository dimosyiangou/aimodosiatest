
<?php
session_start();
require_once("../../libs/db.php");
$dbConnection = connectToDB();
//require( '/fpdf/fpdf.php' );
require_once('../../tcpdf/tcpdf.php');
/*
$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetFont("Arial","B","20");
$id = $_SESSION['chosenUser'];
$result = mysql_query("select * " .
									  "from users " .
									  "where id = '$id'");
			$rows = mysql_num_rows($result);
			if($rows == 1) {
				while($row = mysql_fetch_array($result)){
$pdf->Cell(0,10 , $id, 1,1,"C");
$pdf->Cell(0,10 , 'username: '. $row['username'], 1,1,"C");
$pdf->Cell(0,10 , 'ΞΞ½ΞΏΞΌΞ±sadασδασδ: '. $row['firstName'], 1,1,"C");
$pdf->Cell(0,10 , 'ΞΟΟΞ½ΟΞΌΞΏ: '. $row['lastName'], 1,1,"C");
$pdf->Cell(0,10 , 'Φύλλο'. $row['gender'], 0,0,"R");
//$pdf->write(5 , $row['bloodType']);
}
}
$pdf->Output();
*/
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('dejavusans', ”, 12);
$pdf->AddPage();
if($_SESSION['userType']==1){
$id = $_SESSION['chosenUser'];
}else{
$id = $_SESSION['userID'];
}
$result = mysql_query("select * " .
									  "from users " .
									  "where id = '$id'");
			$rows = mysql_num_rows($result);
			if($rows == 1) {
				while($row = mysql_fetch_array($result)){
					$timezone = date_default_timezone_get();
					$date = date('d/m/Y', time());
					$pdf->SetFont('dejavusans', "", 14);
					$pdf->Cell(0,8 , 'ΙΑΤΡΕΙΟ ΑΤΕΙΘ', 0, 0, "R");
					$pdf->Ln();
					$pdf->Cell(0,8 , $date, 0, 0, "R");
					$pdf->Ln();
					$pdf->Ln();
					$pdf->Ln();
					$pdf->SetFont('dejavusans', "B", 15);
					$pdf->Cell(0,10 , 'ΣΤΟΙΧΕΙΑ ΑΙΜΟΔΟΤΗ', 0,0,"C");
					$pdf->SetFont('dejavusans', "", 12);
					$pdf->Ln();
					$pdf->Ln();
					$pdf->Cell(50,12 , 'Όνομα: ', 0,0,"L");
					$pdf->Cell(0,12 ,$row['firstName'], 0,0,"L");
					$pdf->Ln();
					$pdf->Cell(50,12 , 'Επώνυμο: ', 0,0,"L");
					$pdf->Cell(0,12 , $row['lastName'], 0,0,"L");
					$pdf->Ln();
					$pdf->Cell(50,12 , 'Φύλο: ', 0,0,"L");
					$pdf->Cell(0,12 , $row['gender'], 0,0,"L");
					$pdf->Ln();
					$pdf->Cell(50,12 , 'Τύπος Αίματος: ', 0,0,"L");
					$pdf->Cell(0,12 , $row['bloodType'], 0,0,"L");
					$pdf->Ln();
					$pdf->Cell(50,12 , 'Συμμετοχές(Φιάλες): ', 0,0,"L");
					$pdf->Cell(30,12 , $row['flasks'], 0,0,"L");
					$pdf->Cell(50,12 , 'Δωρεές: '. $row['sent'], 0,0,"L");
					$pdf->Cell(60,12 , 'Υπόλοιπο: '. ($row['flasks']-$row['sent']), 0,0,"L");
					$pdf->Ln();
					$pdf->Cell(50,12 , 'Όνομα Πατρός: ', 0,0,"L");
					$pdf->Cell(0,12 , $row['fatherName'], 0,0,"L");
					$pdf->Ln();
					$pdf->Cell(50,12 , 'Ημερομηνία Γέννησης: ', 0,0,"L");
					$pdf->Cell(0,12 , $row['birthDate'], 0,0,"L");
					$pdf->Ln();
					$pdf->Cell(50,12 , 'email: ', 0,0,"L");
					$pdf->Cell(0,12 , $row['email'], 0,0,"L");
					$pdf->Ln();
					$pdf->Cell(50,12 , 'Τηλέφωνο(σταθερό): ', 0,0,"L");
					$pdf->Cell(0,12 , $row['phone'], 0,0,"L");
					$pdf->Ln();
					$pdf->Cell(50,12 , 'Κινητό: ', 0,0,"L");
					$pdf->Cell(0,12 , $row['mobile'], 0,0,"L");
					$pdf->Ln();
					$pdf->Cell(50,12 , 'Πόλη: ', 0,0,"L");
					$pdf->Cell(0,12 , $row['city'], 0,0,"L");
					$pdf->Ln();
					$pdf->Cell(50,12 , 'Διεύθυνση: ', 0,0,"L");
					$pdf->Cell(75,12 , $row['address'], 0,0,"L");
					$pdf->Cell(80,12 , 'ΤΚ: '. $row['TK'], 0,0,"L");
//$pdf->write(5 , $row['bloodType']);
}
}

ob_clean();
$pdf->Output('plate.pdf', 'I');
?>
