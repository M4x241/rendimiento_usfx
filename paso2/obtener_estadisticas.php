<?php
include("../conexion.php");
$sql = "SELECT SUM(estudiantes_inscritos) AS total, SUM(estudiantes_aprobados) AS aprobados, SUM(estudiantes_reprobados) AS reprobados FROM rendimiento_academico";
$resultado = $conexion->query($sql);
$datos = $resultado->fetch_assoc();
header("Content-Type: application/json");
echo json_encode($datos);
?>
