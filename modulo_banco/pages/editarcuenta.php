
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cuenta</title>
    <link rel="stylesheet" href="../bancos/css/style_editarcuentas.css">
</head>
<body>
<main>
    <div class="content">
        <div class="header">
        <div class="top-buttons">
            <button onclick="window.location.href = 'cuentas_bancarias.php'">
                <img src="../bancos/imagen/atras.png" alt="Atrás">
            </button>
            <h1>Banco de Ahorro y Créditos</h1>
            <button onclick="loadPage('index.php')">
                <img src="../bancos/imagen/cerrar seccion.png" alt="Cerrar Sesión">
            </button>
        </div>
    </div>
    <div class="header1">
        <h1>Editar Cuenta</h1>
    </div>
    <div class="container">
        <form id="editAccountForm">
            <!-- Campos para editar la cuenta -->
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
                            <option value="corriente">Cuenta Corriente</option>
                            <option value="ahorros">Cuenta de Ahorros</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="moneda">Moneda:</label>
                        <select id="moneda" required>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="saldoInicial">Saldo Inicial:</label>
                        <input type="number" id="saldoInicial" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="numeroCuenta">Número de Cuenta:</label>
                        <input type="text" id="numeroCuenta" readonly>
                    </div>
                </div>
            </fieldset>
            <div class="form-actions">
                <button type="submit">Guardar Cambios</button>
                <button type="button" onclick="window.location.href='vercuentas.php'">Cancelar</button>
            </div>
        </form>
    </div>
    <div class="footer">
        <p>&copy; 2024 Sistema de Gestión Bancaria. Todos los derechos reservados.</p>
    </div>
    <script src="../bancos/JS/acciones_js/editarcuenta.js"></script>
    </div>
</main>
</body>
</html>
