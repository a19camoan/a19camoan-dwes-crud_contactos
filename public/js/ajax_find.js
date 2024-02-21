{
    function actualizarTabla(contactos) {
        const tbody = document.querySelector("tbody");
        tbody.innerHTML = ""; // Limpiar la tabla antes de actualizarla

        contactos.forEach(contacto => {
            const fila = document.createElement("tr");
            fila.innerHTML = `
                <td>${contacto.nombre}</td>
                <td>${contacto.telefono}</td>
                <td>${contacto.email}</td>
            `;
            tbody.appendChild(fila);
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        const input = document.querySelector("#nombre");

        input.addEventListener("keyup", () => {
            const nombre = input.value;

            if (nombre.length > 1) {
                const xmlhttp = new XMLHttpRequest();
                xmlhttp.onload = () => {
                    if (xmlhttp.status === 200) {
                        const response = JSON.parse(xmlhttp.responseText);
                        actualizarTabla(response);
                    } else {
                        console.error('Hubo un error en la solicitud.');
                    }
                };
                xmlhttp.open("GET", `/find/${nombre}`);
                xmlhttp.send();
            };
        });
    });
}
