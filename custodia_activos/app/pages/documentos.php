<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Documentos</title>
    <link rel="stylesheet" href="../public/css/documentos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <h2>Gestión de Documentos</h2>
        <button data-href="vista1.2.php" id="cerrar"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
    </header>
    <div id="documents" class="documents">
        <button id="btnAddDocument" class="btn">Agregar Nuevo Documento</button>
        <table id="documentTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Tipo de Activo</th>
                    <th>Localización</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="documentTableBody">
                <tr>
                    <td>1</td>
                    <td>Documento 1</td>
                    <td>2023-05-01</td>
                    <td>Archivo</td>
                    <td>Almacén Central</td>
                    <td>
                        <button class="btnEditDocument btn">Editar</button>
                        <button onclick="deleteDocument(1)" class="btn">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Documento 2</td>
                    <td>2023-06-15</td>
                    <td>Informe</td>
                    <td>Sucursal Norte</td>
                    <td>
                        <button class="btnEditDocument btn">Editar</button>
                        <button onclick="deleteDocument(2)" class="btn">Eliminar</button>
                    </td>
                </tr>
                <!-- Agrega más documentos aquí -->
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar documento -->
    <div id="modalCrear" class="modal">
        <div class="modal-content">
            <span id="closeCrear" class="close">&times;</span>
            <div class="form-container">
                <h2>Agregar Nuevo Documento</h2>
                <form id="addDocumentForm">
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <input type="text" id="descripcion" name="descripcion" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" name="fecha" required>
                    </div>
                    <div class="form-group">
                        <label for="tipoActivo">Tipo de Activo:</label>
                        <select id="tipoActivo" name="tipoActivo" required>
                            <option value="">Selecciona un tipo de activo</option>
                            <option value="Archivo">Archivo</option>
                            <option value="Informe">Informe</option>
                            <option value="Contrato">Contrato</option>
                            <option value="Factura">Factura</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="localizacion">Localización:</label>
                        <select id="localizacion" name="localizacion" required>
                            <option value="">Selecciona una localización</option>
                            <option value="Almacén Central">Almacén Central</option>
                            <option value="Sucursal Norte">Sucursal Norte</option>
                            <option value="Sucursal Sur">Sucursal Sur</option>
                            <option value="Oficina Principal">Oficina Principal</option>
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

    <!-- Modal para editar documento -->
    <div id="modalEditar" class="modal">
        <div class="modal-content">
            <span id="closeEditar" class="close">&times;</span>
            <div class="form-container">
                <h2>Editar Documento</h2>
                <form id="editDocumentForm">
                    <div class="form-group">
                        <label for="editDescripcion">Descripción:</label>
                        <input type="text" id="editDescripcion" name="descripcion" required>
                    </div>
                    <div class="form-group">
                        <label for="editFecha">Fecha:</label>
                        <input type="date" id="editFecha" name="fecha" required>
                    </div>
                    <div class="form-group">
                        <label for="editTipoActivo">Tipo de Activo:</label>
                        <select id="editTipoActivo" name="tipoActivo" required>
                            <option value="">Selecciona un tipo de activo</option>
                            <option value="Archivo">Archivo</option>
                            <option value="Informe">Informe</option>
                            <option value="Contrato">Contrato</option>
                            <option value="Factura">Factura</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editLocalizacion">Localización:</label>
                        <select id="editLocalizacion" name="localizacion" required>
                            <option value="">Selecciona una localización</option>
                            <option value="Almacén Central">Almacén Central</option>
                            <option value="Sucursal Norte">Sucursal Norte</option>
                            <option value="Sucursal Sur">Sucursal Sur</option>
                            <option value="Oficina Principal">Oficina Principal</option>
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

    <script src="../public/js/documentos.js"></script>
    <footer class="footer">
        <p>&copy; 2024 Todos los derechos reservados.</p>
    </footer>
</body>
</html>
