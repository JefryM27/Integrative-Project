<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Cuentas Creadas</title>
    <link rel="stylesheet" href="../bancos/css/Styles_cuentas_bancarias.css">

</head>
<body>

<header class="header">
    <button onclick="window.location.href='cuentas_bancarias.php'">
        <img src="../bancos/imagen/atras.png" alt="Atrás">
    </button>
    <h1>Banco de Ahorro y Créditos</h1>
    <button onclick="window.location.href='index.php'">
        <img src="../bancos/imagen/cerrar seccion.png" alt="Cerrar Sesión">
    </button>
</header>

<main class="content">
    <div class="header1">
        <h1>Listado de Cuentas</h1>
    </div>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Número de Cuenta</th>
                    <th>Tipo de Cuenta</th>
                    <th>Saldo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="cuentas">
                <!-- Filas de cuentas se añadirán dinámicamente aquí -->
            </tbody>
        </table>
        <div class="action-buttons">
            <button onclick="window.location.href='cuentas_bancarias.php'">Crear Cuenta</button>
        </div>
    </div>
</main>

<footer class="footer">
    <p>&copy; 2024 Sistema de Gestión Bancaria. Todos los derechos reservados.</p>
</footer>

<script src="../bancos/JS/acciones_js/edit_eliminarcuenta.js"></script>

</body>
</html>
