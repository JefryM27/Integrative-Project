document.addEventListener('DOMContentLoaded', function () {
    var scheduledTransfersCtx = document.getElementById('scheduledTransfersChart').getContext('2d');
    var scheduledTransfersChart = new Chart(scheduledTransfersCtx, {
        type: 'line',
        data: {
            labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
            datasets: [{
                label: 'Transferencias',
                data: [5, 9, 8, 5, 2, 3, 7],
                backgroundColor: 'rgba(59, 89, 152, 0.2)',
                borderColor: 'rgba(59, 89, 152, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Gráfico de Pronóstico de Flujo de Efectivo
    var cashFlowCtx = document.getElementById('cashFlowForecastChart').getContext('2d');
    var cashFlowForecastChart = new Chart(cashFlowCtx, {
        type: 'line',
        data: {
            labels: ['Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            datasets: [{
                label: 'Flujo de Efectivo',
                data: [23000, 24000, 26000, 25000, 27000, 29000, 31000],
                backgroundColor: 'rgba(59, 89, 152, 0.2)',
                borderColor: 'rgba(59, 89, 152, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
