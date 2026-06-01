<?php
include (__DIR__."/../../modelo/proteccion.php");
protegerRol("paciente");
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
</head>
<body>
<?php  
include(__DIR__ . "/../../modelo/conexionBD.php");


?>
<header class="bg-white shadow-sm">
    <?php include(__DIR__ . "/marcadores/headerpaciente.php"); ?>
</header>
<h3>
Bienvenido,
<?= $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?>
</h3>
    <div class="container py-5">
        <div class="card shadow-lg border-0" style="max-width: 900px; margin: 0 auto;">
            <div class="card-body p-4">
                <h2 class="card-title text-center mb-4">Solicita tu cita o examen</h2>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Seleccione el tipo de servicio</label>
                            <select class="form-select" >
                                <option value="" selected></option>
                                <option value="citamedica">Cita médica</option>
                                <option value="examen">Laboratorio médico</option>
                                <option value="procedimiento">Vacunación</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="form label">Seleccione especialista</label>
                            <select class="form-select">
                                <option value="" selected></option>
                                <option value="cardiologo">Cardiólogo</option>
                                <option value="dermatologo">Dermatólogo</option>
                                <option value="ginecologo">Ginecólogo</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Fechas disponibles</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Apellido</label>
                            <input type="text" class="form-control" placeholder="Apellido">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Documento</label>
                            <input type="text" class="form-control" placeholder="Documento">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" placeholder="Teléfono">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Contraseña</label>
                            <input type="password" class="form-control" placeholder="Contraseña">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-2">
                    <button class="btn btn-primary btn-lg px-4">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <?php include(__DIR__ . "/marcadores/footer.php"); ?>
    </footer>


</body>
</html>