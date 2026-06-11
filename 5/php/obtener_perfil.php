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
$sql = "SELECT id_usuario, nombre, correo, carrera, semestre, descripcion, foto, rol FROM usuarios WHERE id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
if ($resultado->num_rows == 1) {
    echo json_encode([
        'estado' => 'ok',
        'usuario' => $resultado->fetch_assoc()
    ]);
} else {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'Usuario no encontrado'
    ]);
}
?>
