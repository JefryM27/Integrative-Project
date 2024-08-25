// securityBoxes.js

document.addEventListener('DOMContentLoaded', () => {
    const modalCrear = document.getElementById('modalCrear');
    const modalEditar = document.getElementById('modalEditar');
    const closeCrear = document.getElementById('closeCrear');
    const closeEditar = document.getElementById('closeEditar');
    const cancelCrear = document.getElementById('cancelCrear');
    const cancelEditar = document.getElementById('cancelEditar');
    const btnAddSecurityBox = document.getElementById('btnAddSecurityBox');
    const addSecurityBoxForm = document.getElementById('addSecurityBoxForm');
    const editSecurityBoxForm = document.getElementById('editSecurityBoxForm');
    let editId = null;

    btnAddSecurityBox.addEventListener('click', () => {
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

    addSecurityBoxForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const name = event.target.name.value;
        const location = event.target.location.value;
        addSecurityBox(name, location);
        modalCrear.style.display = 'none';
    });

    editSecurityBoxForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const name = event.target.name.value;
        const location = event.target.location.value;
        updateSecurityBox(editId, name, location);
        modalEditar.style.display = 'none';
    });

    document.querySelectorAll('.btnEditSecurityBox').forEach(button => {
        button.addEventListener('click', (event) => {
            const row = event.target.closest('tr');
            const id = row.cells[0].textContent;
            const name = row.cells[1].textContent;
            const location = row.cells[2].textContent;
            editId = id;
            document.getElementById('editName').value = name;
            document.getElementById('editLocation').value = location;
            modalEditar.style.display = 'block';
        });
    });
});

function addSecurityBox(name, location) {
    const tableBody = document.getElementById('securityBoxTableBody');
    const newRow = tableBody.insertRow();
    const idCell = newRow.insertCell(0);
    const nameCell = newRow.insertCell(1);
    const locationCell = newRow.insertCell(2);
    const actionsCell = newRow.insertCell(3);

    idCell.textContent = tableBody.rows.length + 1;
    nameCell.textContent = name;
    locationCell.textContent = location;
    actionsCell.innerHTML = `
        <button class="btnEditSecurityBox btn">Editar</button>
        <button onclick="deleteSecurityBox(${tableBody.rows.length + 1})" class="btn">Eliminar</button>
    `;

    document.querySelectorAll('.btnEditSecurityBox').forEach(button => {
        button.addEventListener('click', (event) => {
            const row = event.target.closest('tr');
            const id = row.cells[0].textContent;
            const name = row.cells[1].textContent;
            const location = row.cells[2].textContent;
            editId = id;
            document.getElementById('editName').value = name;
            document.getElementById('editLocation').value = location;
            modalEditar.style.display = 'block';
        });
    });
}

function updateSecurityBox(id, name, location) {
    const tableBody = document.getElementById('securityBoxTableBody');
    for (let row of tableBody.rows) {
        if (row.cells[0].textContent == id) {
            row.cells[1].textContent = name;
            row.cells[2].textContent = location;
            break;
        }
    }
}

