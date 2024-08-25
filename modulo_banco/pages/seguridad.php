<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Banco Movimiento</title>
    <link rel="stylesheet" href="../bancos/css/styles_seguridad.css">
</head>
<body>
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

    <main>
        <div class="content">
            <section id="seguridad" class="content-section">
                <h2>Seguridad y Control</h2>
                <p>Implementa medidas de seguridad para proteger la integridad de los datos y evitar fraudes, como
                    autenticación de usuarios, control de accesos y auditoría de transacciones.</p>
                <div class="panel">
                    <button onclick="authenticateUser()">Autenticación de Usuarios</button>
                    <button onclick="accessControl()">Control de Accesos</button>
                    <button onclick="auditTransactions()">Auditoría de Transacciones</button>
                </div>
                <div id="output" class="output">
                    <!-- Aquí se mostrarán los resultados de las acciones -->
                </div>
            </section>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Sistema de Gestión Bancaria. Todos los derechos reservados.</p>
    </footer>

    <script src="../bancos/JS/script_seguridad.js"></script>
</body>
</html>
