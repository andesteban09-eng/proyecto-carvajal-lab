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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/principal.css" />
    <link rel="stylesheet" href="../../css/footer.css" />
    <link rel="stylesheet" href="../../css/dashboard.css" />
</head>

<body class="bg-light shadow-sm rounded">
    <?php
    include(__DIR__ . "/marcadores/headerpaciente.php");
    ?>
    <main class="container py-5 min-vh-100">

    <div class="card shadow-sm border-0 rounded-4 mb-5">
        <div class="bg-primary text-white rounded-4 p-5 shadow">

    <h1 class="fw-bold">
        Bienvenido,
        <?= $_SESSION['nombre']; ?>
    </h1>

    <p class="mb-0">
        Gestiona tus citas, exámenes y resultados desde un solo lugar.
    </p>

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
            <a href="resultados.php"
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

    </div>

</main>
    <footer class="bg-light text-center text-lg-start mt-auto">
        <?php include(__DIR__ . "/marcadores/footer.php"); ?>
    </footer>
</body>

</html>