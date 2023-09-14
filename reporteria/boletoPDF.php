<?php
require('../recursos/fpdf/fpdf.php');

$idBoleto = $_GET["idBoleto"];
//Recolectar Detalle de Boleto.
require('../php/conexion.php');
include('../php/boletos/recuperarBoleto.php');

$tarifa ='';
if ($idTarifa%2 == 0) {
    $tarifa = 'Reajuste';
} else {
    $tarifa = 'Normal';
}

$pdf = new FPDF('L','mm',array(105, 230));
$pdf -> SetTitle('Boleto No. ' . $idBoleto);
$pdf -> AddPage();
$pdf -> SetFont('Arial', 'B', 18);
$pdf -> SetTextColor(0, 115, 173);
$pdf -> Image('../recursos/Plantilla.jpg',0,0,230,105);
$pdf -> Image('../recursos/bus.PNG',12,5,15);
$pdf -> Cell(20);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf -> MultiCell(0,2, utf8_decode('Transportes KOMing'), 0,1);
$pdf -> SetXY($x+80,$y);
$pdf -> SetTextColor(1, 1, 1);
$pdf -> SetFont('Arial','',9);
$pdf -> Image('../recursos/bus.PNG',12,5,15);
$pdf -> MultiCell(0,2, utf8_decode('Compra:           ' . date('d-m-Y', strtotime($fechaCompra))), 0,1);
$pdf -> SetXY($x+102,$y+6);
$pdf -> MultiCell(0,2, utf8_decode(date('h:i a', strtotime($horaCompra))), 0,1);

$pdf -> SetXY($x+80,$y+19);
$pdf -> MultiCell(0,2, utf8_decode('No. Boleto:           ' . $idBoleto), 0,1);
$pdf -> SetXY($x+80,$y+26);
$pdf -> MultiCell(0,2, utf8_decode('Tipo de Tarifa:      ' . $tarifa), 0,1);
$pdf -> SetXY($x+80,$y+33);
$pdf -> MultiCell(0,2, utf8_decode('Precio:                  L. ' . $precio), 0,1);

$pdf -> SetXY(0,19);
$pdf -> Ln(5);

$pdf -> SetTextColor(1, 1, 1);
$pdf ->SetFont('Arial','',10);

$pdf -> Cell(3);
$pdf -> Cell(0,10,'BOLETO PERSONAL',0,1);
$pdf -> Ln(-2);

$pdf -> Cell(3);
$pdf -> SetTextColor(0, 115, 173);
$pdf ->SetFont('Arial','B',7);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf -> Multicell(0,10,'Nombre',0,1);
$pdf -> SetXY($x+55,$y);
$pdf -> Cell(0,10,'No. Identidad',0,1);

$pdf -> Ln(-5);

$pdf -> SetTextColor(1, 1, 1);
$pdf ->SetFont('Arial','',9);
$pdf -> Cell(3);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf -> Cell(0,10,utf8_decode($nombre),0,1);
$pdf -> SetXY($x+55,$y);
$pdf -> Cell(0,10,utf8_decode($idCliente),0,1);

$pdf -> SetTextColor(1, 1, 1);
$pdf ->SetFont('Arial','B',9);

$pdf -> Cell(3);
$pdf -> Cell(0,10,'Detalles de Viaje No. ' . $idViaje,0,1);
$pdf -> Ln(-5);


$pdf -> Cell(3);
$pdf -> SetTextColor(0, 115, 173);
$pdf ->SetFont('Arial','B',7);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf -> Multicell(0,10,'De',0,1);
$pdf -> SetXY($x+75,51);
$pdf -> Cell(0,10,'Fecha y Hora de Partida',0,1);

$pdf -> Ln(-5);

