document.addEventListener('DOMContentLoaded', () => {
    // Obtener elementos de los modales
    const modalCrear = document.getElementById('modalCrear');
    const modalEditar = document.getElementById('modalEditar');

    // Obtener botones de abrir modales
    const btnAddAsset = document.getElementById('btnAddAsset');
    const btnEditAssets = document.querySelectorAll('.btnEditAsset'); // Todos los botones de editar

    // Obtener botones de cerrar modales
    const closeCrear = document.getElementById('closeCrear');
    const closeEditar = document.getElementById('closeEditar');
    const cancelCrear = document.getElementById('cancelCrear');
    const cancelEditar = document.getElementById('cancelEditar');

    // Abrir el modal de Crear Activo
    btnAddAsset.addEventListener('click', () => {
        modalCrear.style.display = 'block';
    });

    // Abrir el modal de Editar Activo
    btnEditAssets.forEach(button => {
        button.addEventListener('click', (event) => {
            const assetId = event.target.getAttribute('data-id');
            // Aquí puedes cargar los datos del activo en el modal si es necesario
            modalEditar.style.display = 'block';
        });
    });

    // Cerrar el modal de Crear Activo
    closeCrear.addEventListener('click', () => {
        modalCrear.style.display = 'none';
    });

    // Cerrar el modal de Editar Activo
    closeEditar.addEventListener('click', () => {
        modalEditar.style.display = 'none';
    });

    // Cerrar los modales si se hace clic fuera de ellos
    window.addEventListener('click', (event) => {
        if (event.target === modalCrear) {
            modalCrear.style.display = 'none';
        }
        if (event.target === modalEditar) {
            modalEditar.style.display = 'none';
        }
    });
});
