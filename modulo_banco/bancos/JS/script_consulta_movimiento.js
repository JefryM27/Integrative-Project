function mostrarMovimientos() {
    //  simular la carga de datos
    var movimientos = [
        { fecha: '2024-06-26', monto: '$100.00', tipo: 'Débito', saldo: '$500.00' },
        { fecha: '2024-06-25', monto: '$50.00', tipo: 'Crédito', saldo: '$550.00' },
        { fecha: '2024-06-24', monto: '$200.00', tipo: 'Débito', saldo: '$750.00' }
    ];

    var tbody = document.querySelector('#movimientos tbody');
    tbody.innerHTML = '';

    movimientos.forEach(function (movimiento) {
        var row = document.createElement('tr');
        row.innerHTML = `
            <td>${movimiento.fecha}</td>
            <td>${movimiento.monto}</td>
            <td>${movimiento.tipo}</td>
            <td>${movimiento.saldo}</td>
        `;
        tbody.appendChild(row);
    });
}
