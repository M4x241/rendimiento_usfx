<?php
$host = 'localhost';
$usuario = 'root';
$password = '';
$base_datos = 'bd_rendimiento_usfx';

$conexion = new mysqli($host, $usuario, $password, $base_datos);

if ($conexion->connect_error) {
    die(json_encode([
        'estado' => 'error',
        'mensaje' => 'Error de conexión a MySQL'
    ]));
}

$conexion->set_charset('utf8mb4');
?>
