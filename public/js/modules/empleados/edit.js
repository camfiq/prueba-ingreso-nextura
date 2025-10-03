const urlCreateEmpleado = "/public/empleado.php?action=";

const validarFormulario = () => {
    let valido = true;
    let mensajes = [];


    const nombre = document.getElementById("nombre").value.trim();
    if (nombre === "" || !/^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$/.test(nombre)) {
        valido = false;
        mensajes.push("El nombre es obligatorio y solo puede contener letras.");
    }

    const email = document.getElementById("email").value.trim();
    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "" || !regexEmail.test(email)) {
        valido = false;
        mensajes.push("Debe ingresar un correo válido.");
    }

    // Validar sexo
    const sexo = document.querySelector('input[name="sexo"]:checked');
    if (!sexo) {
        valido = false;
        mensajes.push("Debe seleccionar un sexo.");
    }

    // Validar área
    const area = document.getElementById("area").value;
    if (area === "") {
        valido = false;
        mensajes.push("Debe seleccionar un área.");
    }

    const descripcion = document.getElementById("descripcion").value.trim();
    if (descripcion === "") {
        valido = false;
        mensajes.push("La descripción es obligatoria.");
    }

    const roles = document.querySelectorAll('input[name="roles[]"]:checked');
    if (roles.length === 0) {
        valido = false;
        mensajes.push("Debe seleccionar al menos un rol.");
    }

    return {
        valido, mensajes
    }

}

const enviarFormulario = async (form) => {
    const formData = new FormData(form);
    const params = new URLSearchParams();

    for (const [key, value] of formData.entries()) {
        params.append(key, value);
    }

    const respuesta = await fetch(`${urlCreateEmpleado}update`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: params.toString()
    });

    const json = await respuesta.json();

    if (!json.resultado) {
        mostrarToast(json.error, 'error');
        document.getElementById("btnGuardar").disabled = false;

    } else {
        mostrarToast('Empleado modificado exitosamente, serás redireccionado en 3 segundos', 'success');
        setTimeout(() => {
            location.href = "/public/empleado.php";
        }, 3000);
    }
}


document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formularioEmpleado");

    form.addEventListener("submit", function (e) {

        e.preventDefault();
        document.getElementById("btnGuardar").disabled = true;

        const validacion = validarFormulario();

        if (!validacion.valido) {
            mostrarToast(validacion.mensajes.join("<br>"), 'error');
            document.getElementById("btnGuardar").disabled = false;
            return;
        } else {
            enviarFormulario(form);

        }






    });


});
