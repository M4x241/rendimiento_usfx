<?php

session_start();

if(!isset($_SESSION["id_usuario"]))
{
    header("Location:index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Académico</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../css/dashboard.css">

</head>

<body>

<div class="d-flex">

    <div class="sidebar">

        <h2>USFX</h2>

        <hr>

        <h5>
            <?php echo $_SESSION["nombre"]; ?>
        </h5>

        <br>


        <a href="logout.php">Cerrar Sesión</a>

    </div>

    <div class="contenido">

        <h2 class="mb-4">
            Dashboard Académico Inteligente
        </h2>

        <div class="row mb-4">

            <div class="col-md-3">

                <div class="card card-dashboard">

                    <h5>Total Estudiantes</h5>

                    <h2 id="total_estudiantes">0</h2>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card card-dashboard">

                    <h5>Aprobados</h5>

                    <h2 id="aprobados">0</h2>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card card-dashboard">

                    <h5>Reprobados</h5>

                    <h2 id="reprobados">0</h2>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card card-dashboard">

                    <h5>% Aprobación</h5>

                    <h2 id="porcentaje">0%</h2>

                </div>

            </div>

        </div>

        <div class="card shadow p-4">

            <h4 class="mb-4">

                Rendimiento Académico

            </h4>

            <div id="grafico">

            </div>

        </div>

    </div>

</div>

<script src="../js/dashboard.js"></script>

</body>

</html>