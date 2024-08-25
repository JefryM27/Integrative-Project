document.addEventListener('DOMContentLoaded', function () {
    const logDiv = document.getElementById('log');
    const simulacionTabla = document.getElementById('simulacionTabla').getElementsByTagName('tbody')[0];

    document.getElementById('liquidacionInteresesBtn').addEventListener('click', function () {
        logAction('Liquidación de intereses ejecutada.');
        agregarMovimiento('2024-06-01', 'Liquidación de Intereses', 0, 150, 1150);
    });

    document.getElementById('cobroComisionesBtn').addEventListener('click', function () {
        logAction('Cobro de comisiones ejecutado.');
        agregarMovimiento('2024-06-02', 'Cobro de Comisiones', 50, 0, 1100);
    });

    document.getElementById('ajusteSaldosBtn').addEventListener('click', function () {
        logAction('Ajuste de saldos ejecutado.');
        agregarMovimiento('2024-06-03', 'Ajuste de Saldos', 0, 200, 1300);
    });

    function logAction(message) {
        const logEntry = document.createElement('p');
        logEntry.textContent = message;
        logDiv.appendChild(logEntry);
    }

    function agregarMovimiento(fecha, descripcion, debito, credito, saldo) {
        const fila = simulacionTabla.insertRow();
        const celdaFecha = fila.insertCell(0);
        const celdaDescripcion = fila.insertCell(1);
        const celdaDebito = fila.insertCell(2);
        const celdaCredito = fila.insertCell(3);
        const celdaSaldo = fila.insertCell(4);

        celdaFecha.textContent = fecha;
        celdaDescripcion.textContent = descripcion;
        celdaDebito.textContent = debito > 0 ? `$${debito.toFixed(2)}` : '';
        celdaCredito.textContent = credito > 0 ? `$${credito.toFixed(2)}` : '';
        celdaSaldo.textContent = `$${saldo.toFixed(2)}`;
    }
});
