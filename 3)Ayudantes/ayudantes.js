document.getElementById("btnBuscar").addEventListener("click", buscarAyudantes);

function buscarAyudantes()
{
    var carrera = document.getElementById("carrera").value;
    var semestre = document.getElementById("semestre").value;
    var materia = document.getElementById("materia").value;
    fetch("ayudantes.php?carrera=" + carrera + "&semestre=" + semestre + "&materia=" + materia)
    .then(function(respuesta) { return respuesta.text(); })
    .then(function(datos) {
        document.getElementById("resultadoAyudantes").innerHTML = datos;
        asignarEventosPerfil();
    });
}

function asignarEventosPerfil()
{
    document.querySelectorAll(".ver-perfil").forEach(function(a)
    {
        a.addEventListener("click", function(e)
        {
            e.preventDefault();
            var id = this.getAttribute("data-id");
            window.location.href = "../seccion de perfil de ayudantes/perfil_ayudante.html?id=" + id;
        });
    });
}

window.onload = function()
{
    buscarAyudantes();
};
