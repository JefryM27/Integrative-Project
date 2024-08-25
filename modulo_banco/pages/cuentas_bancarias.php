<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Cuenta</title>
    <link rel="stylesheet" href="../bancos/css/Styles_cuentas_bancarias.css">
</head>
<body>
<header>
    <div class="top-buttons">
        <button onclick="window.location.href = 'index.php'">
            <img src="../bancos/imagen/atras.png" alt="Atrás">
        </button>
        <h1>Banco de Ahorro y Créditos</h1>
        <button onclick="loadPage('index.php')">
            <img src="../bancos/imagen/cerrar seccion.png" alt="Cerrar Sesión">
        </button>
    </div>
</header>

<main>
    <div class="content">
        <h2>Crear Nueva Cuenta</h2>
        <div class="container">
            <form id="newAccountForm">
                <fieldset>
                    <legend>Información Personal</legend>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre">Nombre Completo:</label>
                            <input type="text" id="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                            <input type="date" id="fechaNacimiento" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="identificacion">Número de Identificación:</label>
                            <input type="text" id="identificacion" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" id="telefono" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="calle" placeholder="Calle" required>
                        <input type="text" id="ciudad" placeholder="Ciudad" required>
                        <input type="text" id="estado" placeholder="Estado/Provincia" required>
                        <input type="text" id="codigoPostal" placeholder="Código Postal" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo Electrónico:</label>
                        <input type="email" id="correo" required>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Información de la Cuenta</legend>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="tipoCuenta">Tipo de Cuenta:</label>
                            <select id="tipoCuenta" required>
                                <option value="ahorros">Elige una Opción</option>
                                <option value="ahorros">Cuenta de Ahorros</option>
                                <option value="ahorros">Cuenta de Créditos</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="moneda">Moneda:</label>
                            <select id="moneda" required>
                                <option value="USD">Elige una Opción</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <option value="CR">CR</option>
                                <option value="ARS">ARS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="saldoInicial">Ahorro Inicial:</label>
                            <input type="number" id="saldoInicial" min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="numeroCuenta">Número de Cuenta:</label>
                            <input type="text" id="numeroCuenta" readonly value="AUTO-GENERATED">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="terminos" required>
                        <label for="terminos">Ver <a href="terminoscrearcuenta.php">Términos y Políticas</a>.</label>
                    </div>
                </fieldset>
                <div class="form-actions">
                    <button type="submit">Crear Cuenta</button>
                    <button type="button" onclick="window.location.href='vercuentas.php'">Cancelar</button>
                </div>
                <div class="action-buttons">
                    <button onclick="window.location.href='cuentasinacciones.php'">Ver Cuentas Creadas</button>
                </div>
            </form>
        </div>
    </div>
</main>

<footer>
    <p>&copy; 2024 Sistema de Gestión Bancaria. Todos los derechos reservados.</p>
</footer>

<script src="../bancos/JS/acciones_js/crearcuentas.js"></script>

</body>
</html>
