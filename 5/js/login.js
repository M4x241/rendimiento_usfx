const formLogin = document.getElementById("formLogin");
const mensaje = document.getElementById("mensaje");
formLogin.addEventListener("submit", function (e) {
    e.preventDefault();
    const datos = new FormData(formLogin);
    fetch("php/login.php", {
        method: "POST",
        body: datos
    })
    .then(respuesta => respuesta.json())
    .then(data => {
        mostrarMensaje(data.estado, data.mensaje);
        if (data.estado === "ok") {
            setTimeout(() => {
                window.location.href = "../login/dashboard.php";
            }, 800);
        }
    })
    .catch(error => {
        mostrarMensaje("error", "Error al conectar con el servidor");
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
}
