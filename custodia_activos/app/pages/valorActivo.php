<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/valoracionActivo.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/activos.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/tipoActivo.php');

// Obtener el estado de búsqueda del formulario
$searchState = isset($_GET['searchState']) ? trim($_GET['searchState']) : '';

if (isset($_GET['id']) || true) { // Cambiar `true` a `false` para producción
    // Filtrar los activos según el estado
    $valores = obtenerValoracionActivos();
    $activos = obtenerActivos();
    $tipos = obtenerTipoActivos();
    $usuarios = obtenerUsuarios();
    
} else {
    header("Location: /pages/valorActivo.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valoración de Activos</title>
    <link rel="stylesheet" href="../public/css/valor.css">
</head>
<body>
    <header class="header">
        <h1>Valoración de Activos</h1>
        <button data-href="vista1.2.php" id="cerrar"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
    </header>
    <div class="content">
        <button id="createAssetValuationBtn" class="btn">Agregar Valoración de Activo</button>
        <h2>Listado de Valoraciones de Activos</h2>
        <table id="assetValuationTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Activo</th>
            <th>Tipo</th>
            <th>Valor</th>
            <th>Perito</th>
            <th>Observaciones</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody id="assetValuationTableBody">
        <?php foreach ($valores as $valor): ?>
        <tr>
            <td><?php echo htmlspecialchars($valor['id']); ?></td>
            <td><?php echo htmlspecialchars($valor['nombre_activo']); ?></td> <!-- Mostrar nombre del activo -->
            <td><?php echo htmlspecialchars($valor['descripcion_tipo']); ?></td> <!-- Mostrar descripción del tipo -->
            <td><?php echo htmlspecialchars($valor['valor']); ?></td>
            <td><?php echo htmlspecialchars($valor['nombre_perito']); ?></td> <!-- Mostrar nombre del perito -->
            <td><?php echo htmlspecialchars($valor['observaciones']); ?></td>
            <td><?php echo htmlspecialchars($valor['fecha']); ?></td>
            <td>
                <button class="btnEditSecurityBox btn">Editar</button>
                <form method='post' action='/actions/valoracionActivos/eliminar.php' style="display:inline;">
                    <input type='hidden' name='id' value='<?php echo htmlspecialchars($valor['id']); ?>'>
                    <button type='submit' class='btn btn-danger'>Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    </div>

    <!-- Modal para crear/editar valoración de activos -->
    <div id="valuationModal" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <h2 id="modalTitle">Nueva Valoración de Activo</h2>
            <form id="valuationForm">
                <div class="form-group">
                    <label for="asset">Activo:</label>
                    <select id="asset" name="id_activo" required>
                    <option value="" disabled selected>Seleccione el activo</option>
                    <?php foreach ($activos as $activo): ?>
                        <option value="<?php echo htmlspecialchars($activo['id']); ?>">
                            <?php echo htmlspecialchars($activo['nombre_activo']); ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="type">Tipo:</label>
                    <select id="type" name="id_tipoactivo" required>
                    <?php foreach ($tipos as $tipo): ?>
                        <option value="<?php echo htmlspecialchars($activo['id']); ?>">
                            <?php echo htmlspecialchars($activo['descripcion']); ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="valuation">Valor:</label>
                    <input type="text" id="valuation" name="valuation" required>
                </div>
                <div class="form-group">
                    <label for="perito">Perito:</label>
                    <select id="perito" name="id_usuarios" required>
                    <option value="" disabled selected>Seleccione el Perito</option>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?php echo htmlspecialchars($usuario['cliente_id']); ?>">
                            <?php echo htmlspecialchars($usuario['nombre_usuario']); ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones:</label>
                    <textarea id="observaciones" name="observaciones"></textarea>
                </div>
                <div class="form-group">
                    <label for="fechas">Fecha</label>
                    <input type="date" id="fechas" name="fechas" required>
                </div>
                <button type="submit" id="modalSubmitBtn">Guardar</button>
            </form>
        </div>
    </div>
    <footer class="footer">
        <p>&copy; 2024 INCRESSEC. Todos los derechos reservados.</p>
    </footer>
    <script src="../public/js/valor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('valuationModal');
    var openModalBtn = document.getElementById('createAssetValuationBtn');
    var closeModalSpan = document.getElementById('closeModal');
    var form = document.getElementById('valuationForm');
    var tableBody = document.getElementById('assetValuationTableBody');

    function openModal() {
        modal.style.display = 'block';
    }

    function closeModal() {
        modal.style.display = 'none';
    }

    openModalBtn.onclick = function() {
        openModal();
    };

    closeModalSpan.onclick = function() {
        closeModal();
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            closeModal();
        }
    };

    form.onsubmit = function(event) {
        event.preventDefault(); // Evita el envío del formulario por defecto

        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/actions/valoracionActivos/agregar.php', true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                // El formulario se envió correctamente
                // Actualiza la tabla con los nuevos datos
                updateTable();
                closeModal();
            } else {
                // Hubo un error
                console.error('Error al enviar los datos.');
            }
        };

        xhr.send(formData);
    };

    function updateTable() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/actions/valoracionActivos/obtener_valoraciones.php', true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                var valoraciones = JSON.parse(xhr.responseText);
                tableBody.innerHTML = ''; // Limpiar la tabla actual

                valoraciones.forEach(function(valor) {
                    var row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${valor.id}</td>
                        <td>${valor.nombre_activo}</td>
                        <td>${valor.descripcion_tipo}</td>
                        <td>${valor.valor}</td>
                        <td>${valor.nombre_perito}</td>
                        <td>${valor.observaciones}</td>
                        <td>${valor.fecha}</td>
                        <td>
                            <button class="btnEditSecurityBox btn">Editar</button>
                            <form method='post' action='/actions/valoracionActivos/eliminar.php' style="display:inline;">
                                <input type='hidden' name='id' value='${valor.id}'>
                                <button type='submit' class='btn btn-danger'>Eliminar</button>
                            </form>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            } else {
                console.error('Error al obtener los datos.');
            }
        };

        xhr.send();
    }
});
    </script>
</body>
</html>
