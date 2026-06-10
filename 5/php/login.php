<?php
session_start();
header('Content-Type: application/json');

require_once '../config/conexion.php';

$correo = $_POST['correo'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "SELECT * FROM usuarios WHERE correo = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows == 1) {
    $usuario = $resultado->fetch_assoc();

    if (md5($password) == $usuario['password']) {
        $_SESSION['usuario_id'] = $usuario['id_usuario'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];

        echo json_encode([
            'estado' => 'ok',
            'mensaje' => 'Inicio correcto'
        ]);
    } else {
        echo json_encode([
            'estado' => 'error',
            'mensaje' => 'Contraseña incorrecta'
        ]);
    }
} else {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'Correo no registrado'
    ]);
}
?>