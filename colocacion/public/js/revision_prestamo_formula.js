var comparisonChart;
var exchangeRate = 550;

document.getElementById('loanForm').addEventListener('submit', function(e) {
    e.preventDefault();
    handleFormSubmit();
});

function handleFormSubmit() {
    var salary = parseFloat(document.getElementById('salary').value);
    var loanAmount = parseFloat(document.getElementById('loanAmount').value);
    var loanTerm = parseInt(document.getElementById('loanTerm').value);
    var currency = document.getElementById('currency').value;

    if (currency === 'CRC') {
        salary = convertToUSD(salary);
        loanAmount = convertToUSD(loanAmount);
    }

    var monthlyPayment = calculateMonthlyPayment(loanAmount, loanTerm);
    var salaryPercentage = calculateSalaryPercentage(monthlyPayment, salary);
    displayResult(salaryPercentage <= 40);

    if (currency === 'CRC') {
        monthlyPayment = convertToCRC(monthlyPayment);
        salary = convertToCRC(salary);
    }

    displayMonthlyPayment(monthlyPayment, currency);
    updateChart(salary, monthlyPayment, currency);
}

function convertToUSD(amount) {
    return amount / exchangeRate;
}

function convertToCRC(amount) {
    return amount * exchangeRate;
}

function calculateMonthlyPayment(loanAmount, loanTerm) {
    return loanAmount / loanTerm;
}

function calculateSalaryPercentage(monthlyPayment, salary) {
    return (monthlyPayment / salary) * 100;
}

function displayResult(isEligible) {
    var resultElement = document.getElementById('result');
    if (isEligible) {
        resultElement.textContent = 'Eres apto para el préstamo.';
        resultElement.className = 'result-success';
    } else {
        resultElement.textContent = 'No eres apto para el préstamo.';
        resultElement.className = 'result-failure';
    }
}

function displayMonthlyPayment(monthlyPayment, currency) {
    document.getElementById('monthlyPaymentResult').textContent = 'Cuota Mensual a Pagar: ' + formatCurrency(monthlyPayment, currency);
}

function formatCurrency(amount, currency) {
    return new Intl.NumberFormat('es-CR', { style: 'currency', currency: currency }).format(amount);
}

function updateChart(salary, monthlyPayment, currency) {
    if (comparisonChart) {
        comparisonChart.destroy();
    }

    var ctx = document.getElementById('comparisonChart').getContext('2d');
    comparisonChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Salario Mensual', 'Monto Mensual del Préstamo'],
            datasets: [{
                label: 'Monto en ' + currency,
                data: [salary, monthlyPayment],
                backgroundColor: ['#4caf50', '#f44336']
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {
                            return formatCurrency(value, currency);
                        }
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Monto en ' + currency
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return formatCurrency(tooltipItem.yLabel, currency);
                    }
                }
            }
        }
    });
}
