<?php
include (__DIR__."/../../modelo/proteccion.php");
protegerRol("medico");

include (__DIR__."/../../modelo/conexionBD.php");

$idMedico = $_SESSION['idUsuario'];

$sql = "SELECT idCita,
                detalle AS title,
                fechaCita AS start,
                estadoCita  
        FROM cita 
        WHERE idProfesionalSalud = $idMedico";

$resultado = mysqli_query($conexion, $sql);

$citas = [];
while ($fila = mysqli_fetch_assoc($resultado)) {
    $fila["color"] = match($fila["estadoCita"]) {
        "Pendiente" => "#ffc107",
        "Realizada" => "#198754",
        "Cancelada" => "#dc3545",
    };
    $citas[] = $fila;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css' rel='stylesheet'>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <link rel="stylesheet" href="../../css/principal.css">
    <link rel="stylesheet" href="../../css/footer.css">
      <link rel="stylesheet" href="../../css/dashboard.css" />
</head>
<body>
    <header class="bg-white shadow-sm">
        <?php include(__DIR__ . "/marcadores/headermedico.php"); ?>

    </header>

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- PANEL LATERAL -->
            <div class="col-md-3 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header bg-primary text-white text-center">
                        Opciones de citas
                        
                    </div>
                    <div class="card-body">
                        <button class="btn btn-success w-100 mb-3">Nueva cita</button>
                        <button class="btn btn-warning w-100 mb-3"> Editar cita</button>
                        <button class="btn btn-danger w-100">Eliminar cita</button>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card shadow">
                    <div class="card-header bg-white text-center fw-bold fs-5">
                        Calendario de citas
                    </div>
                    <div class="card-body">
                        <div id="calendar">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CALENDARIO -->
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {

                initialView: 'dayGridMonth',

                locale: 'es',

                height: '75vh',

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                events: <?php echo json_encode($citas); ?>,
        

            });

            calendar.render();

        });

    </script>    


    <footer class="bg-light text-center text-lg-start mt-auto">
        <?php include(__DIR__ . "/marcadores/footer.php"); ?>
    </footer>
</body>
</html>
