<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Banco Movimiento</title>
    <link rel="stylesheet" href="../bancos/css/styles_conciliacion.css">
</head>

<body data-page="modulo-banco-movimiento">
    <div class="header">
        <div class="top-buttons">
            <button onclick="window.location.href = 'index.php'">
                <img src="../bancos/imagen/atras.png" alt="Atrás">
            </button>
            <h1>Banco de Ahorro y Créditos</h1>
            <button onclick="window.location.href = 'index.php'">
                <img src="../bancos/imagen/cerrar seccion.png" alt="Cerrar Sesión">
            </button>
        </div>
    </div>
    <div class="container">
        <section id="conciliacion" class="content-section">
            <h2>Conciliación Bancaria</h2>
            <p>Facilita la conciliación de los movimientos registrados con los extractos bancarios, asegurando que todas
                las transacciones estén correctamente reflejadas y contabilizadas.</p>
            <div class="panel">
                <h3>Panel de Conciliación</h3>
                <div class="actions">
                    <button id="upload-statement">Subir Extracto Bancario</button>
                    <button id="view-transactions">Ver Transacciones</button>
                    <button id="reconcile">Conciliar</button>
                </div>
                <div id="statement-section" class="hidden">
                    <h4>Subir Extracto Bancario</h4>
                    <input type="file" id="statement-file">
                    <button id="upload-file">Subir</button>
                </div>
                <div id="transactions-section" class="hidden">
                    <h4>Transacciones Registradas</h4>
                    <table id="transactions-table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Descripción</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024-06-01</td>
                                <td>Pago Proveedor A</td>
                                <td>$1,000.00</td>
                            </tr>
                            <tr>
                                <td>2024-06-02</td>
                                <td>Depósito Cliente B</td>
                                <td>$500.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <div class="footer">
        <p>&copy; 2024 Sistema de Gestión Bancaria. Todos los derechos reservados.</p>
    </div>

    <script src="../bancos/JS/script_conciliacion.js"></script>
</body>
</html>
