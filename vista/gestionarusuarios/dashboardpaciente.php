<?php
include(__DIR__ . "/../../modelo/proteccion.php");
protegerRol("paciente");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="../../css/principal.css" />
    <link rel="stylesheet" href="../../css/footer.css" />
    <link rel="stylesheet" href="../../css/dashboard.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
</head>

<body class="bg-light shadow-sm rounded">
    <header class="bg-white shadow-sm">
        <?php include(__DIR__ . "/marcadores/headerpaciente.php"); ?>

    </header>
    <main>
    <div class="container mt-4 mb-4">
<section class="hero shadow justify-content-around  border-0 rounded-4 mb-2 p-4 p-lg-5 shadow-sm">
            <div class="row align-items-center">

                <div class="col-md-8">
                    <h1 class="fw-bold">
                        Hola, <?= $_SESSION['nombre']; ?>
                    </h1>
                    <?php
                    include(__DIR__ . "/../../modelo/conexionBD.php");
                    ?>

                    <p class="lead">
                        Bienvenido al Portal de Pacientes de Carvajal Laboratorios IPS
                    </p>

                    <p>
                        Desde aquí podrás gestionar tus citas, consultar resultados
                        y realizar seguimiento a tus procedimientos.
                    </p>

                </div>

                <div class="col-md-4 text-center">

                    <i class="bi bi-person-heart display-1"></i>
                </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row d-flex gap-4 m-4 justify-content-center flex-lg-row flex-column">

        <div class="card border-0 shadow-sm m-3 col-lg-3">
            <div class="card-body text-center">
                <?php
                try {
                    $idPaciente = $_SESSION['idUsuario'];

                    $sql = "SELECT COUNT(*) AS total
FROM cita
WHERE idPaciente = '$idPaciente'
AND EstadoCita = 'Pendiente'
AND fechaCita >= NOW();
";

                    $resultado = mysqli_query($conexion, $sql);

                    $fila = mysqli_fetch_assoc($resultado);

                    $totalPendientes = $fila['total'];
                   if($totalPendientes > 0){ 
echo "<div class='alert text-center'>
    <i class='bi bi-exclamation-triangle'></i>
    Tienes  $totalPendientes  citas pendientes.
</div>";
                    } else {
                        echo "
    <div class='alert'>
        <i class='bi bi-check-circle-fill text-success'></i>
       <h2> $totalPendientes </h2>
                <small>Solicitudes nuevas</small>
    </div>
    ";
                    }
                } catch (Exception $e) {
                    echo "
    <div class='alert alert-danger'>
        <i class='bi bi-exclamation-triangle-fill text-danger'></i>
        Error al consultar citas pendientes.
    </div>";
                }
                ?>
            </div>

        </div>

        <div class="card border-0 shadow-sm m-3 col-lg-3">
            <div class="card-body text-center">
                <i class="bi bi-file-earmark-medical text-primary"></i>
                <h2><?= $totalPendientes ?></h2>
                <small>Resultados pendientes</small>
            </div>
        </div>

        <div class="card border-0 shadow-sm m-3 col-lg-3">
            <div class="card-body text-center">
                <i class="bi bi-journal-medical text-primary"></i>
                <h2><?= $totalPendientes ?></h2>
                <small>Solicitudes nuevas</small>
            </div>
        </div>
    </div>
 </div>

    <div class="row g-4">

        <!-- CITAS -->
        <div class="col-md-4">
            <a href="citas.php"
                class="text-decoration-none">

                <div class="card shadow-sm border-0 h-100 text-center">

                    <div class="card-body p-4">

                        <i class="bi bi-calendar-check display-2 text-primary"></i>

                        <h4 class="mt-3">
                            Gestionar Citas
                        </h4>

                        <p class="text-muted">
                            Agenda, consulta o cancela tus citas médicas.
                        </p>

                    </div>

                </div>

            </a>
        </div>

        <!-- EXÁMENES -->
        <div class="col-md-4">
            <a href="examenes.php"
                class="text-decoration-none">

                <div class="card shadow-sm border-0 h-100 text-center">

                    <div class="card-body p-4">

                        <i class="bi bi-clipboard-data display-2 text-success"></i>

                        <h4 class="mt-3">
                            Solicitar Exámenes
                        </h4>

                        <p class="text-muted">
                            Consulta y solicita procedimientos de laboratorio.
                        </p>

                    </div>

                </div>

            </a>
        </div>


        <!-- RESULTADOS -->
        <div class="col-md-4">
            <a href="../../controlador/gestionarreportes/reportePacientes.php"
                class="text-decoration-none">

                <div class="card shadow-sm border-0 h-100 text-center">

                    <div class="card-body p-4">

                        <i class="bi bi-file-earmark-medical display-2 text-danger"></i>

                        <h4 class="mt-3">
                            Ver Resultados
                        </h4>

                        <p class="text-muted">
                            Consulta los resultados de tus exámenes.
                        </p>

                    </div>

                </div>

            </a>
        </div>
        <div class="card border-0 shadow-sm mx-auto col-lg-11">

            <div class="card-body">

                <h5>
                    <i class="bi bi-calendar-event"></i>
                    Próxima cita
                </h5>

                <?php
                $idPaciente = $_SESSION['idUsuario'];

                $sql = "SELECT
    c.fechaCita,
    p.Nombre,
    p.Apellido,
    s.Ciudad
FROM cita c

INNER JOIN ProfesionalSalud p
ON c.idProfesionalSalud = p.idProfesionalSalud

INNER JOIN sede s
ON c.idSede = s.idSede

WHERE c.idPaciente = $idPaciente
AND c.fechaCita >= NOW()

ORDER BY c.fechaCita ASC

LIMIT 1;";

                $resultado = mysqli_query($conexion, $sql);

                if ($resultado) {
                    $cita = mysqli_fetch_assoc($resultado);

                    if ($cita) {
                        echo "<div class='alert alert-info'>";

                        echo "<h6>Próxima cita</h6>";

                        echo "<p><strong>Fecha:</strong> "
                            . date('d/m/Y h:i A', strtotime($cita['fechaCita']))
                            . "</p>";

                        echo "<p><strong>Sede:</strong> "
                            . $cita['Ciudad']
                            . "</p>";

                        echo "<p><strong>Profesional:</strong> "
                            . $cita['Nombre'] . " " . $cita['Apellido']
                            . "</p>";

                        echo "</div>";
                    } else {
                        echo "<p class='mb-0'>No tienes citas programadas.</p>";
                    }
                } else {
                    echo "<p class='mb-0'>Error al obtener las citas.</p>";
                }
                ?>
            </div>
        </div>
    </div>
    </main>
    <footer class="bg-light text-center text-lg-start mt-auto">
        <?php include(__DIR__ . "/marcadores/footer.php"); ?>
    </footer>
</body>

</html>