<?php
include(__DIR__ . '/../../modelo/conexionBD.php');
try {
    $idServicio = $_POST['idServicio'];

    $sql = "SELECT
    s.nombre AS servicio,
    s.precio,
    s.prerequisitos,
    ts.nombre AS tipoServicio
FROM servicio s

INNER JOIN tiposervicio ts
ON s.idTipoServicio = ts.idTipoServicio

WHERE s.idServicio = $idServicio";

    $resultado = mysqli_query($conexion, $sql);

    $servicio = mysqli_fetch_assoc($resultado);

    $nombreServicio = $servicio['servicio'];
    $precio = $servicio['precio'];
    $prerequisitos = $servicio['prerequisitos'];
    $tipoServicio = $servicio['tipoServicio'];


    require('../../librerias/fpdf.php');

    $pdf = new FPDF();

    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);

    $pdf->Cell(
        0,
        10,
        'COTIZACION DE SERVICIO',
        0,
        1,
        'C'
    );

    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 12);

    $pdf->Cell(
        0,
        10,
        'Fecha: ' . date('d/m/Y'),
        0,
        1
    );

    $pdf->Cell(
        0,
        10,
        'Tipo de Servicio: ' . $servicio['tipoServicio'],
        0,
        1
    );

    $pdf->Cell(
        0,
        10,
        'Servicio: ' . $servicio['servicio'],
        0,
        1
    );

    $pdf->Cell(
        0,
        10,
        'Precio: $' . number_format($servicio['precio'], 0, ',', '.'),
        0,
        1
    );

    $pdf->MultiCell(
        0,
        10,
        'Prerequisitos: ' . $servicio['prerequisitos']
    );

    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'I', 10);

    $pdf->MultiCell(
        0,
        8,
        'Este documento es una cotizacion informativa y no reemplaza una orden medica.'
    );

    $pdf->Output();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
