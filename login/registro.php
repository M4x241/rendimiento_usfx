<?php

include("conexion.php");

if(isset($_POST["registrar"]))
{
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    $sql = "
    INSERT INTO usuarios
    (
        nombre,
        correo,
        password
    )
    VALUES
    (
        '$nombre',
        '$correo',
        '$password'
    )
    ";

    if($conexion->query($sql))
    {
        echo "<script>
        alert('Usuario registrado correctamente');
        window.location='index.php';
        </script>";
    }
}

?>

<!DOCTYPE html>

<html>
<head>

<title>Registro</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-success text-white">
<h3>Registro de Usuario</h3>
</div>

<div class="card-body">

<form method="POST">

<input
type="text"
name="nombre"
class="form-control mb-3"
placeholder="Nombre Completo"
required

>

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
name="registrar"
class="btn btn-success w-100"

>

Registrarse </button>

</form>

<br>

    <a href="index.php" class="btn btn-secondary w-100">
    Volver al Login
    </a>

    <br><br>

    <a href="../index.html" class="btn btn-outline-primary w-100">
    Página Principal
    </a>

</div>

</div>

</div>

</div>

</div>

</body>
</html>
