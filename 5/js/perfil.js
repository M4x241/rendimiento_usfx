const mensaje = document.getElementById("mensaje");
const fotoVista = document.getElementById("fotoVista");
const nombreVista = document.getElementById("nombreVista");
const correoVista = document.getElementById("correoVista");
const rolVista = document.getElementById("rolVista");
const formPerfil = document.getElementById("formPerfil");
const formPassword = document.getElementById("formPassword");

document.addEventListener("DOMContentLoaded", obtenerPerfil);

function obtenerPerfil() {
    fetch("php/obtener_perfil.php")
        .then(respuesta => respuesta.json())
        .then(data => {
            if (data.estado === "ok") {
                const usuario = data.usuario;
                nombreVista.textContent = usuario.nombre;
                correoVista.textContent = usuario.correo;
                rolVista.textContent = usuario.rol;
                if (usuario.foto && usuario.foto !== "") {
                    fotoVista.src = usuario.foto;
                }
                document.getElementById("nombre").value = usuario.nombre;
                document.getElementById("correo").value = usuario.correo;
                document.getElementById("carrera").value = usuario.carrera;
                document.getElementById("semestre").value = usuario.semestre;
                document.getElementById("descripcion").value = usuario.descripcion;
            } else {
                mostrarMensaje("error", data.mensaje);
            }
        })
        .catch(error => {
            mostrarMensaje("error", "Error al obtener el perfil");
            console.log(error);
        });
}

formPerfil.addEventListener("submit", function (e) {
    e.preventDefault();
    const datos = new FormData(formPerfil);
    fetch("php/actualizar_perfil.php", {
        method: "POST",
        body: datos
    })
    .then(respuesta => respuesta.json())
    .then(data => {
        mostrarMensaje(data.estado, data.mensaje);
        if (data.estado === "ok") {
            obtenerPerfil();
        }
    })
    .catch(error => {
        mostrarMensaje("error", "Error al actualizar perfil");
        console.log(error);
    });
});

formPassword.addEventListener("submit", function (e) {
    e.preventDefault();
    const datos = new FormData(formPassword);
    fetch("php/cambiar_password.php", {
        method: "POST",
        body: datos
    })
    .then(respuesta => respuesta.json())
    .then(data => {
        mostrarMensaje(data.estado, data.mensaje);
        if (data.estado === "ok") {
            formPassword.reset();
        }
    })
    .catch(error => {
        mostrarMensaje("error", "Error al cambiar contrasena");
        console.log(error);
    });
});

function mostrarMensaje(estado, texto) {
    mensaje.classList.remove("d-none", "alert-success", "alert-danger");
    if (estado === "ok") {
        mensaje.classList.add("alert-success");
    } else {
        mensaje.classList.add("alert-danger");
    }
    mensaje.textContent = texto;
    setTimeout(() => {
        mensaje.classList.add("d-none");
    }, 3500);
}
