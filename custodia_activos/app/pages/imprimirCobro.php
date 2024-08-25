<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir Cobro por Uso de Activos</title>
    <link rel="stylesheet" href="../public/css/imprimirCobro.css">
</head>
<body>
    <header class="header">
        <h1>Detalle del Cobro por Uso de Activos</h1>
    </header>
    <section id="chargeDetails" class="charge-details">
        <article class="charge">
            <h2>Información del Cobro</h2>
            <div class="details">
                <div class="detail">
                    <span class="label">ID:</span>
                    <span class="value" id="chargeId"></span>
                </div>
                <div class="detail">
                    <span class="label">Fecha:</span>
                    <span class="value" id="chargeDate"></span>
                </div>
                <div class="detail">
                    <span class="label">Activo:</span>
                    <span class="value" id="chargeAsset"></span>
                </div>
                <div class="detail">
                    <span class="label">Tarifa:</span>
                    <span class="value" id="chargeAmount"></span>
                </div>
            </div>
        </article>
    </section>

    <script>
        // Obtener parámetros de la URL
        const params = new URLSearchParams(window.location.search);
        const chargeId = params.get('id');

        // Simular obtener datos desde una fuente de datos (podría ser una API o base de datos)
        const charges = [
            { id: 1, date: '2024-06-20', asset: 'Oficina Principal', amount: 500 },
            { id: 2, date: '2024-06-15', asset: 'Vehículo de Empresa', amount: 300 },
            { id: 3, date: '2024-06-10', asset: 'Equipo de Oficina', amount: 200 }
        ];

        // Encontrar el cobro correspondiente
        const charge = charges.find(c => c.id == chargeId);

        // Rellenar la información del cobro en la página
        if (charge) {
            document.getElementById('chargeId').textContent = charge.id;
            document.getElementById('chargeDate').textContent = charge.date;
            document.getElementById('chargeAsset').textContent = charge.asset;
            document.getElementById('chargeAmount').textContent = `$${charge.amount}`;
        } else {
            document.querySelector('.charge-details').innerHTML = '<p>Cobro no encontrado</p>';
        }

        // Imprimir la página automáticamente al cargarse
        window.onload = () => {
            window.print();
        };
    </script>
</body>
</html>
