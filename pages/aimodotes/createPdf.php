
<?php
session_start();
require_once("../../libs/db.php");
$dbConnection = connectToDB();
//require( '/fpdf/fpdf.php' );
require_once('../../tcpdf/tcpdf.php');
if(isset($_SESSION['userType']) && $_SESSION['userType']==1){
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
					$pdf->Cell(0,10 , 'ΛΙΣΤΑ ΑΙΜΟΔΟΤΩΝ', 0,0,"C");
					$pdf->SetFont('dejavusans', "B", 11);
					$pdf->Ln();
					$pdf->Ln();
					$pdf->Cell(55,12 , 'Επώνυμο', 0,0,"L");
					$pdf->Cell(55,12 , 'Όνομα', 0,0,"L");
					$pdf->Cell(25,12 , 'Φύλο', 0,0,"C");
					$pdf->Cell(25,12 , 'Αίμα', 0,0,"C");
					$pdf->Cell(25,12 , 'Υπόλοιπο', 0,0,"C");
					$pdf->Ln();
					$pdf->SetFont('dejavusans', "", 11);
$result = mysql_query("select * from users WHERE userType = 2 order by lastName;");
			$rows = mysql_num_rows($result);
			if($rows >= 1) {
				while($row = mysql_fetch_array($result)){
					$pdf->Cell(55,12 , $row['lastName'], 0,0,"L");
					$pdf->Cell(55,12 , $row['firstName'], 0,0,"L");
					$pdf->Cell(25,12 , $row['gender'], 0,0,"C");
					$pdf->Cell(25,12 , $row['bloodType'], 0,0,"C");
					$pdf->Cell(25,12 , ($row['flasks']-$row['sent']), 0,0,"C");
					$pdf->Ln();
//$pdf->write(5 , $row['bloodType']);
}
}

ob_clean();
$pdf->Output('plate.pdf', 'I');
}
?>
