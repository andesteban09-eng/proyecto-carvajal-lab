<?php
$host = "localhost";
$user = "root";
$pass = "laragon123";
$dbname = "Proyecto_carvajal";

$conexion = new mysqli($host, $user, $pass, $dbname);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}else{
/* echo "Conexión exitosa"; */
}
?>