document.addEventListener('DOMContentLoaded', () => {
    const createAssetValuationBtn = document.getElementById('createAssetValuationBtn');
    const valuationModal = document.getElementById('valuationModal');
    const closeModal = document.getElementById('closeModal');
    const modalTitle = document.getElementById('modalTitle');
    const valuationForm = document.getElementById('valuationForm');
    const assetSelect = document.getElementById('asset');
    const typeSelect = document.getElementById('type');
    const valuationInput = document.getElementById('valuation');
    const peritoSelect = document.getElementById('perito');
    const observacionesInput = document.getElementById('observaciones');
    const modalSubmitBtn = document.getElementById('modalSubmitBtn');

    let isEditing = false;
    let currentEditId = null;

    // Ejemplo de datos simulados para activos y peritos
    const assets = [
        { id: 1, name: 'Activo 1' },
        { id: 2, name: 'Activo 2' },
        { id: 3, name: 'Activo 3' }
        // Agrega más activos según necesites
    ];

    const tipos = [
        'Hipoteca',
        'Vehículo',
        'Certificado',
        // Agrega más tipos según necesites
    ];

    const peritos = [
        { id: 1, name: 'Perito 1' },
        { id: 2, name: 'Perito 2' },
        { id: 3, name: 'Perito 3' }
        // Agrega más peritos según necesites
    ];

    // Función para llenar opciones en un select
    function fillSelectOptions(select, data) {
        select.innerHTML = '';
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.name;
            select.appendChild(option);
        });
    }

    // Llenar opciones de activos, tipos y peritos al cargar la página
    fillSelectOptions(assetSelect, assets);
    fillSelectOptions(peritoSelect, peritos);

    // Evento al hacer clic en el botón de crear nueva valoración de activo
    createAssetValuationBtn.addEventListener('click', () => {
        modalTitle.textContent = 'Nueva Valoración de Activo';
        valuationForm.reset();
        isEditing = false;
        currentEditId = null;
        valuationModal.style.display = 'block';
    });

    // Evento para cerrar el modal
    closeModal.addEventListener('click', () => {
        valuationModal.style.display = 'none';
    });

    // Evento para cerrar el modal haciendo clic fuera de él
    window.addEventListener('click', (event) => {
        if (event.target === valuationModal) {
            valuationModal.style.display = 'none';
        }
    });

    // Evento al enviar el formulario de valoración de activos
    valuationForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const assetId = assetSelect.value;
        const tipo = typeSelect.value;
        const valuation = valuationInput.value;
        const peritoId = peritoSelect.value;
        const observaciones = observacionesInput.value;

        if (isEditing) {
            // Lógica para actualizar una valoración existente
            alert(`Valoración actualizada para el activo ${assetId}: Tipo ${tipo}, Valoración ${valuation}, Perito ${peritoId}, Observaciones ${observaciones}`);
        } else {
            // Lógica para agregar una nueva valoración
            alert(`Nueva valoración creada para el activo ${assetId}: Tipo ${tipo}, Valoración ${valuation}, Perito ${peritoId}, Observaciones ${observaciones}`);
        }

        valuationModal.style.display = 'none';
    });
});
document.getElementById('cerrar').addEventListener('click', function () {
    window.location.href = this.getAttribute('data-href');
});
