<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarifa por Activos</title>
    <link rel="stylesheet" href="../public/css/tarifa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <h2>Tarifa por Activos</h2>
        <button data-href="vista1.2.php" id="cerrar"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
    </header>
    <div id="tarifas" class="tarifas">
        <button id="btnAddTarifa" class="btn">Agregar Nueva Tarifa</button>
        <table id="tarifaTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo de Activo</th>
                    <th>Monto</th>
                    <th>Moneda</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tarifaTableBody">
                <tr>
                    <td>1</td>
                    <td>Equipo de Computo</td>
                    <td>$500</td>
                    <td>Dolares</td>
                    <td>
                        <button class="btnEditTarifa btn">Editar</button>
                        <button onclick="deleteTarifa(1)" class="btn">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Mobiliario de Oficina</td>
                    <td>₡250,000</td>
                    <td>Colones</td>
                    <td>
                        <button class="btnEditTarifa btn">Editar</button>
                        <button onclick="deleteTarifa(2)" class="btn">Eliminar</button>
                    </td>
                </tr>
                <!-- Agrega más tarifas aquí -->
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar tarifa -->
    <div id="modalCrearTarifa" class="modal">
        <div class="modal-content">
            <span id="closeCrearTarifa" class="close">&times;</span>
            <div class="form-container">
                <h2>Agregar Nueva Tarifa</h2>
                <form id="addTarifaForm">
                    <div class="form-group">
                        <label for="tipoActivo">Tipo de Activo:</label>
                        <select id="tipoActivo" name="tipoActivo" required>
                            <option value="Equipo de Computo">Equipo de Computo</option>
                            <option value="Mobiliario de Oficina">Mobiliario de Oficina</option>
                            <option value="Vehículo">Vehículo</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="monto">Monto:</label>
                        <input type="text" id="monto" name="monto" required>
                    </div>
                    <div class="form-group">
                        <label for="moneda">Moneda:</label>
                        <input type="text" id="moneda" name="moneda" placeholder="Colones, Dolares, Euros" required>
                    </div>
                    <div class="form-group">
                        <button type="submit">Guardar</button>
                        <button type="button" id="cancelCrearTarifa" class="btn">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para editar tarifa -->
    <div id="modalEditarTarifa" class="modal">
        <div class="modal-content">
            <span id="closeEditarTarifa" class="close">&times;</span>
            <div class="form-container">
                <h2>Editar Tarifa</h2>
                <form id="editTarifaForm">
                    <div class="form-group">
                        <label for="editTipoActivo">Tipo de Activo:</label>
                        <select id="editTipoActivo" name="tipoActivo" required>
                            <option value="Equipo de Computo">Equipo de Computo</option>
                            <option value="Mobiliario de Oficina">Mobiliario de Oficina</option>
                            <option value="Vehículo">Vehículo</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editMonto">Monto:</label>
                        <input type="text" id="editMonto" name="monto" required>
                    </div>
                    <div class="form-group">
                        <label for="editMoneda">Moneda:</label>
                        <input type="text" id="editMoneda" name="moneda" placeholder="Colones, Dolares, Euros" required>
                    </div>
                    <div class="form-group">
                        <button type="submit">Guardar Cambios</button>
                        <button type="button" id="cancelEditarTarifa" class="btn">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../public/js/tarifa.js"></script>
    <footer class="footer">
        <p>&copy; 2024  Todos los derechos reservados.</p>
    </footer>
</body>
</html>
