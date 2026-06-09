<?php
include(__DIR__ . "/../../modelo/proteccion.php");
protegerRol("paciente");
include(__DIR__ . "/../../modelo/conexionBD.php");

$idPaciente = $_SESSION['idUsuario'];
$servicio = $_POST['servicio'] ?? null;
$profesional = $_POST['profesional'] ?? null;
$agenda = $_POST['agenda'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SolicitarProcedimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/principal.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/formularios.css">
</head>

<body>

    <header class="bg-white shadow-sm">
        <?php include(__DIR__ . "/marcadores/headerpaciente.php"); ?>
    </header>
    <div class="container mt-4">
        <h3 class="text-center">
            Bienvenido,
            <?= $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?>
        </h3>
        <p class="text-center text-muted">Aquí puedes solicitar tu cita o examen médico.</p>
    </div>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow border-0 mb-5">
                    <div class="card-body p-4 ">
                        <h3 class="text-center mb-4 fw-bold">
                            Solicita tu cita
                        </h3>
                        <p class="text-center text-muted mb-4">
                            Selecciona paso a paso el servicio, profesional y horario disponible
                        </p>
                        <form class="row g-3" method="POST">
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Servicio</label>

                                    <select class="form-select form-select-lg shadow-sm" name="servicio" class="form-select shadow-sm"
                                        onchange="this.form.submit()" required>
                                        <option value="">Seleccione</option>

                                        <?php
                                        $sql = "SELECT idTipoServicio, nombre 
            FROM tiposervicio 
            WHERE estadoTipoServicio='Activo'
            ORDER BY nombre";

                                        $res = mysqli_query($conexion, $sql);

                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $selected = ($servicio == $row['idTipoServicio']) ? "selected" : "";
                                            echo "<option value='{$row['idTipoServicio']}' $selected>{$row['nombre']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <?php if ($servicio): ?>
                                        <label class="form-label fw-semibold">Profesional</label>
                                        <select class="form-select form-select-lg shadow-sm" name="profesional" class="form-select shadow-sm"
                                            onchange="this.form.submit()" required>

                                            <option value="">Seleccione</option>

                                            <?php
                                            $sql = "SELECT p.idProfesionalSalud, p.nombre, p.apellido
            FROM profesionalsalud p
            INNER JOIN perfiltiposervicio pts 
            ON p.idProfesionalSalud = pts.idProfesionalSalud
            WHERE pts.idTipoServicio = $servicio
            AND p.estadoProfesional = 'Activo'
            AND pts.estadoPerfil = 'Activo'
            GROUP BY p.idProfesionalSalud";

                                            $res = mysqli_query($conexion, $sql);

                                            while ($row = mysqli_fetch_assoc($res)) {
                                                $selected = ($profesional == $row['idProfesionalSalud']) ? "selected" : "";
                                                echo "<option value='{$row['idProfesionalSalud']}' $selected>
                {$row['nombre']} {$row['apellido']}
              </option>";
                                            }
                                            ?>
                                        </select>

                                    <?php endif; ?>
                                </div>
                                <div class="mb-3">
                                    <?php
                                    $dias = [
                                        "Sunday" => "Domingo",
                                        "Monday" => "Lunes",
                                        "Tuesday" => "Martes",
                                        "Wednesday" => "Miércoles",
                                        "Thursday" => "Jueves",
                                        "Friday" => "Viernes",
                                        "Saturday" => "Sábado"
                                    ];

                                    $meses = [
                                        "January" => "Enero",
                                        "February" => "Febrero",
                                        "March" => "Marzo",
                                        "April" => "Abril",
                                        "May" => "Mayo",
                                        "June" => "Junio",
                                        "July" => "Julio",
                                        "August" => "Agosto",
                                        "September" => "Septiembre",
                                        "October" => "Octubre",
                                        "November" => "Noviembre",
                                        "December" => "Diciembre"
                                    ];
                                    ?>

                                    <?php if ($profesional): ?>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Horarios disponibles</label>

                                            <?php
                                            $hoy = date("Y-m-d");
                                            $mañana = date("Y-m-d", strtotime("+1 day"));

                                            $sql ="SELECT a.idHorarioDispo, a.fecha, a.horaInicio, a.consultorio
FROM agenda a
WHERE a.idProfesionalSalud = $profesional
AND (fecha > CURDATE()
     OR (fecha = CURDATE() AND horaInicio > CURTIME()))
AND NOT EXISTS (
    SELECT 1
    FROM cita c
    WHERE c.idProfesionalSalud = a.idProfesionalSalud
    AND DATE(c.fechaCita) = a.fecha
    AND TIME(c.fechaCita) = a.horaInicio
)
ORDER BY a.fecha, a.horaInicio ASC";

                                            $res = mysqli_query($conexion, $sql);

                                            $currentGroup = null;

                                            while ($row = mysqli_fetch_assoc($res)) {

                                                $fecha = $row['fecha'];
                                                $hora = date("H:i", strtotime($row['horaInicio']));

                                                // etiqueta tipo Doctoralia
                                                if ($fecha == $hoy) {
                                                    $grupo = "<i class= 'bi bi-calendar-check'></i > " . " Hoy";
                                                } elseif ($fecha == $mañana) {
                                                    $grupo = "<i class= 'bi bi-calendar-check'></i > " . " Mañana";
                                                } else {
                                                    $grupo = "<i class= 'bi bi-calendar-check'></i > " . " Próximos días";
                                                }

                                                // cerrar grupo anterior
                                                if ($currentGroup != $grupo) {

                                                    if ($currentGroup != null) {
                                                        echo "</div></div>"; // cerrar grupo anterior
                                                    }

                                                    $currentGroup = $grupo;

                                                    echo "
          <div class='card shadow-sm mb-3 border-0'>
            <div class='card-header bg-light fw-semibold'>
              $grupo
            </div>
            <div class='card-body'>
              <div class='d-flex flex-wrap gap-2'>
          ";
                                                }

                                                echo "
        <label>

          <input type='radio'
                 name='agenda'
                 value='{$row['idHorarioDispo']}'
                 class='d-none'
                 onclick='this.checked = true;'
                 required>

          <span class='btn btn-outline-primary btn-sm horario-pill'>
            <i class='bi bi-clock'></i>
            $hora - Consultorio {$row['consultorio']}
          </span>

        </label>
      ";
                                            }

                                            if ($currentGroup != null) {
                                                echo "</div></div></div>";
                                            }
                                            ?>

                                        </div>

                                    <?php endif; ?>
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Detalle (opcional)</label>

                                        <textarea name="detalle"
                                            class="form-control shadow-sm"
                                            rows="3"
                                            placeholder="Escribe alguna observación..."></textarea>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-lg w-100" type="submit"
                                            formaction="../../controlador/gestionarcitas/solicitarCita.php"
                                            class="btn btn-primary btn-lg shadow-sm">
                                            Confirmar cita
                                        </button>
                                    </div>


                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <?php include(__DIR__ . "/marcadores/footer.php"); ?>
        </footer>


</body>

</html>