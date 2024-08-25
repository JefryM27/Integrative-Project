document.addEventListener('DOMContentLoaded', () => {
    const createAuditBtn = document.getElementById('createAuditBtn');
    const auditModal = document.getElementById('auditModal');
    const closeModal = document.getElementById('closeModal');
    const modalTitle = document.getElementById('modalTitle');
    const auditForm = document.getElementById('auditForm');
    const auditDate = document.getElementById('auditDate');
    const auditActivo = document.getElementById('auditActivo');
    const auditResultado = document.getElementById('auditResultado');
    const modalSubmitBtn = document.getElementById('modalSubmitBtn');

    let isEditing = false;
    let currentEditId = null;

    createAuditBtn.addEventListener('click', () => {
        modalTitle.textContent = 'Nueva Auditoría';
        auditForm.reset();
        isEditing = false;
        currentEditId = null;
        auditModal.style.display = 'block';
    });

    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            const date = button.dataset.date;
            const activo = button.dataset.activo;
            const resultado = button.dataset.resultado;

            modalTitle.textContent = 'Editar Auditoría';
            auditDate.value = date;
            auditActivo.value = activo;
            auditResultado.value = resultado;
            isEditing = true;
            currentEditId = id;
            auditModal.style.display = 'block';
        });
    });

    closeModal.addEventListener('click', () => {
        auditModal.style.display = 'none';
    });

    document.getElementById('cerrar').addEventListener('click', function() {
        window.location.href = this.getAttribute('data-href');
    });

    window.addEventListener('click', (event) => {
        if (event.target == auditModal) {
            auditModal.style.display = 'none';
        }
    });

    auditForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const date = auditDate.value;
        const activo = auditActivo.value;
        const resultado = auditResultado.value;

        if (isEditing) {
            // Aquí puedes añadir la lógica para actualizar la auditoría en tu base de datos
            alert(`Auditoría actualizada: ID ${currentEditId}, Fecha: ${date}, Activo: ${activo}, Resultado: ${resultado}`);
        } else {
            // Aquí puedes añadir la lógica para crear una nueva auditoría en tu base de datos
            alert(`Nueva auditoría creada: Fecha: ${date}, Activo: ${activo}, Resultado: ${resultado}`);
        }

        auditModal.style.display = 'none';
    });
});
document.addEventListener('DOMContentLoaded', () => {
    const backBtn = document.getElementById('backBtn');
    const auditDetails = document.getElementById('auditDetails');

    // Función para obtener los parámetros de la URL
    function getQueryParams() {
        const params = {};
        const queryString = window.location.search.substring(1);
        const regex = /([^&=]+)=([^&]*)/g;
        let match;

        while (match = regex.exec(queryString)) {
            params[decodeURIComponent(match[1])] = decodeURIComponent(match[2]);
        }
        return params;
    }

    // Obtener los parámetros de la URL
    const queryParams = getQueryParams();
    const auditId = queryParams.id;

    // Simulando la obtención de datos de auditoría
    const auditData = {
        1: { fecha: '2024-06-20', activo: 'Servidor Principal', resultado: 'Auditoría de cumplimiento' },
        2: { fecha: '2024-06-15', activo: 'Base de Datos', resultado: 'Auditoría de seguridad informática' },
        3: { fecha: '2024-06-10', activo: 'Red Corporativa', resultado: 'Auditoría financiera' },
    };

    // Obtener los datos de la auditoría
    const audit = auditData[auditId];

    // Si se encuentra la auditoría, mostrar sus detalles
    if (audit) {
        auditDetails.innerHTML = `
            <p><strong>Fecha:</strong> ${audit.fecha}</p>
            <p><strong>Activo:</strong> ${audit.activo}</p>
            <p><strong>Resultado:</strong> ${audit.resultado}</p>
        `;
    } else {
        auditDetails.innerHTML = `<p>No se encontró la auditoría con ID ${auditId}</p>`;
    }

    // Manejar el botón de volver
    backBtn.addEventListener('click', () => {
        window.history.back();
    });
});
form.onsubmit = function(event) {
    event.preventDefault(); // Evita el envío del formulario por defecto

    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/actions/auditoria/agregar.php', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                // Actualiza la tabla con los nuevos datos
                updateTable();
                closeModal();
            } else {
                console.error('Error al guardar la auditoría:', response.message);
            }
        } else {
            console.error('Error al enviar los datos.');
        }
    };

    xhr.send(formData);
};
