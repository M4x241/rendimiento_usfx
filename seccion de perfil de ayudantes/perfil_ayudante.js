// Obtener el ID del ayudante desde la URL
var parametros = new URLSearchParams(window.location.search);
var idAyudante = parametros.get("id");

// Si no hay ID, mostrar mensaje de error
if(!idAyudante)
{
    document.getElementById("contenidoPerfil").innerHTML = 
        "<p>Error: No se especificó un ayudante.</p>";
}
else
{
    cargarPerfilAyudante();
}

function cargarPerfilAyudante()
{
    fetch("perfil_ayudante.php?id=" + idAyudante)
    .then(function(respuesta)
    {
        return respuesta.json();
    })
    .then(function(datos)
    {
        mostrarPerfil(datos);
    })
    .catch(function(error)
    {
        console.log("Error: " + error);
        document.getElementById("contenidoPerfil").innerHTML = 
            "<p>Error al cargar el perfil.</p>";
    });
}

function mostrarPerfil(datos)
{
    var html = "";

    html += "<div class='perfilAyudante'>";

    // Información general del ayudante
    html += "<div class='infoGeneral'>";
    html += "<h2>" + datos.nombre + "</h2>";

    html += "<div class='detalles'>";
    html += "<p><strong>Carrera:</strong> " + datos.carrera + "</p>";
    html += "<p><strong>Semestre:</strong> " + datos.semestre + "</p>";
    html += "<p><strong>Materia:</strong> " + datos.materia + "</p>";
    html += "<p><strong>Correo:</strong> " + datos.correo + "</p>";
    html += "<p><strong>Teléfono:</strong> " + datos.telefono + "</p>";
    html += "<p><strong>Descripción:</strong> " + datos.descripcion + "</p>";
    html += "<p><strong>Horarios de Atención:</strong> " + datos.horario + "</p>";
    html += "</div>";

    html += "</div>";

    html += "<hr>";

    // Sección de comentarios
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
            html += "<strong>" + comentario.nombre_estudiante + "</strong>";
            html += " - ";
            html += "<span class='calificacion'>";

            // Mostrar estrellas según calificación
            for(var j = 0; j < comentario.calificacion; j++)
            {
                html += "★";
            }
            for(var j = comentario.calificacion; j < 5; j++)
            {
                html += "☆";
            }

            html += "</span>";
            html += "</div>";

            html += "<p class='textoComentario'>" + comentario.comentario + "</p>";
            html += "<small class='fechaComentario'>" + comentario.fecha_comentario + "</small>";
            html += "</div>";
        }

        html += "</div>";
    }
    else
    {
        html += "<p>No hay comentarios aún.</p>";
    }

    // Formulario para agregar comentario
    html += "<div class='formularioComentario'>";
    html += "<h4>Dejar un Comentario</h4>";

    html += "<form id='formComentario'>";

    html += "<div>";
    html += "<label for='nombreEstudiante'>Tu Nombre:</label>";
    html += "<input type='text' id='nombreEstudiante' required>";
    html += "</div>";

    html += "<div>";
    html += "<label for='emailEstudiante'>Tu Correo:</label>";
    html += "<input type='email' id='emailEstudiante' required>";
    html += "</div>";

    html += "<div>";
    html += "<label for='calificacionComentario'>Calificación:</label>";
    html += "<select id='calificacionComentario' required>";
    html += "<option value=''>Selecciona una calificación</option>";
    html += "<option value='1'>1 ★</option>";
    html += "<option value='2'>2 ★★</option>";
    html += "<option value='3'>3 ★★★</option>";
    html += "<option value='4'>4 ★★★★</option>";
    html += "<option value='5'>5 ★★★★★</option>";
    html += "</select>";
    html += "</div>";

    html += "<div>";
    html += "<label for='textoComentario'>Comentario:</label>";
    html += "<textarea id='textoComentario' rows='5' required></textarea>";
    html += "</div>";

    html += "<button type='button' id='btnEnviarComentario'>Enviar Comentario</button>";

    html += "</form>";

    html += "</div>";

    html += "</div>";

    document.getElementById("contenidoPerfil").innerHTML = html;

    // Agregar evento al botón
    document.getElementById("btnEnviarComentario")
        .addEventListener("click", enviarComentario);
}

function enviarComentario()
{
    var nombreEstudiante = 
        document.getElementById("nombreEstudiante").value;
    var emailEstudiante = 
        document.getElementById("emailEstudiante").value;
    var calificacion = 
        document.getElementById("calificacionComentario").value;
    var textoComentario = 
        document.getElementById("textoComentario").value;

    if(!nombreEstudiante || !emailEstudiante || !calificacion || !textoComentario)
    {
        alert("Por favor completa todos los campos");
        return;
    }

    // Enviar datos al servidor
    fetch("perfil_ayudante.php?accion=agregarComentario", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id_ayudante=" + idAyudante + 
              "&nombre_estudiante=" + encodeURIComponent(nombreEstudiante) + 
              "&email_estudiante=" + encodeURIComponent(emailEstudiante) + 
              "&calificacion=" + calificacion + 
              "&comentario=" + encodeURIComponent(textoComentario)
    })
    .then(function(respuesta)
    {
        return respuesta.json();
    })
    .then(function(datos)
    {
        if(datos.exito)
        {
            alert("Comentario enviado correctamente");
            // Limpiar formulario
            document.getElementById("formComentario").reset();
            // Recargar perfil
            cargarPerfilAyudante();
        }
        else
        {
            alert("Error: " + datos.mensaje);
        }
    })
    .catch(function(error)
    {
        console.log("Error: " + error);
        alert("Error al enviar el comentario");
    });
}