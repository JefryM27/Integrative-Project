document.addEventListener('DOMContentLoaded', () => {
    const uploadButton = document.getElementById('upload-statement');
    const viewTransactionsButton = document.getElementById('view-transactions');
    const reconcileButton = document.getElementById('reconcile');
    const statementSection = document.getElementById('statement-section');
    const transactionsSection = document.getElementById('transactions-section');
    const uploadFileButton = document.getElementById('upload-file');
    const transactionsTable = document.getElementById('transactions-table').getElementsByTagName('tbody')[0];

    // Mostrar el panel de subir extracto bancario
    uploadButton.addEventListener('click', () => {
        statementSection.classList.toggle('hidden');
        transactionsSection.classList.add('hidden');
    });

    // Mostrar el panel de transacciones
    viewTransactionsButton.addEventListener('click', () => {
        transactionsSection.classList.toggle('hidden');
        statementSection.classList.add('hidden');
    });

    // Subir el archivo de extracto bancario (Simulación)
    uploadFileButton.addEventListener('click', () => {
        const fileInput = document.getElementById('statement-file');
        if (fileInput.files.length === 0) {
            alert('Por favor, selecciona un archivo para subir.');
            return;
        }
        
        // Simulación de subida de archivo y análisis
        alert('Extracto bancario subido con éxito.');
        fileInput.value = ''; // Limpiar el campo de entrada después de subir el archivo
    });

    // Función de conciliación (Simulación)
    reconcileButton.addEventListener('click', () => {
        // Aquí deberías añadir la lógica real para conciliar las transacciones
        alert('Conciliación realizada con éxito.');
    });

    // Función para añadir transacciones a la tabla (Ejemplo)
    function addTransaction(fecha, descripcion, monto) {
        const row = transactionsTable.insertRow();
        row.innerHTML = `
            <td>${fecha}</td>
            <td>${descripcion}</td>
            <td>${monto}</td>
        `;
    }

    // Ejemplo: Añadir una transacción al cargar la página
    addTransaction('2024-07-01', 'Pago Proveedor C', '$750.00');
});
