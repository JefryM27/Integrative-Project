<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localización de Activos</title>
    <link rel="stylesheet" href="../public/css/localizacion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <h2>Localización de Activos</h2>
        <button data-href="vista1.2.php" id="cerrar"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
    </header>
    <div id="localizations" class="localizations">
        <button id="btnAddLocalization" class="btn">Agregar Nueva Localización</button>
        <table id="localizationTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Número de expediente</th>
                    <th>Sucursal</th>
                    <th>Archivo</th>
                    <th>ID de la bóveda</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="localizationTableBody">
                <tr>
                    <td>1</td>
                    <td>EXP001</td>
                    <td>Sucursal Central</td>
                    <td>Archivo General</td>
                    <td>BOVEDA1</td>
                    <td>
                        <button class="btnEditLocalization btn" onclick="editLocalization(1, 'EXP001', 'Sucursal Central', 'Archivo General', 'BOVEDA1')">Editar</button>
                        <button onclick="deleteLocalization(1)" class="btn">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>EXP002</td>
                    <td>Sucursal Norte</td>
                    <td>Archivo Regional</td>
                    <td>BOVEDA2</td>
                    <td>
                        <button class="btnEditLocalization btn" onclick="editLocalization(2, 'EXP002', 'Sucursal Norte', 'Archivo Regional', 'BOVEDA2')">Editar</button>
                        <button onclick="deleteLocalization(2)" class="btn">Eliminar</button>
                    </td>
                </tr>
                <!-- Agrega más localizaciones aquí -->
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar localización -->
    <div id="modalCrear" class="modal">
        <div class="modal-content">
            <span id="closeCrear" class="close">&times;</span>
            <div class="form-container">
                <h2>Agregar Nueva Localización</h2>
                <form id="addLocalizationForm">
                    <div class="form-group">
                        <label for="expediente">Número de expediente:</label>
                        <input type="text" id="expediente" name="expediente" required>
                    </div>
                    <div class="form-group">
                        <label for="sucursal">Sucursal:</label>
                        <input type="text" id="sucursal" name="sucursal" required>
                    </div>
                    <div class="form-group">
                        <label for="archivo">Archivo:</label>
                        <input type="text" id="archivo" name="archivo" required>
                    </div>
                    <div class="form-group">
                        <label for="boveda">Bóveda:</label>
                        <select id="boveda" name="boveda" required>
                            <option value="">Selecciona una bóveda</option>
                            <option value="BOVEDA1">BÓVEDA1</option>
                            <option value="BOVEDA2">BÓVEDA2</option>
                            <option value="BOVEDA3">BÓVEDA3</option>
                            <!-- Agrega más opciones según sea necesario -->
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit">Guardar</button>
                        <button type="button" id="cancelCrear" class="btn">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para editar localización -->
    <div id="modalEditar" class="modal">
        <div class="modal-content">
            <span id="closeEditar" class="close">&times;</span>
            <div class="form-container">
                <h2>Editar Localización</h2>
                <form id="editLocalizationForm">
                    <div class="form-group">
                        <label for="editExpediente">Número de expediente:</label>
                        <input type="text" id="editExpediente" name="expediente" required>
                    </div>
                    <div class="form-group">
                        <label for="editSucursal">Sucursal:</label>
                        <input type="text" id="editSucursal" name="sucursal" required>
                    </div>
                    <div class="form-group">
                        <label for="editArchivo">Archivo:</label>
                        <input type="text" id="editArchivo" name="archivo" required>
                    </div>
                    <div class="form-group">
                        <label for="editBoveda">Bóveda:</label>
                        <select id="editBoveda" name="boveda" required>
                            <option value="">Selecciona una bóveda</option>
                            <option value="BOVEDA1">BÓVEDA1</option>
                            <option value="BOVEDA2">BÓVEDA2</option>
                            <option value="BOVEDA3">BÓVEDA3</option>
                            <!-- Agrega más opciones según sea necesario -->
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit">Guardar Cambios</button>
                        <button type="button" id="cancelEditar" class="btn">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../public/js/localizacion.js"></script>
    <footer class="footer">
        <p>&copy; 2024 Todos los derechos reservados.</p>
    </footer>
</body>
</html>
