// tarifa.js

document.addEventListener('DOMContentLoaded', () => {
    const modalCrearTarifa = document.getElementById('modalCrearTarifa');
    const modalEditarTarifa = document.getElementById('modalEditarTarifa');
    const closeCrearTarifa = document.getElementById('closeCrearTarifa');
    const closeEditarTarifa = document.getElementById('closeEditarTarifa');
    const cancelCrearTarifa = document.getElementById('cancelCrearTarifa');
    const cancelEditarTarifa = document.getElementById('cancelEditarTarifa');
    const btnAddTarifa = document.getElementById('btnAddTarifa');
    const addTarifaForm = document.getElementById('addTarifaForm');
    const editTarifaForm = document.getElementById('editTarifaForm');
    let editTarifaId = null;

    btnAddTarifa.addEventListener('click', () => {
        modalCrearTarifa.style.display = 'block';
    });

    closeCrearTarifa.addEventListener('click', () => {
        modalCrearTarifa.style.display = 'none';
    });

    closeEditarTarifa.addEventListener('click', () => {
        modalEditarTarifa.style.display = 'none';
    });

    cancelCrearTarifa.addEventListener('click', () => {
        modalCrearTarifa.style.display = 'none';
    });

    cancelEditarTarifa.addEventListener('click', () => {
        modalEditarTarifa.style.display = 'none';
    });

    window.onclick = (event) => {
        if (event.target == modalCrearTarifa) {
            modalCrearTarifa.style.display = 'none';
        }
        if (event.target == modalEditarTarifa) {
            modalEditarTarifa.style.display = 'none';
        }
    };

    addTarifaForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const tipoActivo = event.target.tipoActivo.value;
        const monto = event.target.monto.value;
        const moneda = event.target.moneda.value;
        addTarifa(tipoActivo, monto, moneda);
        modalCrearTarifa.style.display = 'none';
    });

    editTarifaForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const tipoActivo = event.target.tipoActivo.value;
        const monto = event.target.monto.value;
        const moneda = event.target.moneda.value;
        updateTarifa(editTarifaId, tipoActivo, monto, moneda);
        modalEditarTarifa.style.display = 'none';
    });

    document.querySelectorAll('.btnEditTarifa').forEach(button => {
        button.addEventListener('click', (event) => {
            const row = event.target.closest('tr');
            const id = row.cells[0].textContent;
            const tipoActivo = row.cells[1].textContent;
            const monto = row.cells[2].textContent;
            const moneda = row.cells[3].textContent;
            editTarifaId = id;
            document.getElementById('editTipoActivo').value = tipoActivo;
            document.getElementById('editMonto').value = monto;
            document.getElementById('editMoneda').value = moneda;
            modalEditarTarifa.style.display = 'block';
        });
    });
});

function addTarifa(tipoActivo, monto, moneda) {
    const tableBody = document.getElementById('tarifaTableBody');
    const newRow = tableBody.insertRow();
    const idCell = newRow.insertCell(0);
    const tipoActivoCell = newRow.insertCell(1);
    const montoCell = newRow.insertCell(2);
    const monedaCell = newRow.insertCell(3);
    const actionsCell = newRow.insertCell(4);

    idCell.textContent = tableBody.rows.length;
    tipoActivoCell.textContent = tipoActivo;
    montoCell.textContent = monto;
    monedaCell.textContent = moneda;
    actionsCell.innerHTML = `
        <button class="btnEditTarifa btn">Editar</button>
        <button onclick="deleteTarifa(${tableBody.rows.length})" class="btn">Eliminar</button>
    `;

    document.querySelectorAll('.btnEditTarifa').forEach(button => {
        button.addEventListener('click', (event) => {
            const row = event.target.closest('tr');
            const id = row.cells[0].textContent;
            const tipoActivo = row.cells[1].textContent;
            const monto = row.cells[2].textContent;
            const moneda = row.cells[3].textContent;
            editTarifaId = id;
            document.getElementById('editTipoActivo').value = tipoActivo;
            document.getElementById('editMonto').value = monto;
            document.getElementById('editMoneda').value = moneda;
            modalEditarTarifa.style.display = 'block';
        });
    });
}

function updateTarifa(id, tipoActivo, monto, moneda) {
    const tableBody = document.getElementById('tarifaTableBody');
    for (let row of tableBody.rows) {
        if (row.cells[0].textContent == id) {
            row.cells[1].textContent = tipoActivo;
            row.cells[2].textContent = monto;
            row.cells[3].textContent = moneda;
            break;
        }
    }
}

function deleteTarifa(id) {
    const tableBody = document.getElementById('tarifaTableBody');
    for (let row of tableBody.rows) {
        if (row.cells[0].textContent == id) {
            tableBody.deleteRow(row.rowIndex - 1);
            break;
        }
    }
}
document.getElementById('cerrar').addEventListener('click', function () {
    window.location.href = this.getAttribute('data-href');
});
