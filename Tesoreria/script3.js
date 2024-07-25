document.addEventListener('DOMContentLoaded', function () {
    // Gráfico de Colones a USD
    var colonesToUsdCtx = document.getElementById('colonesToUsdChart').getContext('2d');
    var colonesToUsdChart = new Chart(colonesToUsdCtx, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                label: 'Colones a USD',
                data: [600, 610, 615, 620, 625, 630],
                backgroundColor: 'rgba(59, 89, 152, 0.2)',
                borderColor: 'rgba(59, 89, 152, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    });

    // Gráfico de Colones a EUR
    var colonesToEurCtx = document.getElementById('colonesToEurChart').getContext('2d');
    var colonesToEurChart = new Chart(colonesToEurCtx, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                label: 'Colones a EUR',
                data: [700, 710, 715, 720, 725, 730],
                backgroundColor: 'rgba(59, 89, 152, 0.2)',
                borderColor: 'rgba(59, 89, 152, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    });

    // Gráfico de USD a EUR
    var usdToEurCtx = document.getElementById('usdToEurChart').getContext('2d');
    var usdToEurChart = new Chart(usdToEurCtx, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                label: 'USD a EUR',
                data: [0.85, 0.86, 0.87, 0.88, 0.89, 0.90],
                backgroundColor: 'rgba(59, 89, 152, 0.2)',
                borderColor: 'rgba(59, 89, 152, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    });
});
