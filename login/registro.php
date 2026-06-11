<?php
include("../conexion.php");
if(isset($_POST["registrar"]))
{
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = md5($_POST["password"]);
    $sql = "INSERT INTO usuarios (nombre, correo, password, rol) VALUES ('$nombre', '$correo', '$password', 'Usuario')";
    if($conexion->query($sql))
    {
        echo "<script>alert('Usuario registrado correctamente');window.location='index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Registro</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{
    background: linear-gradient(135deg,#0d6efd,#0a58ca);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:Arial, Helvetica, sans-serif;
}
.registro-card{
    background:white;
    padding:40px;
    border-radius:20px;
    max-width:500px;
    width:100%;
    box-shadow:0px 10px 30px rgba(0,0,0,0.2);
}
.registro-card h3{text-align:center;color:#0d6efd;margin-bottom:25px}
</style>
</head>
<body>
<div class="registro-card">
<h3>Registro de Usuario</h3>
<form method="POST">
<input type="text" name="nombre" class="form-control mb-3" placeholder="Nombre Completo" required>
<input type="email" name="correo" class="form-control mb-3" placeholder="Correo" required>
<input type="password" name="password" class="form-control mb-3" placeholder="Contraseña" required>
<button type="submit" name="registrar" class="btn btn-success w-100">Registrarse</button>
</form>
<br>
<a href="index.php" class="btn btn-secondary w-100">Volver al Login</a>
<br><br>
<a href="../index.html" class="btn btn-outline-primary w-100">Pagina Principal</a>
</div>
</body>
</html>
