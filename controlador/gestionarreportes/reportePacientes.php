<?php
include(__DIR__ . '/../../modelo/conexionBD.php');
include(__DIR__ . '/../../librerias/fpdf.php');

$sql = "SELECT * FROM paciente";
$resultado = mysqli_query($conexion, $sql);

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont("Arial", "", 10);
$pdf->Cell(0, 10, "Reporte de pacientes", 0, 1, "C");
$pdf->Ln(10);
$pdf->Cell(0,10,
    "Generado el: " . date('d/m/Y H:i'), 0,1,"R"
);
$pdf->Ln(20);
$totalPacientes = mysqli_num_rows($resultado);
$pdf->Cell(0, 10, "Total de pacientes: " . $totalPacientes, 0, 1, "R");
$pdf->Ln(20);
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(40, 10, "Tipo de Documento", 1, 0, "C");
$pdf->Cell(40, 10, "Numero de Documento", 1, 0, "C");
$pdf->Cell(40, 10, "Nombre", 1, 0, "C");
$pdf->Cell(40, 10, "Apellido", 1, 0, "C");
$pdf->Cell(40, 10, "Telefono", 1, 0, "C");
$pdf->Cell(40, 10, "Correo", 1, 0, "C");
$pdf->Ln(10);
$pdf->SetFont("Arial", "", 12);
while ($row = $resultado->fetch_assoc()) {
    $pdf->Cell(40, 10, $row['tipoDoc'], 1, 0, "C");
    $pdf->Cell(40, 10, $row['numDoc'], 1, 0, "C");
    $pdf->Cell(40, 10, $row['nombre'], 1, 0, "C");
    $pdf->Cell(40, 10, $row['apellido'], 1, 0, "C");
    $pdf->Cell(40, 10, $row['telefono'], 1, 0, "C");
    $pdf->Ln(10);
}
$pdf->Output();
