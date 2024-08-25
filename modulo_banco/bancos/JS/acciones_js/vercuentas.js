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
                <button onclick="window.location.href='editarCuenta.html?id=${cuenta.numeroCuenta}'">Editar</button>
                <button onclick="window.location.href='eliminarCuenta.html?id=${cuenta.numeroCuenta}'">Eliminar</button>
            </td>
        `;
        cuentasTable.appendChild(row);
    });
});
