<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/principal.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <header class="bg-white shadow-sm">
        <?php include(__DIR__ . "/marcadores/header.php");
        include(__DIR__ . "/../../modelo/conexionBD.php");
        ?>
    </header>
    <div class="container mt-4 ">
        <div class="row g-4 justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Formulario de Cotizaciones</h5>
                        <form class="row g-3" method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label"> Tipo de Servicio</label>
                                <? $idTipoServicioSeleccionado = $_POST['tiposervicio'] ?? ''; ?>
                                <select class="form-control" id="TipoServicio" name="tiposervicio" onchange="this.form.submit()" required>
                                    <option value="">Seleccione un tipo de servicio</option>
                                    <?php
                                    $sql = "SELECT * FROM tiposervicio";
                                    $resultado = mysqli_query($conexion, $sql);

                                    if (mysqli_num_rows($resultado) > 0) {
                                        $tipoSeleccionado = $_POST['tiposervicio'] ?? '';

                                        while ($row = mysqli_fetch_assoc($resultado)) {

                                            $selected = '';

                                            if ($tipoSeleccionado == $row['idTipoServicio']) {
                                                $selected = 'selected';
                                            }

                                            echo "
    <option value='{$row['idTipoServicio']}' $selected>
        {$row['nombre']}
    </option>
    ";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Servicio</label>
                                <div class="mb-3">
                                    <? $idServicioSeleccionado = $_POST['idServicio'] ?? ''; ?>
                                    <select
                                        class="form-control"
                                        name="idServicio">

                                        <option value="">
                                            Seleccione un servicio
                                        </option>

                                        <?php

                                        if (!empty($_POST['tiposervicio'])) {

                                            $idTipoServicio = $_POST['tiposervicio'];

                                            $sqlServicios = "SELECT *
    FROM servicio
    WHERE idTipoServicio = $idTipoServicio
    ";

                                            $resultadoServicios = mysqli_query(
                                                $conexion,
                                                $sqlServicios
                                            );

                                            while ($row = mysqli_fetch_assoc($resultadoServicios)) {

                                                $selected = ($idServicioSeleccionado == $row['idServicio'])
                                                    ? "selected"
                                                    : "";

                                                echo "
    <option value='{$row['idServicio']}' $selected>
        {$row['nombre']}
    </option>";
                                            }
                                        }

                                        ?>

                                    </select>
                                </div>

                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary btn-lg w-100" type="submit"
                                    formaction="../../controlador/gestionarreportes/cotizar.php" 
                                    target="_blank"
                                    class="btn btn-primary btn-lg shadow-sm">
                                    cotizar servicio
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-light text-center text-lg-start mt-auto">
        <?php include(__DIR__ . "/marcadores/footer.php"); ?>
    </footer>
</body>

</html>