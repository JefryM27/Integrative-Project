document.getElementById('accountForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Simulación de validación de backend
    alert('Validando en el servidor...');

    setTimeout(() => {
        alert('¡Cuenta creada exitosamente!');
        // Aquí podrías redirigir a otra página o mostrar más información
    }, 2000);
});

function cancelar() {
    if (confirm('¿Estás seguro de que deseas cancelar?')) {
        window.location.href = 'index.php';
    }
}
window.onload = function() {
    fetch('listarcuentas.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('cuentas');
            data.forEach(cuenta => {
                let row = `<tr>
                                <td>${cuenta.nombre}</td>
                                <td>${cuenta.numero_cuenta}</td>
                                <td>${cuenta.tipo_cuenta}</td>
                                <td>${cuenta.saldo_inicial}</td>
                            </tr>`;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error('Error:', error));
}
