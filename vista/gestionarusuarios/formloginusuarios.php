<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/principal.css">
    <link rel="stylesheet" href="../../css/footer.css">
</head>

<body class="bg-light">
    <?php
    include(__DIR__ . "/../../modelo/conexionBD.php");
    include(__DIR__ . "/marcadores/header.php");
    ?>


    <div class="container min-vh-100 d-flex my-5 align-items-center">
        <div class="row w-100">
            <div class="container min-vh-100 d-flex justify-content-center align-items-center">
                <div class="row w-100">

                    <div class=" col-lg-6 col-md-8  mx-auto">

                        <div class="text-center mb-4">

                            <i class="bi bi-calendar2-check display-4 text-primary"></i>

                            <h1 class="display-5 fw-bold mt-3">
                                Laboratorios Carvajal
                            </h1>

                            <p class="lead text-muted">
                                Acceso para usuarios registrados. Por favor, ingresa tus credenciales para iniciar sesión y gestionar tus citas médicas.
                            </p>

                        </div>
                        <div class="col-13 col-md-6 offset-md-3">
                            <ul class="nav nav-tabs mb-4 nav-justified" id="loginTabs">

                                <li class="nav-item">
                                    <button
                                        class="nav-link active"
                                        id="paciente-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#paciente">
                                        Paciente
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button
                                        class="nav-link"
                                        id="medico-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#medico">
                                        Profesional de Salud
                                    </button>
                                </li>

                            </ul>
                            <form class="bg-white p-4 shadow-lg rounded-3 px-5 py-4" id="formLoginUsuarios" action="../../controlador/gestionarusuarios/inciosesionusuarios.php" method="POST">
                                <input
                                    type="hidden"
                                    id="rol"
                                    name="rol"
                                    value="paciente">

                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="bi bi-card-text"></i>
                                    Documento de identidad
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control-lg w-100" id="NumeroDocumento" name="NumeroDocumento" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="bi bi-lock"></i>
                                        Contraseña
                                    </label>
                                    <input type="password" class="form-control-lg w-100" id="password" name="contrasena" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Recuérdame</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg w-100">Iniciar Sesión</button>
                                <div class="d-flex justify-content-between mt-3">
                                    <a href="../../vista/gestionarusuarios/formregistrar.php" class="text-decoration-none">
                                        Crear cuenta
                                    </a>

                                    <a href="recuperarcontrasena.php" class="text-decoration-none">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include(__DIR__ . "/marcadores/footer.php");
    ?>
    <script>
        document.getElementById("paciente-tab")
            .addEventListener("click", function() {

                document.getElementById("rol").value = "paciente";

            });

        document.getElementById("medico-tab")
            .addEventListener("click", function() {

                document.getElementById("rol").value = "medico";

            });
    </script>
</body>

</html>