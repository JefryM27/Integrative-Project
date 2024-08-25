<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/activos.php');

// Obtener el estado de búsqueda del formulario
$searchState = isset($_GET['searchState']) ? trim($_GET['searchState']) : '';

if (isset($_GET['id']) || true) { // Cambiar `true` a `false` para producción
    // Filtrar los activos según el estado
    $activos = obtenerActivos($searchState);
    $clientes = obtenerClientes();
    $tipos = obtenerTiposActivos();
    $localizaciones = obtenerLocalizaciones();
} else {
    header("Location: /pages/inventarioActivos.php");
    exit();
}

// Convertir arrays para acceso rápido por ID
$tiposMap = array_column($tipos, 'descripcion', 'id');
$localizacionesMap = array_column($localizaciones, 'sucursal', 'id');
$clientesMap = array_column($clientes, 'nombre', 'cliente_id');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Activos</title>
    <link rel="stylesheet" href="../public/css/styleInventario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <h2>Inventario de Activos</h2>
        <button data-href="vista1.2.php" id="cerrar"><i class="fas fa-sign-out-alt"></i>Cerrar</button>
    </header>
    <div id="inventario" class="inventory">
        <button id="btnAddAsset" class="btn">Agregar Nuevo Activo</button>

        <!-- Formulario de búsqueda -->
        <form id="searchForm" class="search-form" method="GET">
            <label for="searchState">Buscar por estado:</label>
            <input type="text" id="searchState" name="searchState" placeholder="Estado del activo" value="<?php echo htmlspecialchars($searchState); ?>">
            <button type="submit" id="btnSearch" class="btn">Buscar</button>
        </form>
        
        <table id="assetTable">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Número de Serie</th>
            <th>Valor</th>
            <th>Localización</th>
            <th>Estado</th>
            <th>Propietario</th>
            <th>Fecha de Custodia</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody id="assetTableBody">
    <?php
foreach ($activos as $activo) {
    // Obtener descripciones
    $tipoDescripcion = isset($tiposMap[$activo['id_tipoactivo']]) ? $tiposMap[$activo['id_tipoactivo']] : 'Desconocido';
    $localizacionSucursal = isset($localizacionesMap[$activo['id_localizacion']]) ? $localizacionesMap[$activo['id_localizacion']] : 'Desconocido';
    $propietarioNombre = isset($clientesMap[$activo['id_cliente']]) ? $clientesMap[$activo['id_cliente']] : 'Desconocido';

    echo "<tr>";
    echo "<td>" . htmlspecialchars($activo['nombre_activo']) . "</td>";
    echo "<td>" . htmlspecialchars($tipoDescripcion) . "</td>";
    echo "<td>" . htmlspecialchars($activo['numero_serie']) . "</td>";
    echo "<td>" . htmlspecialchars($activo['valor']) . "</td>";
    echo "<td>" . htmlspecialchars($localizacionSucursal) . "</td>";
    echo "<td>" . htmlspecialchars($activo['estado']) . "</td>";
    echo "<td>" . htmlspecialchars($propietarioNombre) . "</td>";
    echo "<td>" . htmlspecialchars($activo['fecha_adquisicion']) . "</td>";
    echo "<td>
        <button class='btnEditAsset' data-id='" . htmlspecialchars($activo['id']) . "'>Editar</button>
        <form action='/actions/activo/eliminar.php' method='POST' onsubmit='return confirm(\"¿Estás seguro de que deseas eliminar este activo?\");' style='display:inline;'>
            <input type='hidden' name='id' value='" . htmlspecialchars($activo['id']) . "'>
            <button type='submit' class='btn btn-danger'>Eliminar</button>
        </form>
    </td>";
    echo "</tr>";
}
?>
</tbody>
</table>
    </div>

