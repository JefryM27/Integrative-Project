document.addEventListener('DOMContentLoaded', function () {
    // Ejemplo de datos de gastos con campo de fecha
    const gastos = [
        { fecha: '25-05-2024', descripcion: 'Bombillo', monto: 1500 },
        { fecha: '30-08-2024', descripcion: 'Lapiceros', monto: 10000 },
        { fecha: '05-10-2024', descripcion: 'Hojas', monto: 25000}
    ];

    // Función para cargar los gastos en la tabla
    function cargarGastos() {
        const tablaGastos = document.getElementById('tabla-gastos').getElementsByTagName('tbody')[0];
        gastos.forEach(gasto => {
            const fila = tablaGastos.insertRow();
            const celdaFecha = fila.insertCell(0);
            const celdaDescripcion = fila.insertCell(1);
            const celdaMonto = fila.insertCell(2);
            celdaFecha.textContent = gasto.fecha;
            celdaDescripcion.textContent = gasto.descripcion;
            celdaMonto.textContent = `₡${gasto.monto.toFixed(2)}`;
        });
    }

    // Llamar a la función para cargar los gastos al cargar la página
    cargarGastos();
});