function deleteSecurityBox(id) {
    const tableBody = document.getElementById('securityBoxTableBody');
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
// Suponiendo que ya tienes un evento listener para los botones de edición
document.querySelectorAll('.btnEditSecurityBox').forEach(button => {
    button.addEventListener('click', function() {
        // Obtener la fila correspondiente al botón de edición
        const row = this.closest('tr');

        // Extraer los valores de la fila
        const id = row.cells[0].textContent.trim();
        const name = row.cells[1].textContent.trim();
        const location = row.cells[2].textContent.trim();
        const boxNumber = row.cells[3].textContent.trim();
        const capacity = row.cells[4].textContent.trim();
        const availability = row.cells[5].textContent.trim();

        // Asignar los valores a los campos del modal de edición
        document.getElementById('editId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editLocation').value = location;
        document.getElementById('editBoxNumber').value = boxNumber;
        document.getElementById('editCapacity').value = capacity;
        document.getElementById('editAvailability').value = availability;

        // Mostrar el modal de edición
        document.getElementById('modalEditar').style.display = 'block';
    });
});

// Código para cerrar el modal (opcional si ya lo tienes implementado)
document.getElementById('closeEditar').addEventListener('click', function() {
    document.getElementById('modalEditar').style.display = 'none';
});
document.getElementById('cancelEditar').addEventListener('click', function() {
    document.getElementById('modalEditar').style.display = 'none';
});
document.addEventListener("DOMContentLoaded", function() {
    const addSecurityBoxForm = document.getElementById("addSecurityBoxForm");
    const editSecurityBoxForm = document.getElementById("editSecurityBoxForm");

    addSecurityBoxForm.addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData(addSecurityBoxForm);

        fetch("/actions/cajaSeguridad/agregar.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Caja de seguridad creada exitosamente.");
                location.reload();
            } else {
                alert("Hubo un error al crear la caja de seguridad.");
            }
        });
    });

    editSecurityBoxForm.addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData(editSecurityBoxForm);

        fetch("/actions/cajaSeguridad/editar.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Caja de seguridad actualizada exitosamente.");
                location.reload();
            } else {
                alert("Hubo un error al actualizar la caja de seguridad.");
            }
        });
    });

    document.querySelectorAll(".btnEditSecurityBox").forEach(button => {
        button.addEventListener("click", function() {
            // Lógica para cargar los datos en el formulario de edición
            // y abrir el modal de edición.
        });
    });

    document.querySelectorAll(".btn-danger").forEach(button => {
        button.addEventListener("click", function(event) {
            if (!confirm("¿Estás seguro de que deseas eliminar esta caja de seguridad?")) {
                event.preventDefault();
            }
        });
    });
});
// En cajaSegu.js, para agregar o actualizar una caja
document.getElementById('addSecurityBoxForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const name = document.getElementById('name').value;
    const location = document.getElementById('location').value;
    const boxNumber = document.getElementById('boxNumber').value;
    const capacity = document.getElementById('capacity').value;
    const availability = document.getElementById('availability').value;
    
    // Aquí puedes realizar la llamada AJAX para agregar la caja de seguridad
    // Asegúrate de enviar todos los valores al servidor
});

// Similarmente, para editar una caja
document.getElementById('editSecurityBoxForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const id = document.getElementById('editId').value;
    const name = document.getElementById('editName').value;
    const location = document.getElementById('editLocation').value;
    const boxNumber = document.getElementById('editBoxNumber').value;
    const capacity = document.getElementById('editCapacity').value;
    const availability = document.getElementById('editAvailability').value;
    
    // Aquí puedes realizar la llamada AJAX para actualizar la caja de seguridad
    // Asegúrate de enviar todos los valores al servidor
});
document.addEventListener('DOMContentLoaded', function () {
    // Abrir modal para agregar
    document.getElementById('btnAddSecurityBox').addEventListener('click', function () {
        document.getElementById('modalCrear').style.display = 'block';
    });

    // Cerrar modales
    document.getElementById('closeCrear').addEventListener('click', function () {
        document.getElementById('modalCrear').style.display = 'none';
    });
    document.getElementById('cancelCrear').addEventListener('click', function () {
        document.getElementById('modalCrear').style.display = 'none';
    });
    
    document.getElementById('closeEditar').addEventListener('click', function () {
        document.getElementById('modalEditar').style.display = 'none';
    });
    document.getElementById('cancelEditar').addEventListener('click', function () {
        document.getElementById('modalEditar').style.display = 'none';
    });

    // Manejar edición
    document.querySelectorAll('.btnEditSecurityBox').forEach(function (button) {
        button.addEventListener('click', function () {
            const row = button.closest('tr');
            const id = row.querySelector('td').innerText;
            const nombre = row.querySelector('td:nth-child(2)').innerText;
            // Agregar código para rellenar el modal de edición con los valores
            document.getElementById('editId').value = id;
            document.getElementById('editName').value = nombre;
            document.getElementById('modalEditar').style.display = 'block';
        });
    });
});