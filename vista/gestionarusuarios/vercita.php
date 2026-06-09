<?php
session_start();

include(__DIR__ . "/../../modelo/conexionBD.php");
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

<body>
    <header class="bg-white shadow-sm">
        <?php include(__DIR__ . "/marcadores/headerpaciente.php"); ?>

    </header>
    <main>
        <div class="container mt-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h2>Detalles de la Cita</h2>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['id'])) {
                        $idCita = $_GET['id'];

                        $sql = "SELECT
    c.idCita,
    c.fechaCita,
    c.detalle,
    c.estadoCita AS estado,
    ts.nombre AS servicio,
    ps.nombre AS profesional,
    ps.apellido AS apellidoProfesional,
    s.nombre AS sede
FROM cita c

INNER JOIN tiposervicio ts
ON c.idTipoServicio = ts.idTipoServicio

INNER JOIN profesionalsalud ps
ON c.idProfesionalSalud = ps.idProfesionalSalud

INNER JOIN sede s
ON c.idSede = s.idSede

WHERE c.idCita = $idCita
";

                        $resultado = mysqli_query($conexion, $sql);

                        if ($resultado) {
                            $cita = mysqli_fetch_assoc($resultado);

                            if ($cita) {
                                echo "
                        <h3>Servicio: " . $cita['servicio'] . "</h3>    
                        <p><strong>Profesional:</strong> " . $cita['profesional'] . " " . $cita['apellidoProfesional'] . "</p>
                        <p><strong>Sede:</strong> " . $cita['sede'] . "</p>
                        <p><strong>Fecha:</strong> " . $cita['fechaCita'] . "</p>
                        <p><strong>Estado:</strong> " . $cita['estado'] . "</p>
                        <p><strong>Detalle:</strong> " . $cita['detalle'] . "</p>
                        ";
                            } else {
                                echo "<p class='text-danger'>Cita no encontrada.</p>";
                            }
                        } else {
                            echo "<p class='text-danger'>Error al obtener la cita.</p>";
                        }
                    } else {
                        echo "<p class='text-danger'>ID de cita no proporcionado.</p>";
                    }
                    ?>

                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="../../controlador/gestionarreportes/generarcomprobante.php?idCita=<?php echo $idCita; ?>"
                        target="_blank"
                        class="btn btn-primary">
                        Descargar comprobante
                    </a>
                </div>
            </div>
        </div>
    </main>
    <footer class="mt-4">
        <?php include(__DIR__ . "/marcadores/footer.php"); ?>
    </footer>
</body>

</html>