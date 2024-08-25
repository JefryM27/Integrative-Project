document.addEventListener('DOMContentLoaded', () => {
    const modalCrear = document.getElementById('modalCrear');
    const modalEditar = document.getElementById('modalEditar');
    const closeCrear = document.getElementById('closeCrear');
    const closeEditar = document.getElementById('closeEditar');
    const cancelCrear = document.getElementById('cancelCrear');
    const cancelEditar = document.getElementById('cancelEditar');
    const btnAddDocument = document.getElementById('btnAddDocument');
    const addDocumentForm = document.getElementById('addDocumentForm');
    const editDocumentForm = document.getElementById('editDocumentForm');
    let editId = null;

    btnAddDocument.addEventListener('click', () => {
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

    addDocumentForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const descripcion = event.target.descripcion.value;
        const fecha = event.target.fecha.value;
        const tipoActivo = event.target.tipoActivo.value;
        const localizacion = event.target.localizacion.value;
        addDocument(descripcion, fecha, tipoActivo, localizacion);
        modalCrear.style.display = 'none';
    });

    editDocumentForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const descripcion = event.target.descripcion.value;
        const fecha = event.target.fecha.value;
        const tipoActivo = event.target.tipoActivo.value;
        const localizacion = event.target.localizacion.value;
        updateDocument(editId, descripcion, fecha, tipoActivo, localizacion);
        modalEditar.style.display = 'none';
    });

    document.querySelectorAll('.btnEditDocument').forEach(button => {
        button.addEventListener('click', (event) => {
            const row = event.target.closest('tr');
            const id = row.cells[0].textContent;
            const descripcion = row.cells[1].textContent;
            const fecha = row.cells[2].textContent;
            const tipoActivo = row.cells[3].textContent;
            const localizacion = row.cells[4].textContent;
            editId = id;
            document.getElementById('editDescripcion').value = descripcion;
            document.getElementById('editFecha').value = fecha;
            document.getElementById('editTipoActivo').value = tipoActivo;
            document.getElementById('editLocalizacion').value = localizacion;
            modalEditar.style.display = 'block';
        });
    });
});

function addDocument(descripcion, fecha, tipoActivo, localizacion) {
    const tableBody = document.getElementById('documentTableBody');
    const newRow = tableBody.insertRow();
    const idCell = newRow.insertCell(0);
    const descripcionCell = newRow.insertCell(1);
    const fechaCell = newRow.insertCell(2);
    const tipoActivoCell = newRow.insertCell(3);
    const localizacionCell = newRow.insertCell(4);
    const actionsCell = newRow.insertCell(5);

    idCell.textContent = tableBody.rows.length + 1;
    descripcionCell.textContent = descripcion;
    fechaCell.textContent = fecha;
    tipoActivoCell.textContent = tipoActivo;
    localizacionCell.textContent = localizacion;
    actionsCell.innerHTML = `
        <button class="btnEditDocument btn">Editar</button>
        <button onclick="deleteDocument(${tableBody.rows.length + 1})" class="btn">Eliminar</button>
    `;

    document.querySelectorAll('.btnEditDocument').forEach(button => {
        button.addEventListener('click', (event) => {
            const row = event.target.closest('tr');
            const id = row.cells[0].textContent;
            const descripcion = row.cells[1].textContent;
            const fecha = row.cells[2].textContent;
            const tipoActivo = row.cells[3].textContent;
            const localizacion = row.cells[4].textContent;
            editId = id;
            document.getElementById('editDescripcion').value = descripcion;
            document.getElementById('editFecha').value = fecha;
            document.getElementById('editTipoActivo').value = tipoActivo;
            document.getElementById('editLocalizacion').value = localizacion;
            modalEditar.style.display = 'block';
        });
    });
}

function updateDocument(id, descripcion, fecha, tipoActivo, localizacion) {
    const tableBody = document.getElementById('documentTableBody');
    for (let row of tableBody.rows) {
        if (row.cells[0].textContent == id) {
            row.cells[1].textContent = descripcion;
            row.cells[2].textContent = fecha;
            row.cells[3].textContent = tipoActivo;
            row.cells[4].textContent = localizacion;
            break;
        }
    }
}

function deleteDocument(id) {
    const tableBody = document.getElementById('documentTableBody');
    for (let row of tableBody.rows) {
        if (row.cells[0].textContent == id) {
            tableBody.deleteRow(row.rowIndex - 1);
            break;
        }
    }
}

document.getElementById('cerrar').addEventListener('click', function() {
    window.location.href = this.getAttribute('data-href');
});
