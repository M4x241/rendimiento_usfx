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
<title>Dashboard Academico</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <h2>USFX</h2>
        <div class="usuario"><?php echo $_SESSION["nombre"]; ?><br><small style="color:#9ca3af;font-size:11px"><?php echo $_SESSION["rol"] ?? "Usuario"; ?></small></div>
        <hr>
        <button class="menu-item activo" data-seccion="dashboard">Dashboard</button>
        <button class="menu-item" data-seccion="ayudantes">Ayudantes</button>
        <button class="menu-item" data-seccion="mi_perfil">Mi Perfil</button>
        <a href="logout.php" class="menu-item cerrar">Cerrar Sesion</a>
    </aside>
    <main class="contenido" id="contenidoDinamico">
        <div class="loading">
            <div class="spinner"></div>
            <p>Cargando...</p>
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/dashboard.js"></script>
</body>
</html>
