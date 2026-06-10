<?php

session_start();

include("conexion.php");

if(isset($_POST["ingresar"]))
{
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    $sql = "
    SELECT *
    FROM usuarios
    WHERE correo='$correo'
    AND password='$password'
    ";

    $resultado = $conexion->query($sql);

    if($resultado->num_rows > 0)
    {
        $usuario = $resultado->fetch_assoc();

        $_SESSION["id_usuario"] = $usuario["id_usuario"];
        $_SESSION["nombre"] = $usuario["nombre"];

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

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet"
>

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
<h3 class="mb-0">Inicio de Sesión</h3>
<a href="../index.html" class="btn btn-sm btn-outline-light">← Inicio</a>
</div>

<div class="card-body">

<?php
if(isset($error))
{
?>
<div class="alert alert-danger">
<?php echo $error; ?>
</div>
<?php
}
?>

<form method="POST">

<input
type="email"
name="correo"
class="form-control mb-3"
placeholder="Correo"
required
>

<input
type="password"
name="password"
class="form-control mb-3"
placeholder="Contraseña"
required
>

<button
type="submit"
name="ingresar"
class="btn btn-primary w-100"
>
Ingresar
</button>

</form>

<br>

    <a href="registro.php" class="btn btn-success w-100">
    Crear Cuenta
    </a>

    <br><br>

    <a href="../3)Ayudantes/index.html" class="btn btn-outline-secondary w-100">
    Ver Ayudantes
    </a>

</div>

</div>

</div>

</div>

</div>

</body>
</html>