<?php
session_start();

include(__DIR__ . "/../../modelo/conexionBD.php");
?>
<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Citas</title>

 <link rel="stylesheet" href="../../css/principal.css" />
    <link rel="stylesheet" href="../../css/footer.css" />
    <link rel="stylesheet" href="../../css/dashboard.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body class="bg-light">

    <header>
        <?php include(__DIR__ . "/marcadores/headerpaciente.php"); ?>
    </header>

<div class="container py-4">


<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Mis Citas</h2>

    <a href="formularioCita.php" class="btn btn-primary">
        Agendar Nueva Cita
    </a>
</div>

<div class="card shadow-sm">

    <div class="card-header">
       <h2>Gestión de Citas</h2>
    </div>

    <div class="card-body">

        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Servicio</th>
                    <th>Profesional</th>
                    <th>Sede</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

            <?php
            // Lógica para obtener las citas del usuario
            $idPaciente = $_SESSION['idUsuario'];

$sql = "SELECT
    c.idCita,
    c.fechaCita,
    c.estadoCita AS estado,
    ts.nombre AS tipo_servicio,
    ps.nombre AS nombre_profesional,
    ps.apellido AS apellido_profesional,
    s.nombre AS sede
FROM cita c

INNER JOIN tiposervicio ts
    ON c.idTipoServicio = ts.idTipoServicio

INNER JOIN profesionalsalud ps
    ON c.idProfesionalSalud = ps.idProfesionalSalud

INNER JOIN sede s
    ON c.idSede = s.idSede

WHERE c.idPaciente = $idPaciente

ORDER BY c.fechaCita DESC;";

            $resultado = mysqli_query($conexion, $sql);

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>{$fila['idCita']}</td>";
                echo "<td>{$fila['fechaCita']}</td>";
                echo "<td>{$fila['tipo_servicio']}</td>";
                echo "<td>{$fila['nombre_profesional']} {$fila['apellido_profesional']}</td>";
                echo "<td>{$fila['sede']}</td>";
                echo "<td>{$fila['estado']}</td>";

                // Acciones
                echo "<td>";

                // Ver detalles
                echo "<a href='verCita.php?id={$fila['idCita']}' class='btn btn-sm btn-info me-1'>Ver</a>";

                // Cancelar cita (solo si está pendiente)
                if ($fila['estado'] === 'Pendiente') {
                    echo "<a href='../../controlador/gestionarcitas/cancelarcita.php?id={$fila['idCita']}' class='btn btn-sm btn-danger' onclick=\"return confirm('¿Estás seguro de cancelar la cita?')\">Cancelar</a>";
                }

                echo "</td>";

                echo "</tr>";
            }
            ?>
            </tbody>

        </table>

    </div>

</div>


</div>
<footer class="mt-4">
    <?php include(__DIR__ . "/marcadores/footer.php"); ?>
</footer>
</body>
</html>
