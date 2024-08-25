<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="../bancos/css/styles_index.css">
</head>
<body>

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

<main>
    <div class="container-buttons">
        <button onclick="window.location.href='cuentas_bancarias.php'">
            <img src="../bancos/imagen/cuentas_bancarias.png" alt="Icon 1">
            Crear Cuenta Bancaria
        </button>
        <button onclick="window.location.href='automatizacion.php'">
            <img src="../bancos/imagen/automatizacion_bancaria.png" alt="Icon 2">
            Automatizacion
        </button>
        <button onclick="window.location.href='conciliacion.php'">
            <img src="../bancos/imagen/conciliacion_bancaria.png" alt="Icon 3">
            Conciliacion Bancaria
        </button>
        <button onclick="window.location.href='consulta_movimiento.php'">
            <img src="../bancos/imagen/Consulta_de_movimiento.png" alt="Icon 4">
            Consulta de movimientos
        </button>
        <button onclick="window.location.href='generacion_reportes.php'">
            <img src="../bancos/imagen/generacion de reportes.png" alt="Icon 5">
            Generar reportes
        </button>
        <button onclick="window.location.href='transaciones_registradas.php'">
            <img src="../bancos/imagen/registro.png" alt="Icon 6">
            Transferecias registradas
        </button>
        <button onclick="window.location.href='seguridad.php'">
            <img src="../bancos/imagen/seguridad.png" alt="Icon 7">
            Seguridad
        </button>
    </div>
</main>

<div class="footer">
    <p>&copy; 2024 Sistema de Gestión Bancaria. Todos los derechos reservados.</p>
</div>

</body>
</html>
