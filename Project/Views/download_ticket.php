<?php
require '../assets/db.php';
require '../assets/fpdfFolder/fpdf.php';
session_start();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);   // << change to Arial
$pdf->Cell(0,10,'Flight Ticket',0,1,'C');

$pdf->SetFont('Arial','',12);    // << change to Arial
$pdf->Cell(0,10,'BSZ AIR — Your Itinerary',0,1);
$pdf->Cell(0,10,'Have a nice flight!',0,1);

$pdf->Output('D','ticket.pdf');
?>