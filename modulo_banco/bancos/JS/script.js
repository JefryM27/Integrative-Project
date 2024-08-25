/* Identificador del estilo: Página de Consulta de Movimientos */
function mostrarMovimientos() {
    const movimientos = [
        { fecha: '2024-06-01', monto: 500, tipo: 'Depósito', saldo: 1500 },
        { fecha: '2024-06-05', monto: -200, tipo: 'Retiro', saldo: 1300 },
        { fecha: '2024-06-10', monto: 1000, tipo: 'Depósito', saldo: 2300 },
        { fecha: '2024-06-15', monto: -300, tipo: 'Compra', saldo: 2000 }
    ];

    const tbody = document.querySelector('#movimientos tbody');
    tbody.innerHTML = '';

    movimientos.forEach(movimiento => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${movimiento.fecha}</td>
            <td>${movimiento.monto}</td>
            <td>${movimiento.tipo}</td>
            <td>${movimiento.saldo}</td>
        `;
        tbody.appendChild(row);
    });
}

// Archivo: js/script.js de la pagina conciliacion


document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('upload-statement').addEventListener('click', function() {
        toggleSection('statement-section');
    });

    document.getElementById('view-transactions').addEventListener('click', function() {
        toggleSection('transactions-section');
    });

    document.getElementById('reconcile').addEventListener('click', function() {
        alert('Simulación de conciliación bancaria completada.');
    });

    function toggleSection(sectionId) {
        const sections = ['statement-section', 'transactions-section'];
        sections.forEach(id => {
            const section = document.getElementById(id);
            if (id === sectionId) {
                section.classList.toggle('hidden');
            } else {
                section.classList.add('hidden');
            }
        });
    }
});

// script.js de la pagina Auto atizacions
document.addEventListener('DOMContentLoaded', function() {
    const log = document.getElementById('log');
    const tabla = document.getElementById('simulacionTabla').getElementsByTagName('tbody')[0];

    document.getElementById('liquidacionInteresesBtn').addEventListener('click', function() {
        log.innerHTML += '<p>Intereses liquidados.</p>';
        agregarMovimiento('2024-06-21', 'Liquidación de Intereses', 0, 100, 1100);
    });

    document.getElementById('cobroComisionesBtn').addEventListener('click', function() {
        log.innerHTML += '<p>Comisiones cobradas.</p>';
        agregarMovimiento('2024-06-21', 'Cobro de Comisiones', 50, 0, 1050);
    });

    document.getElementById('ajusteSaldosBtn').addEventListener('click', function() {
        log.innerHTML += '<p>Saldos ajustados.</p>';
        agregarMovimiento('2024-06-21', 'Ajuste de Saldos', 0, 200, 1250);
    });

    function agregarMovimiento(fecha, descripcion, debito, credito, saldo) {
        const row = tabla.insertRow();
        row.insertCell(0).innerText = fecha;
        row.insertCell(1).innerText = descripcion;
        row.insertCell(2).innerText = debito ? debito.toFixed(2) : '';
        row.insertCell(3).innerText = credito ? credito.toFixed(2) : '';
        row.insertCell(4).innerText = saldo.toFixed(2);
    }

    // Simulación inicial de datos
    const movimientosIniciales = [
        { fecha: '2024-06-01', descripcion: 'Depósito Inicial', debito: 0, credito: 1000, saldo: 1000 },
        { fecha: '2024-06-05', descripcion: 'Pago de Servicios', debito: 100, credito: 0, saldo: 900 }
    ];

    movimientosIniciales.forEach(mov => {
        agregarMovimiento(mov.fecha, mov.descripcion, mov.debito, mov.credito, mov.saldo);
    });
});

// script.js generacion de reportes
document.getElementById('generate-report').addEventListener('click', function() {
    const reportType = document.getElementById('report-type').value;
    const dateFrom = document.getElementById('date-from').value;
    const dateTo = document.getElementById('date-to').value;
    const reportOutput = document.getElementById('report-output');

    // Simulación de generación de reporte
    reportOutput.innerHTML = `<h3>Reporte de ${reportType}</h3>
                              <p>Desde: ${dateFrom}</p>
                              <p>Hasta: ${dateTo}</p>
                              <p>Este es un reporte simulado de ${reportType} generado entre ${dateFrom} y ${dateTo}.</p>`;
});


/* Estilo de integracion otros sistemas*/
document.addEventListener('DOMContentLoaded', function() {
    var mostrarBtns = document.querySelectorAll('.mostrar-btn');
    
    mostrarBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var extraInfo = this.nextElementSibling;
            if (extraInfo.classList.contains('hidden')) {
                extraInfo.classList.remove('hidden');
                this.textContent = 'Mostrar Menos';
            } else {
                extraInfo.classList.add('hidden');
                this.textContent = 'Mostrar Más';
            }
        });
    });
});


// script.js register

document.addEventListener('DOMContentLoaded', () => {
    const transactionForm = document.getElementById('transactionForm');
    const transactionTableBody = document.getElementById('transactionTableBody');

    transactionForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const tipo = document.getElementById('tipo').value;
        const monto = document.getElementById('monto').value;
        const descripcion = document.getElementById('descripcion').value;

        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>${tipo}</td>
            <td>${monto}</td>
            <td>${descripcion}</td>
        `;

        transactionTableBody.appendChild(newRow);

        transactionForm.reset();
    });
});

