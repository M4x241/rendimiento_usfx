<?php
session_start();
header('Content-Type: application/json');

require_once '../config/conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'No existe sesión activa'
    ]);
    exit;
}

$id_usuario = $_SESSION['usuario_id'];

$nombre = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';
$carrera = $_POST['carrera'] ?? '';
$semestre = $_POST['semestre'] ?? 0;
$descripcion = $_POST['descripcion'] ?? '';

if ($nombre == '' || $correo == '') {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'Nombre y correo son obligatorios'
    ]);
    exit;
}

$sql = "UPDATE usuarios 
        SET nombre = ?, correo = ?, carrera = ?, semestre = ?, descripcion = ?
        WHERE id_usuario = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param(
    "sssisi",
    $nombre,
    $correo,
    $carrera,
    $semestre,
    $descripcion,
    $id_usuario
);

if ($stmt->execute()) {
    $_SESSION['usuario_nombre'] = $nombre;

    echo json_encode([
        'estado' => 'ok',
        'mensaje' => 'Perfil actualizado correctamente'
    ]);
} else {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'No se pudo actualizar el perfil'
    ]);
}
?>
