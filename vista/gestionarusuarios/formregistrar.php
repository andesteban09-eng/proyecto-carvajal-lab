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
        <?php include(__DIR__ . "/marcadores/header.php"); ?>
    </header>
    <div class="container row py-5">
        <h2 class="card-title text-center mb-4">Registro para nuevos usuarios</h2>
        <form action="../../controlador/gestionarusuarios/registrar.php"
            method="POST">
            <div class="card shadow-lg border-0"
                style="max-width: 900px; margin: 0 auto;">
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre" name="Nombre">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Apellido</label>
                                <input type="text" class="form-control" placeholder="Apellido" name="Apellido">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tipo de documento</label>
                                <select class="form-select" name="TipoDocumento">
                                    <option value="CC" selected>Cédula de Ciudadanía</option>
                                    <option value="CE">Cédula de Extranjería</option>
                                    <option value="TI">Tarjeta de Identidad</option>
                                    <option value="RC">Registro Civil</option>
                                    <option value="PAS">Pasaporte</option>
                                    <option value="PPT">Permiso de Trabajo</option>
                                    <option value="OT">Otro</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Documento</label>
                                <input type="text" class="form-control" placeholder="Documento" name="NumeroDocumento">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" placeholder="Teléfono" name="Telefono">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" placeholder="Correo electrónico" name="Correo">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Contraseña</label>
                                <input type="password" class="form-control" placeholder="Contraseña" name="Contrasena">
                            </div>
                            <div>
                                <label class="form-label">Confirmar contraseña</label>
                                <input type="password" class="form-control" placeholder="Confirmar contraseña" name="ConfirmarContrasena">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-2">
                        <button class="btn btn-primary btn-lg px-4">Confirmar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <footer>
        <?php include(__DIR__ . "../marcadores/footer.php"); ?>
    </footer>

</body>

</html>