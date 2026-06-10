<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header('Location: perfil.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login | Dashboard Académico</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="login-body">

<div class="login-card shadow-lg">
    <div class="text-center mb-4">
        <div class="logo-circle">USFX</div>
        <h3 class="mt-3 mb-1">Dashboard Académico</h3>
        <p class="text-muted">Inicio de sesión</p>
    </div>

    <div id="mensaje" class="alert d-none"></div>

    <form id="formLogin">
        <div class="mb-3">
            <label class="form-label">Correo</label>
            <input type="email" class="form-control" name="correo" value="admin@demo.com" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" value="123456" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
    </form>

    <p class="small text-muted mt-3 mb-0 text-center">
        Usuario demo: admin@demo.com / 123456
    </p>
</div>

<script src="js/login.js"></script>
</body>
</html>
