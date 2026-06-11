<?php
session_start();
include("../conexion.php");
if(isset($_POST["ingresar"]))
{
    $correo = $_POST["correo"];
    $password = md5($_POST["password"]);
    $sql = "SELECT * FROM usuarios WHERE correo='$correo' AND password='$password'";
    $resultado = $conexion->query($sql);
    if($resultado->num_rows > 0)
    {
        $usuario = $resultado->fetch_assoc();
        $_SESSION["id_usuario"] = $usuario["id_usuario"];
        $_SESSION["nombre"] = $usuario["nombre"];
        $_SESSION["rol"] = $usuario["rol"];
        header("Location: dashboard.php");
        exit();
    }
    else
    {
        $error = "Correo o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
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
.login-card{
    background:white;
    padding:40px;
    border-radius:20px;
    max-width:450px;
    width:100%;
    box-shadow:0px 10px 30px rgba(0,0,0,0.2);
}
.login-card h3{
    text-align:center;
    color:#0d6efd;
    margin-bottom:25px;
}
</style>
</head>
<body>
<div class="login-card">
    <h3>Inicio de Sesion</h3>
    <?php if(isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="email" name="correo" class="form-control mb-3" placeholder="Correo" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Contraseña" required>
        <button type="submit" name="ingresar" class="btn btn-primary w-100">Ingresar</button>
    </form>
    <br>
    <a href="registro.php" class="btn btn-success w-100">Crear Cuenta</a>
    <br><br>
    <a href="../3)Ayudantes/index.html" class="btn btn-outline-secondary w-100">Ver Ayudantes</a>
    <br><br>
    <a href="../index.html" class="btn btn-outline-primary w-100">Pagina Principal</a>
</div>
</body>
</html>
