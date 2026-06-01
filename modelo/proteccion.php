<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function protegerRol($rolPermitido)
{
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== $rolPermitido) {
        header("Location: ../../vista/gestionarusuarios/formloginusuarios.php");
        exit();
    }
}
?>