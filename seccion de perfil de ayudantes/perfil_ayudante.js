var parametros = new URLSearchParams(window.location.search);
var idAyudante = parametros.get("id");
if(!idAyudante)
{
    document.getElementById("contenidoPerfil").innerHTML = "<p>Error: No se especifico un ayudante.</p>";
}
else
{
    cargarPerfilAyudante();
}

function cargarPerfilAyudante()
{
    fetch("perfil_ayudante.php?id=" + idAyudante)
    .then(function(respuesta) { return respuesta.json(); })
    .then(function(datos) { mostrarPerfil(datos); })
    .catch(function(error) {
        console.log("Error: " + error);
        document.getElementById("contenidoPerfil").innerHTML = "<p>Error al cargar el perfil.</p>";
    });
}

function mostrarPerfil(datos)
{
    var html = "";
    html += "<a href='../3)Ayudantes/index.html' class='btn btn-secondary mb-3'>Volver a Ayudantes</a>";
    html += "<div class='perfilAyudante'>";
    html += "<div class='infoGeneral'>";
    html += "<h2>" + datos.nombre + "</h2>";
    html += "<div class='detalles'>";
    html += "<p><strong>Carrera:</strong> " + datos.carrera + "</p>";
    html += "<p><strong>Semestre:</strong> " + datos.semestre + "</p>";
    html += "<p><strong>Materia:</strong> " + datos.materia + "</p>";
    html += "<p><strong>Correo:</strong> " + datos.correo + "</p>";
    html += "<p><strong>Telefono:</strong> " + datos.telefono + "</p>";
    html += "<p><strong>Descripcion:</strong> " + datos.descripcion + "</p>";
    html += "<p><strong>Horarios de Atencion:</strong> " + datos.horario + "</p>";
    html += "</div></div><hr>";
    html += "<div class='seccionComentarios'>";
    html += "<h3>Comentarios de Estudiantes</h3>";
    if(datos.comentarios.length > 0)
    {
        html += "<div class='listaComentarios'>";
        for(var i = 0; i < datos.comentarios.length; i++)
        {
            var comentario = datos.comentarios[i];
            html += "<div class='comentario'>";
            html += "<div class='encabezadoComentario'>";
            html += "<strong>" + comentario.nombre_estudiante + "</strong> - ";
            html += "<span class='calificacion'>";
            for(var j = 0; j < comentario.calificacion; j++) { html += "*"; }
            for(var j = comentario.calificacion; j < 5; j++) { html += " "; }
            html += "</span></div>";
            html += "<p class='textoComentario'>" + comentario.comentario + "</p>";
            html += "<small class='fechaComentario'>" + comentario.fecha_comentario + "</small>";
            html += "</div>";
        }
        html += "</div>";
    }
    else
    {
        html += "<p>No hay comentarios aun.</p>";
    }
    html += "<div class='formularioComentario'>";
    html += "<h4>Dejar un Comentario</h4>";
    html += "<form id='formComentario'>";
    html += "<div><label for='nombreEstudiante'>Tu Nombre:</label><input type='text' id='nombreEstudiante' required></div>";
    html += "<div><label for='emailEstudiante'>Tu Correo:</label><input type='email' id='emailEstudiante' required></div>";
    html += "<div><label for='calificacionComentario'>Calificacion:</label><select id='calificacionComentario' required>";
    html += "<option value=''>Selecciona una calificacion</option>";
    html += "<option value='1'>1 / 5</option>";
    html += "<option value='2'>2 / 5</option>";
    html += "<option value='3'>3 / 5</option>";
    html += "<option value='4'>4 / 5</option>";
    html += "<option value='5'>5 / 5</option>";
    html += "</select></div>";
    html += "<div><label for='textoComentario'>Comentario:</label><textarea id='textoComentario' rows='5' required></textarea></div>";
    html += "<button type='button' id='btnEnviarComentario'>Enviar Comentario</button>";
    html += "</form></div></div>";
    document.getElementById("contenidoPerfil").innerHTML = html;
    document.getElementById("btnEnviarComentario").addEventListener("click", enviarComentario);
}

function enviarComentario()
{
    var nombreEstudiante = document.getElementById("nombreEstudiante").value;
    var emailEstudiante = document.getElementById("emailEstudiante").value;
    var calificacion = document.getElementById("calificacionComentario").value;
    var textoComentario = document.getElementById("textoComentario").value;
    if(!nombreEstudiante || !emailEstudiante || !calificacion || !textoComentario)
    {
        alert("Por favor completa todos los campos");
        return;
    }
    fetch("perfil_ayudante.php?accion=agregarComentario", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "id_ayudante=" + idAyudante + "&nombre_estudiante=" + encodeURIComponent(nombreEstudiante) + "&email_estudiante=" + encodeURIComponent(emailEstudiante) + "&calificacion=" + calificacion + "&comentario=" + encodeURIComponent(textoComentario)
    })
    .then(function(respuesta) { return respuesta.json(); })
    .then(function(datos) {
        if(datos.exito) {
            alert("Comentario enviado correctamente");
            document.getElementById("formComentario").reset();
            cargarPerfilAyudante();
        }
        else { alert("Error: " + datos.mensaje); }
    })
    .catch(function(error) {
        console.log("Error: " + error);
        alert("Error al enviar el comentario");
    });
}
