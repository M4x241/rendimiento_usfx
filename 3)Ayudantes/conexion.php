<?php

$conexion = mysqli_connect(
    "localhost",
    "root",
    "",
    "bd_rendimiento_usfx"
);

if(!$conexion)
{
    die("Error de conexión");
}

?>