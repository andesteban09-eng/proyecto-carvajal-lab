<?php
include (__DIR__."/../../modelo/proteccion.php");
protegerRol("medico");
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
      <link rel="stylesheet" href="../../css/principal.css">
    <link rel="stylesheet" href="../../css/footer.css">
</head>
<body>
    <header class="bg-white shadow-sm">
        <?php include(__DIR__ . "/marcadores/headermedico.php"); ?>

    </header>
    <main class="flex-grow-1">
        <div class="container py-5">
            <div class="card shadow-lg border-0 d-flex" style="max-width: 900px; margin: 0 auto;">
                <div class="card-body p-4">
                    <p class="text-center mb-4">Desde tu panel de médico, puedes gestionar tus citas médicas, revisar los resultados de laboratorio de tus pacientes y acceder a herramientas para mejorar tu práctica médica.</p>
                    <div class=" card shadow-lg border-0 d-flex grid gap-3">
                        <a href="citas.php" class="">Gestionar Citas</a>
                    </div>
                    <div class="d-grid gap-3">
                        <a href="resultados.php" class="btn btn-info">Ver Resultados</a>
                    </div>
                    <div class="d-grid gap-3">
                        <a href="gestionarpacientes.php" class="btn btn-secondary">Gestionar Pacientes</a>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-light text-center text-lg-start mt-auto">
            <?php include(__DIR__ . "/marcadores/footer.php"); ?>
        </footer>
</body>
</html>