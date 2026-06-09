<?php
session_start();
include("../../modelo/conexionBD.php");

try {

    $idPaciente = $_SESSION['idUsuario'];

    $idHorario = $_POST['agenda'] ?? null;
    $detalle = $_POST['detalle'] ?? '';

    if (!$idHorario) {
        throw new Exception("No se seleccionó horario");
    }

    // 🔵 1. Traer datos reales desde agenda
    $sql = "SELECT a.*, s.idTipoServicio, a.idSede
            FROM agenda a
            INNER JOIN profesionalsalud p ON a.idProfesionalSalud = p.idProfesionalSalud
            INNER JOIN perfiltiposervicio s ON p.idProfesionalSalud = s.idProfesionalSalud
            WHERE a.idHorarioDispo = $idHorario
            LIMIT 1";

    $result = mysqli_query($conexion, $sql);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        throw new Exception("Horario no válido");
    }

    $idProfesional = $data['idProfesionalSalud'];
    $idSede = $data['idSede'];
    $fecha = $data['fecha'] . ' ' . $data['horaInicio'];
    $idTipoServicio = $data['idTipoServicio'];

    // 🔵 2. Insertar cita
    $sqlInsert = "INSERT INTO cita 
    (idPaciente, idProfesionalSalud, idSede, idTipoServicio, fechaCita, detalle)
    VALUES 
    ($idPaciente, $idProfesional, $idSede, $idTipoServicio, '$fecha', '$detalle')";

    mysqli_query($conexion, $sqlInsert);

    header("Location: ../../vista/gestionarusuarios/gestionarcitas.php");
    exit();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>