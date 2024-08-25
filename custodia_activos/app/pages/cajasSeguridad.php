<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/cajaSeguridad.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/localizacion.php');


if (isset($_GET['id']) || true) { // Cambiar `true` a `false` para producción
  // Obtener todas las cajas de seguridad
$cajas = obtenertCajaSeguridades();
$localizaciones = obtenerLocalizaciones();
} else {
    header("Location: /pages/cajasSeguridad.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cajas de Seguridad</title>
    <link rel="stylesheet" href="../public/css/cajasSeguridad.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <h2>Cajas de Seguridad</h2>
        <button data-href="/pages/vista1.2.php" id="cerrar"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
    </header>
    <div id="securityBoxes" class="security-boxes">
        <button id="btnAddSecurityBox" class="btn">Agregar Nueva Caja de Seguridad</button>
        <table id="securityBoxTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Localización</th>
                    <th>Número de Caja</th>
                    <th>Capacidad</th>
                    <th>Disponibilidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="securityBoxTableBody">
            <?php foreach ($cajas as $caja): ?>
                <tr>
                    <td><?php echo htmlspecialchars($caja['id']); ?></td>
                    <td><?php echo htmlspecialchars($caja['nombre_caja']); ?></td>
                    <td><?php echo htmlspecialchars($caja['sucursal']); ?></td>
                    <td><?php echo htmlspecialchars($caja['numero_caja']); ?></td>
                    <td><?php echo htmlspecialchars($caja['capacidad']); ?></td>
                    <td><?php echo htmlspecialchars($caja['disponibilidad']); ?></td>
                    <td>
                        <button class="btnEditSecurityBox btn">Editar</button>
                        <form method='post' action='/actions/cajaSeguridad/eliminar.php'>
                            <input type='hidden' name='id' value='<?php echo htmlspecialchars($caja['id']); ?>'>
                            <button type='submit' class='btn btn-danger'>Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
</tbody>
        </table>
    </div>

    <!-- Modal para agregar caja de seguridad -->
    <div id="modalCrear" class="modal">
        <div class="modal-content">
            <span id="closeCrear" class="close">&times;</span>
            <div class="form-container">
                <h2>Agregar Nueva Caja de Seguridad</h2>
                <form id="addSecurityBoxForm" method="post" action="/actions/cajaSeguridad/agregar.php">
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" id="addName" name="nombre_caja" value="<?php echo htmlspecialchars($caja['nombre_caja']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Localización:</label>
                        <select id="addLocalizacion" name="id_localizacion" required>
                    <option value="" disabled selected>Seleccione la localización</option>
                    <?php foreach ($localizaciones as $localizacion): ?>
                        <option value="<?php echo htmlspecialchars($localizacion['id']); ?>">
                            <?php echo htmlspecialchars($localizacion['sucursal']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                    </div>
                    <div class="form-group">
                        <label for="boxNumber">Número de Caja:</label>
                        <input type="text" id="editValue" name="numero_caja" value="<?php echo htmlspecialchars($caja['numero_caja']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="capacity">Capacidad:</label>
                        <input type="number" id="addCapacidad" name="capacidad" value="<?php echo htmlspecialchars($caja['capacidad']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="availability">Disponibilidad:</label>
                        <select id="addAvailability" name="disponibilidad" required>
                        <option value="1" <?php echo $caja['disponibilidad'] == 'sí' ? 'selected' : ''; ?>>Sí</option>
                        <option value="0" <?php echo $caja['disponibilidad'] == 'no' ? 'selected' : ''; ?>>No</option>
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

    <!-- Modal para editar caja de seguridad -->
    <div id="modalEditar" class="modal">
        <div class="modal-content">
            <span id="closeEditar" class="close">&times;</span>
            <div class="form-container">
                <h2>Editar Caja de Seguridad</h2>
                <form id="editSecurityBoxForm" method="post" action="/actions/cajaSeguridad/editar.php">
                <input type="hidden" id="editId" name="id" value="<?php echo htmlspecialchars($caja['id']); ?>" required>
                    <div class="form-group">
                        <label for="editName">Nombre:</label>
                        <input type="text" id="editName" name="nombre_caja" value="<?php echo htmlspecialchars($caja['nombre_caja']); ?>" required>
                    </div>
                    <div class="form-group">
                    <label for="editLocalizacion">Localización:</label>
                    <select id="editLocalizacion" name="id_localizacion" required>
                        <?php foreach ($localizaciones as $localizacion): ?>
                            <option value="<?php echo htmlspecialchars($localizacion['id']); ?>" <?php echo $caja['id_localizacion'] == $localizacion['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($localizacion['sucursal']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="editBoxNumber">Número de Caja:</label>
                        <input type="text" id="editValue" name="numero_caja" value="<?php echo htmlspecialchars($caja['numero_caja']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="editCapacity">Capacidad:</label>
                        <input type="number" id="editValor" name="capacidad" value="<?php echo htmlspecialchars($caja['capacidad']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="editAvailability">Disponibilidad:</label>
                        <select id="editAvailability" name="disponibilidad" required>
                        <option value="1" <?php echo $caja['disponibilidad'] == 'sí' ? 'selected' : ''; ?>>Sí</option>
                        <option value="0" <?php echo $caja['disponibilidad'] == 'no' ? 'selected' : ''; ?>>No</option>
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

    <script src="../public/js/cajaSegu.js"></script>
    <footer class="footer">
        <p>&copy; 2024 Todos los derechos reservados.</p>
    </footer>
</body>
</html>
