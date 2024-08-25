document.addEventListener('DOMContentLoaded', () => {
    const cuentas = JSON.parse(localStorage.getItem('cuentas')) || [];
    const cuentasTable = document.getElementById('cuentas');

    cuentas.forEach(cuenta => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${cuenta.nombre}</td>
            <td>${cuenta.numeroCuenta}</td>
            <td>${cuenta.tipoCuenta}</td>
            <td>${cuenta.saldoInicial}</td>
            <td>
            </td>
        `;
        cuentasTable.appendChild(row);
    });
});