$pdf -> SetTextColor(1, 1, 1);
$pdf ->SetFont('Arial','',9);
$pdf -> Cell(3);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf -> Cell(0,10,utf8_decode($nombreCiudadOrigen . ', ' . $nombreDeptoOrigen . ', ' . $nombrePaisOrigen),0,1);
$pdf -> SetXY($x+85,$y);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf -> MultiCell(0,10,utf8_decode(date('d-m-Y', strtotime($fechaSalida))),0,1);
$pdf -> SetXY($x,$y+10);
$pdf -> MultiCell(0,2, utf8_decode(date('h:i a', strtotime($horaSalida))), 0,1);

$pdf -> Cell(3);
$pdf -> SetTextColor(0, 115, 173);
$pdf ->SetFont('Arial','B',7);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf -> SetXY($x,$y-6);
$pdf -> Multicell(0,10,'Hacia',0,1);
$pdf -> Ln(-5);
$pdf -> SetTextColor(1, 1, 1);
$pdf ->SetFont('Arial','',9);
$pdf -> Cell(3);
$pdf -> Cell(0,10,utf8_decode($nombreCiudadDestino . ', ' . $nombreDeptoDestino . ', ' . $nombrePaisDestino),0,1);

$pdf -> SetTextColor(0, 115, 173);
$pdf ->SetFont('Arial','B',7);
$pdf -> SetXY($x+75,$y+2);
$pdf -> Cell(0,10,'Placa del Bus a Abordar',0,1);
$pdf -> SetXY($x+85,$y+6);
$pdf -> SetTextColor(1, 1, 1);
$pdf ->SetFont('Arial','',9);
$pdf -> Cell(0,10,utf8_decode($idBus),0,1);


//Lado Derecho
$pdf -> SetTextColor(0, 115, 173);
$pdf ->SetFont('Arial','B',7);
$pdf -> SetXY(165,0);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf -> Multicell(0,10,'Nombre',0,1);
$pdf -> SetXY($x,$y+10);
$pdf -> Cell(0,10,'No. Identidad',0,1);
$pdf -> SetXY($x,$y+20);
$pdf -> Multicell(0,10,'De',0,1);
$pdf -> SetXY($x,$y+30);
$pdf -> Multicell(0,10,'Hacia',0,1);
$pdf -> SetXY($x,$y+40);
$pdf -> Multicell(0,10,'Fecha y Hora de Partida',0,1);
$pdf -> SetXY($x+35,$y+57);
$pdf -> Multicell(0,10,'Viaje No. ' . $idViaje,0,1);
$pdf -> SetXY($x+35,$y+63);
$pdf -> Multicell(0,10,'Boleto No. ' . $idBoleto,0,1);
$pdf -> SetXY($x+35,$y+69);
$pdf -> Multicell(0,10,'Placa de Bus',0,1);


$pdf -> SetTextColor(1, 1, 1);
$pdf ->SetFont('Arial','',8);
$pdf -> SetXY(165,0);
$pdf -> SetXY($x,$y+5);
$pdf -> Multicell(0,10,utf8_decode($nombre),0,1);
$pdf -> SetXY($x,$y+15);
$pdf -> Multicell(0,10,utf8_decode($idCliente),0,1);
$pdf -> SetXY($x,$y+25);
$pdf -> Cell(0,10,utf8_decode($nombreCiudadOrigen . ', ' . $nombreDeptoOrigen . ', ' . $nombrePaisOrigen),0,1);
$pdf -> SetXY($x,$y+35);
$pdf -> Cell(0,10,utf8_decode($nombreCiudadDestino . ', ' . $nombreDeptoDestino . ', ' . $nombrePaisDestino),0,1);
$pdf -> SetXY($x+5,$y+45);
$pdf -> Multicell(0,10,utf8_decode(date('d-m-Y', strtotime($fechaSalida)) . '                       ' . date('h:i a', strtotime($horaSalida))),0,1);
$pdf -> SetXY($x+39,$y+74);
$pdf -> Multicell(0,10,utf8_decode($idBus),0,1);

$pdf -> Output();

?>