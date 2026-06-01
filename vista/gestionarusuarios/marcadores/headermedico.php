<?php

date_default_timezone_set("America/Bogota");

$dias = [
    "Domingo","Lunes","Martes","Miércoles",
    "Jueves","Viernes","Sábado"
];

$meses = [
    1=>"Enero","Febrero","Marzo","Abril",
    "Mayo","Junio","Julio","Agosto",
    "Septiembre","Octubre","Noviembre","Diciembre"
];

$fechaActual =
    $dias[date('w')] . ", " .
    date('d') . " de " .
    $meses[date('n')] . " de " .
    date('Y');

?>
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
               <div class="container col-3 d-flex flex-column flex-lg-row align-items-center gap-2">
     <p class="text-secondary mb-0">
        <i class="bi bi-calendar3"></i>
            <?php

echo $fechaActual;
?>
  </p>

  </div>

    <div class="container col-6 d-flex align-items-center gap-3">



        <img src="../../img/LOGO-CARVAJAL-LABORATORIOS-IPS-3-1.webp"
             alt="logo"
             style="height:60px;">

        <div class="ms-auto d-flex align-items-center gap-3">

            <div class="text-end">

                <div class="fw-bold text-primary">
                    Panel Médico
                </div>

                <small class="text-muted">
                    <?= $_SESSION['nombre']?>
                </small>

            </div>

            <div class="dropdown">

                <button class="btn btn-light dropdown-toggle"
                        data-bs-toggle="dropdown">

                    <i class="bi bi-person-badge"></i>

                </button>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <a class="dropdown-item" href="#">
                            Mi Perfil
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            Configuración
                        </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item text-danger"
                           href="../../controlador/gestionarusuarios/cerrarsesion.php">
                            Cerrar sesión
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </div>
</nav>