<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Banco Movimiento</title>
    <link rel="stylesheet" href="../bancos/css/styles_transaciones_registradas.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="page-style">
    <div class="header">
        <div class="top-buttons">
            <button class="left-button" onclick="window.location.href = 'index.php'">
                <img src="../bancos/imagen/atras.png" alt="Atrás">
            </button>
            <h1>Banco de Ahorro y Créditos</h1>
            <button class="right-button" onclick="window.location.href = 'index.php'">
                <img src="../bancos/imagen/cerrar seccion.png" alt="Cerrar Sesión">   
            </button>
        </div>
    </div>

    <main class="main-content">
        <section id="registro" class="content-section">
            <h2 class="text-center mb-4">Registro de Transacciones</h2>
            <p class="text-center mb-5">Captura y almacena todas las transacciones realizadas por los clientes, incluyendo depósitos, retiros, transferencias, pagos de préstamos, entre otros.</p>

            <form class="transaction-form" id="transactionForm">
                <div class="form-group">
                    <label for="tipo">Tipo de Transacción:</label>
                    <select id="tipo" class="form-control" required>
                        <option value="Depósito">Depósito</option>
                        <option value="Retiro">Retiro</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Pago de Préstamo">Pago de Préstamo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="monto">Monto:</label>
                    <input type="number" id="monto" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" id="descripcion" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Registrar Transacción</button>
            </form>

            <div class="transaction-list mt-5" id="transactionList">
                <h3 class="text-center">Transacciones Registradas</h3>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Monto</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody id="transactionTableBody">
                        <!-- Transactions will be dynamically added here -->
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer class="footer text-center">
        <p>&copy; 2024 Sistema de Gestión Bancaria. Todos los derechos reservados.</p>
    </footer>

    <script src="../bancos/JS/script_transacionesregistradas.js"></script>
</body>
</html>
