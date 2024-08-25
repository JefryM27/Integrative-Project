<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Banco Movimiento</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../bancos/css/styles_automatizacion.css">
</head>
<body data-page="modulo-banco-movimiento">

    <header class="header">
        <div class="top-buttons">
            <button class="btn-back" onclick="window.location.href = 'index.php'">
                <img src="../bancos/imagen/atras.png" alt="">
                
            </button>
            <h1>Banco de Ahorro y Créditos</h1>
            <button class="btn-logout" onclick="window.location.href = 'index.php'">
                <img src="../bancos/imagen/cerrar seccion.png" alt="">
                
            </button>
        </div>
    </header>

    <main class="container py-5 content-scroll">
        <section id="automatizacion" class="content-section">
            <h2>Automatización de Procesos</h2>
            <p>Automatiza procesos comunes como la liquidación de intereses, el cobro de comisiones y el ajuste de saldos, mejorando la eficiencia operativa del banco.</p>
            <div class="panel">
                <button id="liquidacionInteresesBtn" class="btn btn-primary">Liquidar Intereses</button>
                <button id="cobroComisionesBtn" class="btn btn-primary">Cobrar Comisiones</button>
                <button id="ajusteSaldosBtn" class="btn btn-primary">Ajustar Saldos</button>
            </div>
            <div id="log" class="mt-3"></div>

            <h3>Simulación de Movimientos</h3>
            <table id="simulacionTabla" class="table table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Débito</th>
                        <th>Crédito</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los datos de simulación se insertarán aquí -->
                </tbody>
            </table>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Sistema de Gestión Bancaria. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../bancos/js/script_automatizacion.js"></script>

</body>
</html>
