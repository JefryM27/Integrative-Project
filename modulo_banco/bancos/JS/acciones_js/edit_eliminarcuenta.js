document.addEventListener('DOMContentLoaded', () => {
    const cuentas = JSON.parse(localStorage.getItem('cuentas')) || [];
    const cuentasTable = document.getElementById('cuentas');

    function renderTable() {
        cuentasTable.innerHTML = ''; // Limpiar la tabla antes de volver a llenarla
        cuentas.forEach(cuenta => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${cuenta.nombre}</td>
                <td>${cuenta.numeroCuenta}</td>
                <td>${cuenta.tipoCuenta}</td>
                <td>${cuenta.saldoInicial}</td>
                <td>
                    <button class="edit-button" data-id="${cuenta.numeroCuenta}">Editar</button>
                    <button class="delete-button" data-id="${cuenta.numeroCuenta}">Eliminar</button>
                </td>
            `;
            cuentasTable.appendChild(row);
        });
    }

    function handleEditClick(event) {
        if (event.target.classList.contains('edit-button')) {
            const id = event.target.getAttribute('data-id');
            const cuenta = cuentas.find(c => c.numeroCuenta === id);
            if (cuenta) {
                // Redirige al formulario de edición con los datos
                window.location.href = `editarcuenta.php?id=${id}`;
            }
        }
    }

    function handleDeleteClick(event) {
        if (event.target.classList.contains('delete-button')) {
            const id = event.target.getAttribute('data-id');
            const index = cuentas.findIndex(c => c.numeroCuenta === id);
            if (index !== -1) {
                if (confirm('¿Estás seguro de que deseas eliminar esta cuenta?')) {
                    cuentas.splice(index, 1);
                    localStorage.setItem('cuentas', JSON.stringify(cuentas));
                    renderTable();
                }
            }
        }
    }

    // Inicializar la tabla
    renderTable();

    // Agregar los manejadores de eventos
    cuentasTable.addEventListener('click', handleEditClick);
    cuentasTable.addEventListener('click', handleDeleteClick);
});
