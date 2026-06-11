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
$password = $_POST['password'] ?? '';
$confirmar = $_POST['confirmar'] ?? '';
if ($password == '' || $confirmar == '') {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'Complete ambos campos'
    ]);
    exit;
}
if ($password !== $confirmar) {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'Las contrasenas no coinciden'
    ]);
    exit;
}
$password_hash = md5($password);
$sql = "UPDATE usuarios SET password = ? WHERE id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("si", $password_hash, $id_usuario);
if ($stmt->execute()) {
    echo json_encode([
        'estado' => 'ok',
        'mensaje' => 'Contrasena actualizada correctamente'
    ]);
} else {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'No se pudo actualizar la contrasena'
    ]);
}
?>
