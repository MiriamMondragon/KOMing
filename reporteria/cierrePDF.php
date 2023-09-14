<?php
require('../recursos/fpdf/fpdf.php');

require('../php/conexion.php');

$pdf = new FPDF('P', 'mm', 'Letter');
$pdf->SetTitle('Cierre de Caja del ' . date('d-m-Y'));
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 115, 173);
$pdf->Image('../recursos/bus.PNG', 12, 10, 15);

$pdf->Cell(30);
$pdf->Cell(40, 10, 'Cierre de Caja de Venta de Boletos y Encomiendas del ' . date('d-m-Y'));
$pdf->Ln(20);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(1, 1, 1);
$pdf->SetXY($x + 10, $y);
$pdf->Cell(40, 10, 'Usuario Solicitante: ');
$pdf->SetXY($x + 80, $y);
$pdf->Cell(40, 10, 'Fecha: ');
$pdf->SetXY($x + 150, $y);
$pdf->Cell(40, 10, 'Hora: ');

$x = 10;
$y = 30;
$pdf->SetFont('Arial', '', 10);
$pdf->SetXY($x + 45, $y);
$pdf->Cell(40, 10, $_GET["idUsuario"]);
$pdf->SetXY($x + 95, $y);
$pdf->Cell(40, 10, date('d-m-Y'));
$pdf->SetXY($x + 165, $y);
$pdf->Cell(40, 10, date('h:i a'));

$pdf->SetFont('Arial', 'B', 10);
$y = $y + 20;
$consulta = "SELECT B.Id_Boleto, B.Fecha_Compra, B.Hora_Compra, U.Id_Usuario, B.Id_Cliente, B.Id_Tarifa, B.Precio
            FROM v_Boleto AS B INNER JOIN Usuarios AS U ON B.Id_Empleado = U.Id_Empleado
            WHERE B.Fecha_Compra = '" . date('Y-m-d') . "';";
$resultado = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($resultado) != 0) {
    $pdf->SetXY($x + 10, $y);
    $pdf->Cell(40, 10, 'Listado de Boletos Vendidos');
    $pdf->Ln(12);

    $pdf->Cell(6);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(20, 10, 'No. Boleto', 1, 0, 'C', 0);
    $pdf->Cell(22, 10, 'Hora Compra', 1, 0, 'C', 0);
    $pdf->Cell(35, 10, 'Usuario Caja', 1, 0, 'C', 0);
    $pdf->Cell(50, 10, 'Cliente', 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode('Método de Pago'), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, 'Monto', 1, 1, 'C', 0);

    $totalBoletos = 0.00;

    $pdf->SetFont('Arial', '', 9);
    while ($row = $resultado->fetch_assoc()) {
        $pdf->Cell(6);
        $pdf->Cell(20, 10, utf8_decode($row["Id_Boleto"]), 1, 0, 'C', 0);
        $pdf->Cell(22, 10, utf8_decode($row["Hora_Compra"]), 1, 0, 'C', 0);
        $pdf->Cell(35, 10, utf8_decode($row["Id_Usuario"]), 1, 0, 'C', 0);
        $pdf->Cell(50, 10, utf8_decode($row["Id_Cliente"]), 1, 0, 'C', 0);
        $pdf->Cell(30, 10, utf8_decode('Efectivo'), 1, 0, 'C', 0);
        $pdf->Cell(30, 10, utf8_decode('L.' . $row["Precio"]), 1, 1, 'C', 0);
        $totalBoletos = $totalBoletos + $row["Precio"];
    }
    $pdf->Cell(6);
    $pdf->Cell(127, 10, '', 0, 0, 'C', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(30, 10, 'Total', 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode('L.' . number_format($totalBoletos, 2)), 1, 1, 'C', 0);

    $x = $pdf->GetX();
    $y = $pdf->GetY();
}


$consulta = "SELECT EN.Id_Guia, EN.Fecha_Envio, EN.Hora_Envio, U.Id_Usuario, EN.Id_Emisor, EN.Id_Tarifa, EN.Precio
            FROM v_Encomienda AS EN INNER JOIN Usuarios AS U ON EN.Id_Empleado = U.Id_Empleado
            WHERE EN.Fecha_Envio = '2021-03-14';";
$resultado = mysqli_query($conexion, $consulta);
if (mysqli_num_rows($resultado) != 0) {
    $pdf->SetFont('Arial', 'B', 10);
    $y = $y + 10;
    $pdf->SetXY($x + 10, $y);
    $pdf->Cell(40, 10, utf8_decode('Listado de Guías Vendidas'));
    $pdf->Ln(12);

    $pdf->Cell(6);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(20, 10, utf8_decode('No. Guía'), 1, 0, 'C', 0);
    $pdf->Cell(22, 10, 'Hora Compra', 1, 0, 'C', 0);
    $pdf->Cell(35, 10, 'Usuario Caja', 1, 0, 'C', 0);
    $pdf->Cell(50, 10, 'Cliente', 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode('Método de Pago'), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, 'Monto', 1, 1, 'C', 0);

    $totalGuias = 0.00;

    $pdf->SetFont('Arial', '', 9);
    while ($row = $resultado->fetch_assoc()) {
        $pdf->Cell(6);
        $pdf->Cell(20, 10, utf8_decode($row["Id_Guia"]), 1, 0, 'C', 0);
        $pdf->Cell(22, 10, utf8_decode($row["Hora_Envio"]), 1, 0, 'C', 0);
        $pdf->Cell(35, 10, utf8_decode($row["Id_Usuario"]), 1, 0, 'C', 0);
        $pdf->Cell(50, 10, utf8_decode($row["Id_Emisor"]), 1, 0, 'C', 0);
        $pdf->Cell(30, 10, utf8_decode('Efectivo'), 1, 0, 'C', 0);
        $pdf->Cell(30, 10, utf8_decode('L.' . $row["Precio"]), 1, 1, 'C', 0);
        $totalGuias = $totalGuias + $row["Precio"];
    }
    $pdf->Cell(6);
    $pdf->Cell(127, 10, '', 0, 0, 'C', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(30, 10, 'Total', 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode('L.' . number_format($totalGuias, 2)), 1, 1, 'C', 0);
}

$pdf->Cell(6);
$pdf->Cell(187, 10, '', 0, 1, 'C', 0);
$pdf->Cell(127, 10, '', 0, 0, 'C', 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(6);
$pdf->Cell(30, 10, utf8_decode('Total del Día'), 1, 0, 'C', 0);
$pdf->Cell(30, 10, utf8_decode('L.' . number_format(($totalGuias + $totalBoletos), 2)), 1, 1, 'C', 0);

$pdf->SetFont('Arial', '', 9);
$x = $pdf->GetX();
$y = $pdf->GetY();
$y = $y + 10;
$pdf->SetXY($x + 10, $y);
$pdf->Cell(40, 10, utf8_decode('Esta lista será entregada o reclamada por el responsable de caja.                                                        Transportes KOMing'));

$pdf->Output();
