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

$sql = "SELECT id_usuario, nombre, correo, carrera, semestre, descripcion, foto, rol 
        FROM usuarios 
        WHERE id_usuario = ?";

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
