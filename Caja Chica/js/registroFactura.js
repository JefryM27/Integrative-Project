document.addEventListener('DOMContentLoaded', function() {
    const facturaForm = document.getElementById('factura-form');

    facturaForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const numeroFactura = document.getElementById('numero-factura').value;
        const proveedor = document.getElementById('proveedor').value;
        const montoFactura = document.getElementById('monto-factura').value;
        const fechaFactura = document.getElementById('fecha-factura').value;

        const factura = {
            numero: numeroFactura,
            proveedor: proveedor,
            monto: montoFactura,
            fecha: fechaFactura
        };

        // Guardar la factura en el almacenamiento local (localStorage)
        let facturas = localStorage.getItem('facturas');
        facturas = facturas ? JSON.parse(facturas) : [];
        facturas.push(factura);
        localStorage.setItem('facturas', JSON.stringify(facturas));

        // Limpiar el formulario
        facturaForm.reset();

        alert('Factura registrada con éxito');
    });
});
