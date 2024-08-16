document.addEventListener('DOMContentLoaded', () => {
    const reportes = [
        {
            numeroFactura: 'F001',
            encargado: 'Juan Pérez',
            departamento: 'Finanzas',
            monto: 1500.00,
            descripcion: 'Bombillos',
            fecha: '2024-07-25'
        },
        {
            numeroFactura: 'F002',
            encargado: 'María García',
            departamento: 'Marketing',
            monto: 3000.00,
            descripcion: 'Hojas',
            fecha: '2024-07-20'
        },
        {
            numeroFactura: 'F003',
            encargado: 'Carlos Sánchez',
            departamento: 'Recursos Humanos',
            monto: 750.00,
            descripcion: 'Tinta para Impresoras',
            fecha: '2024-07-18'
        }
        // Agrega más reportes según sea necesario
    ];

    const tbody = document.querySelector('#reportes-table tbody');

    reportes.forEach((reporte, index) => {
        const tr = document.createElement('tr');

        Object.values(reporte).forEach(value => {
            const td = document.createElement('td');
            td.textContent = value;
            tr.appendChild(td);
        });

        const generarReporteTd = document.createElement('td');
        const verPdfLink = document.createElement('a');
        verPdfLink.href = `reporte.html?factura=${index}`;
        verPdfLink.textContent = 'Generar PDF';
        verPdfLink.target = '_blank'; // Para abrir en una nueva pestaña
        generarReporteTd.appendChild(verPdfLink);
        tr.appendChild(generarReporteTd);

        tbody.appendChild(tr);
    });
});
