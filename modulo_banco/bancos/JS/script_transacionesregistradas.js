document.addEventListener('DOMContentLoaded', (event) => {
    const form = document.getElementById('transactionForm');
    const transactionTableBody = document.getElementById('transactionTableBody');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevents the default form submission

        // Get form values
        const tipo = document.getElementById('tipo').value;
        const monto = document.getElementById('monto').value;
        const descripcion = document.getElementById('descripcion').value;

        // Validate inputs
        if (monto <= 0) {
            alert('El monto debe ser mayor que 0.');
            return;
        }

        // Create a new row in the table
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${tipo}</td>
            <td>${monto}</td>
            <td>${descripcion}</td>
        `;
        transactionTableBody.appendChild(newRow);

        // Reset form
        form.reset();
    });
});
