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
        'mensaje' => 'Las contraseñas no coinciden'
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
        'mensaje' => 'Contraseña actualizada correctamente'
    ]);
} else {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'No se pudo actualizar la contraseña'
    ]);
}
?>