<!-- Modal Crear Activo -->
<div id="modalCrear" class="modal">
    <div class="modal-content">
        <span class="close" id="closeCrear">&times;</span>
        <h2>Agregar Nuevo Activo</h2>
        <form id="addAssetForm" action="/actions/activo/agregar.php" method="POST">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="nombre_activo" required>
            </div>
            <div class="form-group">
                <label for="type">Tipo:</label>
                <select id="addTipy" name="id_tipoactivo" required>
                    <option value="" disabled selected>Seleccione el tipo de activo</option>
                    <?php foreach ($tipos as $tipo): ?>
                        <option value="<?php echo htmlspecialchars($tipo['id']); ?>">
                            <?php echo htmlspecialchars($tipo['descripcion']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="serie">Número de Serie:</label>
                <input type="text" id="serie" name="numero_serie" required>
            </div>
            <div class="form-group">
                <label for="value">Valor:</label>
                <input type="text" id="value" name="valor" required>
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
                <label for="state">Estado:</label>
                <select id="addState" name="estado" required>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                    <option value="mantenimiento">Mantenimiento</option>
                    <option value="retirado">Retirado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="owner">Propietario:</label>
                <select id="addOwner" name="id_cliente" required>
                    <option value="" disabled selected>Seleccione el Propietario</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?php echo htmlspecialchars($cliente['cliente_id']); ?>">
                            <?php echo htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellido']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="custodyDate">Fecha de Adquisición:</label>
                <input type="date" id="custodyDate" name="fecha_adquisicion" required>
            </div>
            <div class="form-group">
                <button type="submit">Guardar</button>
                <button type="button" class="btn" id="cancelCrear">Cancelar</button>
            </div>
        </form>
    </div>
</div>
<!-- Modal Editar Activo -->
<div id="modalEditar" class="modal">
    <div class="modal-content">
        <span class="close" id="closeEditar">&times;</span>
            <h2>Editar Activo</h2>
            <form id="editAssetForm" action="/actions/activo/editar.php" method="POST">
                <input type="hidden" id="editId" name="id" value="<?php echo htmlspecialchars($activo['id']); ?>" required>
                <div class="form-group">
                    <label for="editName">Nombre:</label>
                    <input type="text" id="editName" name="nombre_activo" value="<?php echo htmlspecialchars($activo['nombre_activo']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="editType">Tipo:</label>
                    <select id="editType" name="id_tipoactivo" required>
                        <?php foreach ($tipos as $tipo): ?>
                            <option value="<?php echo htmlspecialchars($tipo['id']); ?>" <?php echo $activo['id_tipoactivo'] == $tipo['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($tipo['descripcion']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editValue">Número de Serie:</label>
                    <input type="text" id="editValue" name="numero_serie" value="<?php echo htmlspecialchars($activo['numero_serie']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="editValor">Valor:</label>
                    <input type="text" id="editValor" name="valor" value="<?php echo htmlspecialchars($activo['valor']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="editLocalizacion">Localización:</label>
                    <select id="editLocalizacion" name="id_localizacion" required>
                        <?php foreach ($localizaciones as $localizacion): ?>
                            <option value="<?php echo htmlspecialchars($localizacion['id']); ?>" <?php echo $activo['id_localizacion'] == $localizacion['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($localizacion['sucursal']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editEstado">Estado:</label>
                    <select id="editEstado" name="estado" required>
                        <option value="activo" <?php echo $activo['estado'] == 'activo' ? 'selected' : ''; ?>>Activo</option>
                        <option value="inactivo" <?php echo $activo['estado'] == 'inactivo' ? 'selected' : ''; ?>>Inactivo</option>
                        <option value="mantenimiento" <?php echo $activo['estado'] == 'mantenimiento' ? 'selected' : ''; ?>>Mantenimiento</option>
                        <option value="retirado" <?php echo $activo['estado'] == 'retirado' ? 'selected' : ''; ?>>Retirado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editPropietario">Propietario:</label>
                    <select id="editPropietario" name="id_cliente" required>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?php echo htmlspecialchars($cliente['cliente_id']); ?>" <?php echo $activo['id_cliente'] == $cliente['cliente_id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellido']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editCustodia">Fecha de Adquisición:</label>
                    <input type="date" id="editCustodia" name="fecha_adquisicion" value="<?php echo htmlspecialchars($activo['fecha_adquisicion']); ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit">Actualizar</button>
                    <button type="button" class="btn" id="cancelEditar">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cerrarBtn = document.getElementById('cerrar');
            cerrarBtn.addEventListener('click', function () {
                window.location.href = this.getAttribute('data-href');
            });

            // Lógica para abrir y cerrar modales
            const modalCrear = document.getElementById('modalCrear');
            const closeCrear = document.getElementById('closeCrear');
            const cancelCrear = document.getElementById('cancelCrear');

            document.getElementById('btnAddAsset').addEventListener('click', function () {
                modalCrear.style.display = 'block';
            });

            closeCrear.addEventListener('click', function () {
                modalCrear.style.display = 'none';
            });

            cancelCrear.addEventListener('click', function () {
                modalCrear.style.display = 'none';
            });

            const modalEditar = document.getElementById('modalEditar');
            const closeEditar = document.getElementById('closeEditar');
            const cancelEditar = document.getElementById('cancelEditar');

            document.querySelectorAll('.btnEditAsset').forEach(button => {
                button.addEventListener('click', function () {
                    // Aquí debes establecer los valores del formulario de edición
                    // Ejemplo:
                    const id = this.getAttribute('data-id');
                    document.getElementById('editId').value = id;
                    modalEditar.style.display = 'block';
                });
            });

            closeEditar.addEventListener('click', function () {
                modalEditar.style.display = 'none';
            });

            cancelEditar.addEventListener('click', function () {
                modalEditar.style.display = 'none';
            });
        });
    </script>
    <script src="../public/js/scripts.js"></script>
</body>
</html>
