document.addEventListener("DOMContentLoaded", function()
{
    cargarSeccion("dashboard");
    document.querySelectorAll(".menu-item[data-seccion]").forEach(function(btn)
    {
        btn.addEventListener("click", function()
        {
            cargarSeccion(this.getAttribute("data-seccion"));
        });
    });
});

function cargarSeccion(seccion, extra)
{
    var url = "cargar_seccion.php?seccion=" + seccion;
    if(extra) url += "&" + extra;
    document.querySelectorAll(".menu-item[data-seccion]").forEach(function(b)
    {
        b.classList.toggle("activo", b.getAttribute("data-seccion") == seccion);
    });
    document.getElementById("contenidoDinamico").innerHTML =
        '<div class="loading"><div class="spinner"></div><p>Cargando...</p></div>';
    fetch(url)
    .then(function(r) { return r.text(); })
    .then(function(html)
    {
        document.getElementById("contenidoDinamico").innerHTML = html;
        initSeccion(seccion, extra);
    })
    .catch(function(err)
    {
        document.getElementById("contenidoDinamico").innerHTML =
            '<div class="alert alert-danger">Error al cargar la seccion</div>';
    });
}

function initSeccion(seccion, extra)
{
    if(seccion == "dashboard")
    {
        cargarEstadisticas();
        cargarGrafico();
    }
    else if(seccion == "ayudantes")
    {
        document.getElementById("btnBuscarAyudantes").addEventListener("click", buscarAyudantes);
        buscarAyudantes();
    }
    else if(seccion == "perfil_ayudante")
    {
        document.getElementById("btnEnviarComentario").addEventListener("click", function() {
            var params = new URLSearchParams(extra);
            var id = params.get("id");
            var datos = new URLSearchParams();
            datos.append("id_ayudante", id);
            datos.append("nombre_estudiante", document.getElementById("nombreEstudiante").value);
            datos.append("email_estudiante", document.getElementById("emailEstudiante").value);
            datos.append("calificacion", document.getElementById("calificacionComentario").value);
            datos.append("comentario", document.getElementById("textoComentario").value);
            fetch("../seccion de perfil de ayudantes/perfil_ayudante.php?accion=agregarComentario", {
                method: "POST",
                headers: {"Content-Type": "application/x-www-form-urlencoded"},
                body: datos.toString()
            })
            .then(function(r) { return r.json(); })
            .then(function(d) {
                if(d.exito) { alert("Comentario enviado"); cargarPerfilAyudante(id); }
                else alert("Error: " + d.mensaje);
            });
        });
    }
    else if(seccion == "mi_perfil")
    {
        document.getElementById("formPerfil").addEventListener("submit", function(e) {
            e.preventDefault();
            var f = new FormData();
            f.append("nombre", document.getElementById("nombre").value);
            f.append("correo", document.getElementById("correo").value);
            f.append("carrera", document.getElementById("carrera_u").value);
            f.append("semestre", document.getElementById("semestre_u").value);
            f.append("descripcion", document.getElementById("descripcion").value);
            fetch("perfil_api.php?accion=actualizar", { method:"POST", body:f })
            .then(function(r) { return r.json(); })
            .then(function(d) {
                mostrarMensajePerfil(d.estado, d.mensaje);
                if(d.estado == "ok") {
                    document.getElementById("vistaNombre").textContent = document.getElementById("nombre").value;
                    document.getElementById("vistaCorreo").textContent = document.getElementById("correo").value;
                }
            });
        });
        document.getElementById("formPassword").addEventListener("submit", function(e) {
            e.preventDefault();
            var f = new FormData(this);
            fetch("perfil_api.php?accion=password", { method:"POST", body:f })
            .then(function(r) { return r.json(); })
            .then(function(d) {
                mostrarMensajePerfil(d.estado, d.mensaje);
                if(d.estado == "ok") document.getElementById("formPassword").reset();
            });
        });
    }
}

function mostrarMensajePerfil(estado, texto) {
    var msg = document.getElementById("mensajePerfil");
    msg.classList.remove("d-none", "alert-success", "alert-danger");
    msg.classList.add(estado == "ok" ? "alert-success" : "alert-danger");
    msg.textContent = texto;
    setTimeout(function() { msg.classList.add("d-none"); }, 3500);
}

function cargarPerfilAyudante(id)
{
    cargarSeccion("perfil_ayudante", "id=" + id);
}

function buscarAyudantes()
{
    var carrera = document.getElementById("carrera").value;
    var semestre = document.getElementById("semestre").value;
    var materia = document.getElementById("materia").value;
    fetch("../3)Ayudantes/ayudantes.php?carrera=" + carrera + "&semestre=" + semestre + "&materia=" + materia)
    .then(function(r) { return r.text(); })
    .then(function(d) {
        document.getElementById("resultadoAyudantes").innerHTML = d;
        document.querySelectorAll("#resultadoAyudantes .ver-perfil").forEach(function(a) {
            a.onclick = function(e) {
                e.preventDefault();
                cargarPerfilAyudante(this.getAttribute("data-id"));
            };
        });
    });
}

function cargarEstadisticas()
{
    fetch("../paso2/obtener_estadisticas.php")
    .then(function(r) { return r.json(); })
    .then(function(d)
    {
        document.getElementById("total_estudiantes").innerHTML = d.total;
        document.getElementById("aprobados").innerHTML = d.aprobados;
        document.getElementById("reprobados").innerHTML = d.reprobados;
        var pct = ((d.aprobados / d.total) * 100).toFixed(2);
        document.getElementById("porcentaje").innerHTML = pct + "%";
    })
    .catch(function(e) { console.log(e); });
}

function cargarGrafico()
{
    fetch("../paso2/obtener_grafico.php")
    .then(function(r) { return r.json(); })
    .then(function(datos)
    {
        var html = '<div class="grafico-barras">';
        var maxVal = 0;
        datos.forEach(function(f)
        {
            if(f.estudiantes_inscritos > maxVal) maxVal = f.estudiantes_inscritos;
        });
        datos.forEach(function(f)
        {
            var pctAprob = (f.estudiantes_aprobados / maxVal) * 100;
            var pctReprob = (f.estudiantes_reprobados / maxVal) * 100;
            html +=
            '<div class="barra-item">' +
                '<div class="barra-label">' +
                    '<span class="materia-nombre">' + f.nombre_materia + '</span>' +
                    '<span class="materia-periodo">' + f.periodo + '</span>' +
                '</div>' +
                '<div class="barra-contenedor">' +
                    '<div class="barra barra-aprobados" style="width:' + pctAprob + '%">' +
                        '<span class="barra-texto">' + f.estudiantes_aprobados + '</span>' +
                    '</div>' +
                    '<div class="barra barra-reprobados" style="width:' + pctReprob + '%">' +
                        '<span class="barra-texto">' + f.estudiantes_reprobados + '</span>' +
                    '</div>' +
                '</div>' +
            '</div>';
        });
        html += '</div>';
        document.getElementById("grafico").innerHTML = html;
    })
    .catch(function(e) { console.log(e); });
}
