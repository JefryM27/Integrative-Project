document.getElementById('newAccountForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const cuenta = {
        nombre: document.getElementById('nombre').value,
        fechaNacimiento: document.getElementById('fechaNacimiento').value,
        identificacion: document.getElementById('identificacion').value,
        telefono: document.getElementById('telefono').value,
        direccion: {
            calle: document.getElementById('calle').value,
            ciudad: document.getElementById('ciudad').value,
            estado: document.getElementById('estado').value,
            codigoPostal: document.getElementById('codigoPostal').value,
        },
        correo: document.getElementById('correo').value,
        tipoCuenta: document.getElementById('tipoCuenta').value,
        moneda: document.getElementById('moneda').value,
        saldoInicial: document.getElementById('saldoInicial').value,
        numeroCuenta: 'CUENTA-' + Math.floor(Math.random() * 1000000),
    };

    const cuentas = JSON.parse(localStorage.getItem('cuentas')) || [];
    cuentas.push(cuenta);
    localStorage.setItem('cuentas', JSON.stringify(cuentas));

    window.location.href = 'vercuentas.php';
});
