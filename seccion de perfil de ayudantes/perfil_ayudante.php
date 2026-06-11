<?php
include("../conexion.php");
$accion = $_GET["accion"] ?? "";
if($accion == "agregarComentario")
{
    agregarComentario();
}
else
{
    obtenerPerfilAyudante();
}

function obtenerPerfilAyudante()
{
    global $conexion;
    $id_ayudante = $_GET["id"] ?? 0;
    $sql = "SELECT * FROM ayudantes WHERE id_ayudante = $id_ayudante";
    $resultado = mysqli_query($conexion, $sql);
    if(mysqli_num_rows($resultado) == 0)
    {
        header("Content-Type: application/json");
        echo json_encode(array("error" => "Ayudante no encontrado"));
        return;
    }
    $ayudante = mysqli_fetch_assoc($resultado);
    $sqlComentarios = "SELECT * FROM comentarios_ayudantes WHERE id_ayudante = $id_ayudante ORDER BY fecha_comentario DESC";
    $resultadoComentarios = mysqli_query($conexion, $sqlComentarios);
    $comentarios = array();
    while($comentario = mysqli_fetch_assoc($resultadoComentarios))
    {
        $comentarios[] = $comentario;
    }
    $ayudante["comentarios"] = $comentarios;
    header("Content-Type: application/json");
    echo json_encode($ayudante);
}

function agregarComentario()
{
    global $conexion;
    $id_ayudante = $_POST["id_ayudante"] ?? 0;
    $nombre_estudiante = $_POST["nombre_estudiante"] ?? "";
    $email_estudiante = $_POST["email_estudiante"] ?? "";
    $calificacion = $_POST["calificacion"] ?? 0;
    $comentario = $_POST["comentario"] ?? "";
    if(!$id_ayudante || !$nombre_estudiante || !$email_estudiante || !$calificacion || !$comentario)
    {
        header("Content-Type: application/json");
        echo json_encode(array("exito" => false, "mensaje" => "Campos requeridos faltantes"));
        return;
    }
    $nombre_estudiante = mysqli_real_escape_string($conexion, $nombre_estudiante);
    $email_estudiante = mysqli_real_escape_string($conexion, $email_estudiante);
    $comentario = mysqli_real_escape_string($conexion, $comentario);
    $sql = "INSERT INTO comentarios_ayudantes(id_ayudante, nombre_estudiante, email_estudiante, comentario, calificacion) VALUES($id_ayudante, '$nombre_estudiante', '$email_estudiante', '$comentario', $calificacion)";
    if(mysqli_query($conexion, $sql))
    {
        header("Content-Type: application/json");
        echo json_encode(array("exito" => true, "mensaje" => "Comentario agregado correctamente"));
    }
    else
    {
        header("Content-Type: application/json");
        echo json_encode(array("exito" => false, "mensaje" => "Error al agregar comentario"));
    }
}
?>
