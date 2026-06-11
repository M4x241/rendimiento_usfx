<?php
include("../conexion.php");
$carrera = $_GET["carrera"] ?? "";
$semestre = $_GET["semestre"] ?? "";
$materia = $_GET["materia"] ?? "";
$sql = "SELECT * FROM ayudantes WHERE carrera LIKE '%$carrera%' AND materia LIKE '%$materia%'";
if($semestre != "")
{
    $sql .= " AND semestre = $semestre";
}
$resultado = mysqli_query($conexion,$sql);
echo "<table>";
echo "<tr><th>Nombre</th><th>Carrera</th><th>Semestre</th><th>Materia</th><th>Correo</th><th>Telefono</th><th>Perfil</th></tr>";
while($fila = mysqli_fetch_assoc($resultado))
{
    echo "<tr>";
    echo "<td>".$fila["nombre"]."</td>";
    echo "<td>".$fila["carrera"]."</td>";
    echo "<td>".$fila["semestre"]."</td>";
    echo "<td>".$fila["materia"]."</td>";
    echo "<td>".$fila["correo"]."</td>";
    echo "<td>".($fila["telefono"] ?? "—")."</td>";
    echo "<td>";
    echo "<a href='#' class='ver-perfil' data-id='".$fila["id_ayudante"]."'><button class='btn-ver-perfil'>Ver Perfil</button></a>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
?>
