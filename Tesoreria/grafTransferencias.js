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
});
