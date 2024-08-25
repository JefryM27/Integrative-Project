<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipo de Activo</title>
    <link rel="stylesheet" href="../public/css/tipoActivo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <h2>Tipos de Activo</h2>
        <button data-href="vista1.2.php" id="cerrar"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
    </header>
    <div id="tipoActivos" class="tipoActivos">
        <button id="btnAddTipoActivo" class="btn">Agregar Nuevo Tipo de Activo</button>
        <table id="tipoActivoTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Nombre de Activo</th>
                    <th>Clasificación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tipoActivoTableBody">
                <tr>
                    <td>1</td>
                    <td>Mobiliario de Oficina</td>
                    <td>Mobiliario</td>
                    <td>Circulante</td>
                    <td>
                        <button class="btnEditTipoActivo btn">Editar</button>
                        <button onclick="deleteTipoActivo(1)" class="btn">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Equipo de Computo</td>
                    <td>Equipo</td>
                    <td>Fijo</td>
                    <td>
                        <button class="btnEditTipoActivo btn">Editar</button>
                        <button onclick="deleteTipoActivo(2)" class="btn">Eliminar</button>
                    </td>
                </tr>
                <!-- Agrega más tipos de activo aquí -->
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar tipo de activo -->
    <div id="modalCrearTipoActivo" class="modal">
        <div class="modal-content">
            <span id="closeCrearTipoActivo" class="close">&times;</span>
            <div class="form-container">
                <h2>Agregar Nuevo Tipo de Activo</h2>
                <form id="addTipoActivoForm">
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <input type="text" id="descripcion" name="descripcion" required>
                    </div>
                    <div class="form-group">
                        <label for="nombreActivo">Nombre de Activo:</label>
                        <input type="text" id="nombreActivo" name="nombreActivo" required>
                    </div>
                    <div class="form-group">
                        <label for="clasificacion">Clasificación:</label>
                        <select id="clasificacion" name="clasificacion" required>
                            <option value="Fijo">Fijo</option>
                            <option value="Circulante">Circulante</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit">Guardar</button>
                        <button type="button" id="cancelCrearTipoActivo" class="btn">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para editar tipo de activo -->
    <div id="modalEditarTipoActivo" class="modal">
        <div class="modal-content">
            <span id="closeEditarTipoActivo" class="close">&times;</span>
            <div class="form-container">
                <h2>Editar Tipo de Activo</h2>
                <form id="editTipoActivoForm">
                    <div class="form-group">
                        <label for="editDescripcion">Descripción:</label>
                        <input type="text" id="editDescripcion" name="descripcion" required>
                    </div>
                    <div class="form-group">
                        <label for="editNombreActivo">Nombre de Activo:</label>
                        <input type="text" id="editNombreActivo" name="nombreActivo" required>
                    </div>
                    <div class="form-group">
                        <label for="editClasificacion">Clasificación:</label>
                        <select id="editClasificacion" name="clasificacion" required>
                            <option value="Fijo">Fijo</option>
                            <option value="Circulante">Circulante</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit">Guardar Cambios</button>
                        <button type="button" id="cancelEditarTipoActivo" class="btn">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../public/js/tipoActivo.js"></script>
    <footer class="footer">
        <p>&copy; 2024  Todos los derechos reservados.</p>
    </footer>
</body>
</html>
