<?php
include("../conexion.php");
$sql = "SELECT m.nombre_materia, r.periodo, r.estudiantes_inscritos, r.estudiantes_aprobados, r.estudiantes_reprobados FROM rendimiento_academico r INNER JOIN materias m ON r.id_materia = m.id_materia ORDER BY r.periodo, m.nombre_materia";
$resultado = $conexion->query($sql);
$datos = [];
while($fila = $resultado->fetch_assoc())
{
    $datos[] = $fila;
}
header("Content-Type: application/json");
echo json_encode($datos);
?>
