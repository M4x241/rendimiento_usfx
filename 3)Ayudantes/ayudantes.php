<?php

include("conexion.php");

$carrera = $_GET["carrera"] ?? "";
$semestre = $_GET["semestre"] ?? "";
$materia = $_GET["materia"] ?? "";

$sql = "
SELECT *
FROM ayudantes
WHERE carrera LIKE '%$carrera%'
AND materia LIKE '%$materia%'
";

if($semestre != "")
{
    $sql .= " AND semestre = $semestre";
}

$resultado = mysqli_query($conexion,$sql);

echo "<table>";

echo "<tr>";
echo "<th>Nombre</th>";
echo "<th>Carrera</th>";
echo "<th>Semestre</th>";
echo "<th>Materia</th>";
echo "<th>Correo</th>";
echo "<th>Perfil</th>";
echo "</tr>";

while($fila = mysqli_fetch_assoc($resultado))
{
    echo "<tr>";

    echo "<td>".$fila["nombre"]."</td>";
    echo "<td>".$fila["carrera"]."</td>";
    echo "<td>".$fila["semestre"]."</td>";
    echo "<td>".$fila["materia"]."</td>";
    echo "<td>".$fila["correo"]."</td>";

    echo "<td>";
    echo "<button>Ver Perfil</button>";
    echo "</td>";

    echo "</tr>";
}

echo "</table>";

?>