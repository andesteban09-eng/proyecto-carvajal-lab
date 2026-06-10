<?php
include(__DIR__ . "/../../modelo/conexionBD.php");

try {
    $TipoDocumento = $_POST['TipoDocumento'];
$NumeroDocumento = $_POST['NumeroDocumento'];
$Nombre = $_POST['Nombre'];
$Apellido = $_POST['Apellido'];
$Telefono = $_POST['Telefono'];
$Direccion = $_POST['Direccion'];
$Ciudad = $_POST['Ciudad'];
$Contrasena = $_POST['Contrasena'];
$ConfirmarContrasena = $_POST['ConfirmarContrasena'];
$sqlValidar = "SELECT * FROM paciente WHERE NumDoc = '$NumeroDocumento'";
$consulta = mysqli_query($conexion, $sqlValidar);

if(mysqli_num_rows($consulta) > 0){
   echo "<script>
            alert('El correo ya está registrado. Por favor, utiliza otro correo.');
            window.location.href='../../vista/gestionarusuarios/formloginusuarios.php';
          </script>";
          exit();
}
$ValidarDocumento = "SELECT * FROM paciente WHERE NumDoc = '$NumeroDocumento'";
$consultaDocumento = mysqli_query($conexion, $ValidarDocumento);
$ValidarContrasena = $Contrasena === $ConfirmarContrasena;
if(mysqli_num_rows($consultaDocumento) > 0){
    echo "<script>
             alert('El número de documento ya está registrado. Por favor, verifica tu información.');
             window.location.href='../../vista/gestionarusuarios/formloginusuarios.php';
           </script>";
           exit();
}
if(!$ValidarContrasena){
    echo "<script>
             alert('Las contraseñas no coinciden. Por favor, verifica tu información.');
             window.location.href='../../vista/gestionarusuarios/formregistrar.php';
           </script>";
           exit();
}

$sql= "INSERT INTO paciente (TipoDoc, NumDoc, Nombre, Apellido, Telefono,Direccion,Ciudad, Contrasena) 
VALUES ('$TipoDocumento', '$NumeroDocumento', '$Nombre', '$Apellido', '$Telefono','$Direccion','$Ciudad','$Contrasena')";
$resultado = mysqli_query($conexion, $sql);


    echo "<script>
            alert('El paciente se ha registrado correctamente.');
            window.location.href='../../vista/gestionarusuarios/formloginusuarios.php';
          </script>";

    
} catch (Exception $e) {
    die($e->getMessage());
}


?>