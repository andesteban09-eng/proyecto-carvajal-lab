<?php
include (__DIR__."/../../modelo/conexionBD.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try{
$rol = $_POST['rol'];
$Documento = $_POST['NumeroDocumento'];
$contrasena = $_POST['contrasena'];
if($rol == "paciente"){
    $tabla = "paciente";
}elseif($rol == "medico"){
    $tabla = "ProfesionalSalud";
} else{
    throw new Exception("Rol no válido");
}
$sql= "SELECT * FROM $tabla  WHERE NumDoc = '$Documento' AND Contrasena = '$contrasena'";
$resultado = mysqli_query($conexion, $sql);
$usuario = mysqli_fetch_array($resultado);
if (!$usuario) {
    throw new Exception("Usuario o contraseña incorrectos o no existen");
}

  session_start();

$_SESSION['usuario'] = $usuario['NumeroDocumento'];
$_SESSION['rol'] = $rol;
$_SESSION['nombre'] = $usuario['Nombre'];
$_SESSION['apellido'] = $usuario['Apellido'];

if($rol == "paciente"){
    $_SESSION['idUsuario'] = $usuario['idPaciente'];
    header("Location: ../../vista/gestionarusuarios/formularioCita.php");
}else{
    $_SESSION['idUsuario'] = $usuario['idProfesionalSalud'];
    header("Location: ../../vista/gestionarusuarios/dashboardmedico.php");
}

    if($rol == "paciente"){
        header("Location: ../../vista/gestionarusuarios/dashboardpaciente.php");
    }else{
        header("Location: ../../vista/gestionarusuarios/dashboardmedico.php");
    }
exit();

}catch(Exception $e){
    echo "<script>
            alert('Error: " . $e->getMessage() . "');
            window.location.href = '../../vista/gestionarusuarios/formloginusuarios.php';
          </script>";
}

?>
