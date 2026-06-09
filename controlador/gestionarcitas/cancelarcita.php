<?php

session_start();

include("../../modelo/conexionBD.php");

$idCita = $_GET['id'];

$sql = "
UPDATE cita
SET estadoCita='C'
WHERE idCita=$idCita
";

mysqli_query($conexion,$sql);

header("Location: ../../vista/gestionarusuarios/gestionarcitas.php");
exit();

?>