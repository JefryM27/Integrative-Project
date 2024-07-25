document.addEventListener('DOMContentLoaded', function () {
    // Gráfico de Ingresos Diarios
    var dailyCtx = document.getElementById('dailyIncomeChart').getContext('2d');
    var dailyIncomeChart = new Chart(dailyCtx, {
        type: 'line',
        data: {
            labels: ['01/06', '02/06', '03/06', '04/06', '05/06', '06/06', '07/06'],
            datasets: [{
                label: 'Ingresos',
                data: [1200, 2500, 1800, 2200, 1500, 2400, 2300],
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

    // Gráfico de Ingresos Semanales
    var weeklyCtx = document.getElementById('weeklyIncomeChart').getContext('2d');
    var weeklyIncomeChart = new Chart(weeklyCtx, {
        type: 'bar',
        data: {
            labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
            datasets: [{
                label: 'Ingresos',
                data: [15000, 12000, 18000, 17000],
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

    // Gráfico de Ingresos Mensuales
    var monthlyCtx = document.getElementById('monthlyIncomeChart').getContext('2d');
    var monthlyIncomeChart = new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            datasets: [{
                label: 'Ingresos',
                data: [45000, 48000, 50000, 52000, 53000, 54000, 55000, 57000, 59000, 60000, 61000, 62000],
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
    // Gráfico Comparativo de Ingresos y Gastos
    var incomeExpenseComparisonCtx = document.getElementById('incomeExpenseComparisonChart').getContext('2d');
    var incomeExpenseComparisonChart = new Chart(incomeExpenseComparisonCtx, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                label: 'Ingresos',
                data: [10000, 12000, 15000, 13000, 17000, 16000],
                backgroundColor: 'rgba(59, 89, 152, 0.2)',
                borderColor: 'rgba(59, 89, 152, 1)',
                borderWidth: 1
            }, {
                label: 'Gastos',
                data: [8000, 9000, 11000, 10000, 14000, 13000],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
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


