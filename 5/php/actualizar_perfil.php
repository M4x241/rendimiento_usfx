<?php
session_start();
header('Content-Type: application/json');
require_once '../../conexion.php';
if (!isset($_SESSION['usuario_id']) && !isset($_SESSION['id_usuario'])) {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'No existe sesion activa'
    ]);
    exit;
}
if (!isset($_SESSION['usuario_id']) && isset($_SESSION['id_usuario'])) {
    $_SESSION['usuario_id'] = $_SESSION['id_usuario'];
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
$sql = "UPDATE usuarios SET nombre = ?, correo = ?, carrera = ?, semestre = ?, descripcion = ? WHERE id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssisi", $nombre, $correo, $carrera, $semestre, $descripcion, $id_usuario);
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
