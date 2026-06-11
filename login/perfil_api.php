<?php
session_start();
header("Content-Type: application/json");
if(!isset($_SESSION["id_usuario"]))
{
    echo json_encode(["estado" => "error", "mensaje" => "No autorizado"]);
    exit;
}
include("../conexion.php");
$id_usuario = $_SESSION["id_usuario"];
$accion = $_GET["accion"] ?? "";
if($accion == "actualizar")
{
    $nombre = $_POST["nombre"] ?? "";
    $correo = $_POST["correo"] ?? "";
    $carrera = $_POST["carrera"] ?? "";
    $semestre = $_POST["semestre"] ?? null;
    $descripcion = $_POST["descripcion"] ?? "";
    if($semestre === "" || $semestre === null) $semestre = "NULL";
    else $semestre = intval($semestre);
    $sql = "UPDATE usuarios SET nombre = '$nombre', correo = '$correo', carrera = '$carrera', semestre = $semestre, descripcion = '$descripcion' WHERE id_usuario = $id_usuario";
    if(mysqli_query($conexion, $sql))
    {
        $_SESSION["nombre"] = $nombre;
        echo json_encode(["estado" => "ok", "mensaje" => "Perfil actualizado correctamente"]);
    }
    else
    {
        echo json_encode(["estado" => "error", "mensaje" => "Error al actualizar"]);
    }
}
elseif($accion == "password")
{
    $password = $_POST["password"] ?? "";
    $confirmar = $_POST["confirmar"] ?? "";
    if($password !== $confirmar || strlen($password) < 6)
    {
        echo json_encode(["estado" => "error", "mensaje" => "Las contrasenas no coinciden o son muy cortas"]);
        exit;
    }
    $password_hash = md5($password);
    $sql = "UPDATE usuarios SET password = '$password_hash' WHERE id_usuario = $id_usuario";
    if(mysqli_query($conexion, $sql))
    {
        echo json_encode(["estado" => "ok", "mensaje" => "Contrasena actualizada correctamente"]);
    }
    else
    {
        echo json_encode(["estado" => "error", "mensaje" => "Error al actualizar contrasena"]);
    }
}
else
{
    echo json_encode(["estado" => "error", "mensaje" => "Accion no valida"]);
}
?>
