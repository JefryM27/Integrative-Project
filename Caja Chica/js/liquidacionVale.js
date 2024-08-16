document.addEventListener('DOMContentLoaded', function () {
    const liquidacionForm = document.getElementById('liquidacion-form');

    liquidacionForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const numeroVale = document.getElementById('numero-vale').value;
        const montoGastado = document.getElementById('monto-gastado').value;
        const detalleGastos = document.getElementById('detalle-gastos').value;
        const fechaLiquidacion = document.getElementById('fecha-liquidacion').value;

        const liquidacion = {
            numero: numeroVale,
            montoGastado: montoGastado,
            detalleGastos: detalleGastos,
            fecha: fechaLiquidacion
        };

        // Guardar la liquidación en el almacenamiento local (localStorage)
        let liquidaciones = localStorage.getItem('liquidaciones');
        liquidaciones = liquidaciones ? JSON.parse(liquidaciones) : [];
        liquidaciones.push(liquidacion);
        localStorage.setItem('liquidaciones', JSON.stringify(liquidaciones));

        // Limpiar el formulario
        liquidacionForm.reset();

        alert('Vale liquidado con éxito');
    });
});
