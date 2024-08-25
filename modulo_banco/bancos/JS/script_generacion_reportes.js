document.addEventListener('DOMContentLoaded', function() {
    const generateReportBtn = document.getElementById('generate-report');
    const reportOutput = document.getElementById('report-output');
    
    generateReportBtn.addEventListener('click', function() {
        // Simulación de generación de reporte
        const reportType = document.getElementById('report-type').value;
        const dateFrom = document.getElementById('date-from').value;
        const dateTo = document.getElementById('date-to').value;
        
        // Aquí puedes construir el HTML del reporte simulado
        const reportHTML = `
            <h3>Reporte generado</h3>
            <p>Tipo de reporte: ${reportType}</p>
            <p>Desde: ${dateFrom}</p>
            <p>Hasta: ${dateTo}</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Descripción</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Pago de agua</td>
                        <td>$100.00</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Pago de luz</td>
                        <td>$50.00</td>
                    </tr>
                </tbody>
            </table>
        `;
        
        reportOutput.innerHTML = reportHTML;
    });
});
