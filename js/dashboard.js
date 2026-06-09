cargarEstadisticas();
cargarGrafico();

function cargarEstadisticas()
{
    fetch("../paso2/obtener_estadisticas.php")
    .then(respuesta => respuesta.json())
    .then(datos =>
    {
        document.getElementById("total_estudiantes").innerHTML =
        datos.total;

        document.getElementById("aprobados").innerHTML =
        datos.aprobados;

        document.getElementById("reprobados").innerHTML =
        datos.reprobados;

        let porcentaje =
        ((datos.aprobados / datos.total) * 100).toFixed(2);

        document.getElementById("porcentaje").innerHTML =
        porcentaje + "%";
    })
    .catch(error =>
    {
        console.log(error);
    });
}

function cargarGrafico()
{
    fetch("../paso2/obtener_grafico.php")
    .then(respuesta => respuesta.json())
    .then(datos =>
    {
        let html = "";

        datos.forEach(fila =>
        {
            html += `
            <div class="mb-3">
                <strong>${fila.nombre_materia}</strong>

                <div
                class="barra"
                style="width:${fila.estudiantes_aprobados * 4}px">
                ${fila.estudiantes_aprobados}
                </div>

            </div>
            `;
        });

        document.getElementById("grafico").innerHTML =
        html;
    })
    .catch(error =>
    {
        console.log(error);
    });
}