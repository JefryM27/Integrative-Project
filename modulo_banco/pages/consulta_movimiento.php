<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Banco Movimiento</title>
    <link rel="stylesheet" href="../bancos/css/styles_consulta_movimiento.css">
</head>
<body>

<header>
    <div class="top-buttons">
        <button onclick="window.location.href = 'index.php'">
            <img src="../bancos/imagen/atras.png" alt="Atrás">
        </button>
        <h1>Banco de Ahorro y Créditos</h1>
        <button onclick="window.location.href = 'index.php'">
            <img src="../bancos/imagen/cerrar seccion.png" alt="Cerrar Sesión">
        </button>
    </div>
</header>

<main>
    <section id="consulta" class="content-section">
        <h2>Consulta de Movimientos</h2>
        <p>Permite a los clientes y al personal del banco consultar el historial de movimientos de una cuenta
            específica, mostrando detalles como fecha, monto, tipo de transacción y saldo resultante.</p>

        <button onclick="mostrarMovimientos()">Consultar Movimientos</button>

        <table id="movimientos">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Tipo de Transacción</th>
                    <th>Saldo Resultante</th>
                </tr>
            </thead>
            <tbody>
                <!-- Datos se insertarán aquí -->
            </tbody>
        </table>
    </section>
</main>

<footer>
    <p>&copy; 2024 Sistema de Gestión Bancaria. Todos los derechos reservados.</p>
</footer>

<!-- Script -->
<script src="../bancos/JS/script_consulta_movimiento.js"></script>
</body>
</html>
