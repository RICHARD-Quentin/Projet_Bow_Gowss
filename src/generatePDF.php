<?php

require('../lib/fPDF/fPDF.php');
require('../lib/PHPMailer/src/SMTP.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Content !');  //$_POST['content']
$pdf->Output();