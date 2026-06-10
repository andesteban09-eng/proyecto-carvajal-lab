<?php
include(__DIR__ . '/../../modelo/conexionBD.php');
include(__DIR__ . '/../../librerias/fpdf.php');

session_start();

$idPaciente = $_SESSION['idUsuario'];

$sql = "SELECT
c.idCita,
c.fechaCita,
c.estadoCita,
c.detalle,
ts.nombre AS servicio
FROM cita c

INNER JOIN tiposervicio ts
ON c.idTipoServicio = ts.idTipoServicio

WHERE c.idPaciente = $idPaciente

ORDER BY c.fechaCita DESC
";
$resultado = mysqli_query($conexion, $sql);

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont("Arial","B",14);
$pdf->Cell(0,10,"Historial de Citas",0,1,"C");

$pdf->SetFont("Arial","",10);
$pdf->Cell(
    0,
    10,
    "Generado el: ".date("d/m/Y H:i"),
    0,
    1,
    "R"
);
$totalCitas = mysqli_num_rows($resultado);

$pdf->Cell(
    0,
    10,
    "Total de citas registradas: ".$totalCitas,
    0,
    1,
    "L"
);
$pdf->Cell(20,10,"ID",1,0,"C");
$pdf->Cell(45,10,"Fecha",1,0,"C");
$pdf->Cell(60,10,"Servicio",1,0,"C");
$pdf->Cell(35,10,"Estado",1,1,"C");


while($row = mysqli_fetch_assoc($resultado))
{
    $pdf->Cell(20,10,$row['idCita'],1,0,"C");
    $pdf->Cell(45,10,$row['fechaCita'],1,0,"C");
    $pdf->Cell(60,10,$row['servicio'],1,0,"C");
    $pdf->Cell(35,10,$row['estadoCita'],1,1,"C");
}
$pdf->Output();
