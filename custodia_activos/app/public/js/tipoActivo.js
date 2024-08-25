// tipoActivo.js

document.addEventListener('DOMContentLoaded', () => {
    const modalCrearTipoActivo = document.getElementById('modalCrearTipoActivo');
    const modalEditarTipoActivo = document.getElementById('modalEditarTipoActivo');
    const closeCrearTipoActivo = document.getElementById('closeCrearTipoActivo');
    const closeEditarTipoActivo = document.getElementById('closeEditarTipoActivo');
    const cancelCrearTipoActivo = document.getElementById('cancelCrearTipoActivo');
    const cancelEditarTipoActivo = document.getElementById('cancelEditarTipoActivo');
    const btnAddTipoActivo = document.getElementById('btnAddTipoActivo');
    const addTipoActivoForm = document.getElementById('addTipoActivoForm');
    const editTipoActivoForm = document.getElementById('editTipoActivoForm');
    let editTipoActivoId = null;

    btnAddTipoActivo.addEventListener('click', () => {
        modalCrearTipoActivo.style.display = 'block';
    });

    closeCrearTipoActivo.addEventListener('click', () => {
        modalCrearTipoActivo.style.display = 'none';
    });

    closeEditarTipoActivo.addEventListener('click', () => {
        modalEditarTipoActivo.style.display = 'none';
    });

    cancelCrearTipoActivo.addEventListener('click', () => {
        modalCrearTipoActivo.style.display = 'none';
    });

    cancelEditarTipoActivo.addEventListener('click', () => {
        modalEditarTipoActivo.style.display = 'none';
    });

    window.onclick = (event) => {
        if (event.target == modalCrearTipoActivo) {
            modalCrearTipoActivo.style.display = 'none';
        }
        if (event.target == modalEditarTipoActivo) {
            modalEditarTipoActivo.style.display = 'none';
        }
    };

    addTipoActivoForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const descripcion = event.target.descripcion.value;
        const nombreActivo = event.target.nombreActivo.value;
        const clasificacion = event.target.clasificacion.value;
        addTipoActivo(descripcion, nombreActivo, clasificacion);
        modalCrearTipoActivo.style.display = 'none';
    });

    editTipoActivoForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const descripcion = event.target.descripcion.value;
        const nombreActivo = event.target.nombreActivo.value;
        const clasificacion = event.target.clasificacion.value;
        updateTipoActivo(editTipoActivoId, descripcion, nombreActivo, clasificacion);
        modalEditarTipoActivo.style.display = 'none';
    });

    document.querySelectorAll('.btnEditTipoActivo').forEach(button => {
        button.addEventListener('click', (event) => {
            const row = event.target.closest('tr');
            const id = row.cells[0].textContent;
            const descripcion = row.cells[1].textContent;
            const nombreActivo = row.cells[2].textContent;
            const clasificacion = row.cells[3].textContent;
            editTipoActivoId = id;
            document.getElementById('editDescripcion').value = descripcion;
            document.getElementById('editNombreActivo').value = nombreActivo;
            document.getElementById('editClasificacion').value = clasificacion;
            modalEditarTipoActivo.style.display = 'block';
        });
    });
});

function addTipoActivo(descripcion, nombreActivo, clasificacion) {
    const tableBody = document.getElementById('tipoActivoTableBody');
    const newRow = tableBody.insertRow();
    const idCell = newRow.insertCell(0);
    const descripcionCell = newRow.insertCell(1);
    const nombreActivoCell = newRow.insertCell(2);
    const clasificacionCell = newRow.insertCell(3);
    const actionsCell = newRow.insertCell(4);

    idCell.textContent = tableBody.rows.length;
    descripcionCell.textContent = descripcion;
    nombreActivoCell.textContent = nombreActivo;
    clasificacionCell.textContent = clasificacion;
    actionsCell.innerHTML = `
        <button class="btnEditTipoActivo btn">Editar</button>
        <button onclick="deleteTipoActivo(${tableBody.rows.length})" class="btn">Eliminar</button>
    `;

    document.querySelectorAll('.btnEditTipoActivo').forEach(button => {
        button.addEventListener('click', (event) => {
            const row = event.target.closest('tr');
            const id = row.cells[0].textContent;
            const descripcion = row.cells[1].textContent;
            const nombreActivo = row.cells[2].textContent;
            const clasificacion = row.cells[3].textContent;
            editTipoActivoId = id;
            document.getElementById('editDescripcion').value = descripcion;
            document.getElementById('editNombreActivo').value = nombreActivo;
            document.getElementById('editClasificacion').value = clasificacion;
            modalEditarTipoActivo.style.display = 'block';
        });
    });
}

function updateTipoActivo(id, descripcion, nombreActivo, clasificacion) {
    const tableBody = document.getElementById('tipoActivoTableBody');
    for (let row of tableBody.rows) {
        if (row.cells[0].textContent == id) {
            row.cells[1].textContent = descripcion;
            row.cells[2].textContent = nombreActivo;
            row.cells[3].textContent = clasificacion;
            break;
        }
    }
}

function deleteTipoActivo(id) {
    const tableBody = document.getElementById('tipoActivoTableBody');
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
