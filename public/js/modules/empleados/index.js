
const urlEliminarEmpleado = "/public/empleado.php?action=";

const asociarEventosBTN = () => {

    const btnEliminarEmpleados = document.querySelectorAll('.btn-eliminar-empleado');

    if (!btnEliminarEmpleados) return;

    btnEliminarEmpleados.forEach((boton) => {
        boton.addEventListener('click', () => {
            eliminarEmpleado(boton.dataset.id)
        })
    })

}

const eliminarEmpleado = async (idEmpleado) => {

    if (!confirm('¿En serio deseas eliminar el empleado?')) return;


    const respuesta = await fetch(`${urlEliminarEmpleado}delete`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `idEmpleado=${encodeURIComponent(idEmpleado)}`
    });

    const json = await respuesta.json();

    if (!json.resultado) {
        mostrarToast(json.error, 'error');
    }

    mostrarToast(json.error, 'success');
    document.querySelector(`#row-empleado-${idEmpleado}`).remove();


}

document.addEventListener('DOMContentLoaded', function () {
    asociarEventosBTN();
});

