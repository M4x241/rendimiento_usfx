<?php

$conexion = new mysqli(
    "localhost",
    "root",
    "",
    "rendimiento_usfx"
);

if($conexion->connect_error)
{
    die("Error de conexión: " . $conexion->connect_error);
}

?>