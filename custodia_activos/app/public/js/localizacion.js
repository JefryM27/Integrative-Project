document.addEventListener('DOMContentLoaded', () => {
    const modalCrear = document.getElementById('modalCrear');
    const modalEditar = document.getElementById('modalEditar');
    const closeCrear = document.getElementById('closeCrear');
    const closeEditar = document.getElementById('closeEditar');
    const cancelCrear = document.getElementById('cancelCrear');
    const cancelEditar = document.getElementById('cancelEditar');
    const btnAddLocalization = document.getElementById('btnAddLocalization');
    const addLocalizationForm = document.getElementById('addLocalizationForm');
    const editLocalizationForm = document.getElementById('editLocalizationForm');
    let editId = null;

    btnAddLocalization.addEventListener('click', () => {
        modalCrear.style.display = 'block';
    });

    closeCrear.addEventListener('click', () => {
        modalCrear.style.display = 'none';
    });

    closeEditar.addEventListener('click', () => {
        modalEditar.style.display = 'none';
    });

    cancelCrear.addEventListener('click', () => {
        modalCrear.style.display = 'none';
    });

    cancelEditar.addEventListener('click', () => {
        modalEditar.style.display = 'none';
    });

    window.onclick = (event) => {
        if (event.target == modalCrear) {
            modalCrear.style.display = 'none';
        }
        if (event.target == modalEditar) {
            modalEditar.style.display = 'none';
        }
    };

    addLocalizationForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const expediente = event.target.expediente.value;
        const sucursal = event.target.sucursal.value;
        const archivo = event.target.archivo.value;
        const boveda = event.target.boveda.value;
        addLocalization(expediente, sucursal, archivo, boveda);
        modalCrear.style.display = 'none';
    });

    editLocalizationForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const expediente = event.target.expediente.value;
        const sucursal = event.target.sucursal.value;
        const archivo = event.target.archivo.value;
        const boveda = event.target.boveda.value;
        updateLocalization(editId, expediente, sucursal, archivo, boveda);
        modalEditar.style.display = 'none';
    });

    document.querySelectorAll('.btnEditLocalization').forEach(button => {
        button.addEventListener('click', (event) => {
            const row = event.target.closest('tr');
            const id = row.cells[0].textContent;
            const expediente = row.cells[1].textContent;
            const sucursal = row.cells[2].textContent;
            const archivo = row.cells[3].textContent;
            const boveda = row.cells[4].textContent;
            editId = id;
            document.getElementById('editExpediente').value = expediente;
            document.getElementById('editSucursal').value = sucursal;
            document.getElementById('editArchivo').value = archivo;
            document.getElementById('editBoveda').value = boveda;
            modalEditar.style.display = 'block';
        });
    });
});

function addLocalization(expediente, sucursal, archivo, boveda) {
    const tableBody = document.getElementById('localizationTableBody');
    const newRow = tableBody.insertRow();
    const idCell = newRow.insertCell(0);
    const expedienteCell = newRow.insertCell(1);
    const sucursalCell = newRow.insertCell(2);
    const archivoCell = newRow.insertCell(3);
    const bovedaCell = newRow.insertCell(4);
    const actionsCell = newRow.insertCell(5);

    const newId = tableBody.rows.length + 1;
    idCell.textContent = newId;
    expedienteCell.textContent = expediente;
    sucursalCell.textContent = sucursal;
    archivoCell.textContent = archivo;
    bovedaCell.textContent = boveda;
    actionsCell.innerHTML = `
        <button class="btnEditLocalization btn" onclick="editLocalization(${newId}, '${expediente}', '${sucursal}', '${archivo}', '${boveda}')">Editar</button>
        <button onclick="deleteLocalization(${newId})" class="btn">Eliminar</button>
    `;

    document.querySelectorAll('.btnEditLocalization').forEach(button => {
        button.addEventListener('click', (event) => {
            const row = event.target.closest('tr');
            const id = row.cells[0].textContent;
            const expediente = row.cells[1].textContent;
            const sucursal = row.cells[2].textContent;
            const archivo = row.cells[3].textContent;
            const boveda = row.cells[4].textContent;
            editId = id;
            document.getElementById('editExpediente').value = expediente;
            document.getElementById('editSucursal').value = sucursal;
            document.getElementById('editArchivo').value = archivo;
            document.getElementById('editBoveda').value = boveda;
            modalEditar.style.display = 'block';
        });
    });
}

function updateLocalization(id, expediente, sucursal, archivo, boveda) {
    const tableBody = document.getElementById('localizationTableBody');
    for (let row of tableBody.rows) {
        if (row.cells[0].textContent == id) {
            row.cells[1].textContent = expediente;
            row.cells[2].textContent = sucursal;
            row.cells[3].textContent = archivo;
            row.cells[4].textContent = boveda;
            break;
        }
    }
}

function deleteLocalization(id) {
    const tableBody = document.getElementById('localizationTableBody');
    for (let row of tableBody.rows) {
        if (row.cells[0].textContent == id) {
            tableBody.deleteRow(row.rowIndex - 1);
            break;
        }
    }
}

function editLocalization(id, expediente, sucursal, archivo, boveda) {
    document.getElementById('editExpediente').value = expediente;
    document.getElementById('editSucursal').value = sucursal;
    document.getElementById('editArchivo').value = archivo;
    document.getElementById('editBoveda').value = boveda;
    editId = id;
    document.getElementById('modalEditar').style.display = 'block';
}

document.getElementById('cerrar').addEventListener('click', function() {
    window.location.href = this.getAttribute('data-href');
});