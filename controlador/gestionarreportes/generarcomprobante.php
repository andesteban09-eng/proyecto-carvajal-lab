<?php
try {
    

include(__DIR__ . '/../../modelo/conexionBD.php');
include(__DIR__ . '/../../librerias/fpdf.php');

$idCita = $_GET['idCita'];

$sql= "SELECT
    c.idCita,
    c.fechaCita,
    c.detalle,
    c.estadoCita AS estado,
    ts.nombre AS servicio,
    ps.nombre AS profesional,
    ps.apellido AS apellidoProfesional,
    s.nombre AS sede
FROM cita c

INNER JOIN tiposervicio ts
ON c.idTipoServicio = ts.idTipoServicio

INNER JOIN profesionalsalud ps
ON c.idProfesionalSalud = ps.idProfesionalSalud

INNER JOIN sede s
ON c.idSede = s.idSede

WHERE c.idCita = $idCita";
$resultado = mysqli_query($conexion, $sql);

$cita = mysqli_fetch_assoc($resultado);

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'CARVAJAL LABORATORIOS',0,1,'C');

$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,'Comprobante de Cita Medica',0,1,'C');

$pdf->Ln(10);
$pdf->Cell(0, 10, "Generado el: " . date('d/m/Y H:i'), 0, 1, "R");
$pdf->Ln(10);
$pdf->Cell(0, 10, "Nro de Cita: " . $cita['idCita'], 0, 1, "L");
$pdf->Ln(10);
$pdf->Cell(0, 10, "Fecha: " . $cita['fechaCita'], 0, 1, "L");
$pdf->Ln(10);
$pdf->Cell(0, 10, "Servicio: " . $cita['servicio'], 0, 1, "L");
$pdf->Ln(10);
$pdf->Cell(0, 10, "Profesional: " . $cita['profesional'] . " " . $cita['apellidoProfesional'], 0, 1, "L");
$pdf->Ln(10);
$pdf->Cell(0, 10, "Sede: " . $cita['sede'], 0, 1, "L");
$pdf->Ln(10);
$pdf->Cell(0, 10, "Estado: " . $cita['estado'], 0, 1, "L");
$pdf->Ln(10);
$pdf->Cell(0, 10, "Detalle: " . $cita['detalle'], 0, 1, "L");

$pdf->Output();
} catch (Exception $e) {
   if (!isset($_GET['idCita'])) {
    die("No se recibió el ID de la cita.");
} 
}
?>