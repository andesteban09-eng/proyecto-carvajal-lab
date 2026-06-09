<?php
$host = "localhost";
$user = "root";
/*
Si utiliza Laragon con contraseña personalizada,
actualice el valor de $pass.
*/
$pass = "laragon123";
$dbname = "Proyecto_carvajal";

$conexion = new mysqli($host, $user, $pass, $dbname);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}else{
/* echo "Conexión exitosa"; */
}
?>