<?php

include("../login/conexion.php");

$sql = "
SELECT
m.nombre_materia,
r.estudiantes_aprobados
FROM rendimiento_academico r
INNER JOIN materias m
ON r.id_materia = m.id_materia
";

$resultado = $conexion->query($sql);

$datos = [];

while($fila = $resultado->fetch_assoc())
{
    $datos[] = $fila;
}

header("Content-Type: application/json");

echo json_encode($datos);

?>