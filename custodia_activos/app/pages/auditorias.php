<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/auditoria.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/activos.php');

// Guardar la auditoría si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['auditDate'];
    $id_activo = $_POST['auditActivo'];
    $resultado = $_POST['auditResultado'];

    // Validar y sanear los datos si es necesario

    // Insertar la auditoría en la base de datos
    $resultado_guardado = crearAuditoria($fecha, $id_activo, $resultado);

    if ($resultado_guardado) {
        // Redireccionar para evitar reenvío del formulario
        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    } else {
        $error = "Error al guardar la auditoría.";
    }
}

// Obtener las auditorías y activos para mostrarlas en la tabla
$auditorias = obtenerAuditorias();
$activos = obtenerActivos();

// Crear un array asociativo que relacione los IDs de los activos con sus nombres
$activoNombres = [];
foreach ($activos as $activo) {
    $activoNombres[$activo['id']] = $activo['nombre_activo'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditorías</title>
    <link rel="stylesheet" href="../public/css/auditorias.css">
</head>
<body>
    <header class="header">
        <h1>Gestión de Auditorías</h1>
        <button data-href="vista1.2.php" id="cerrar"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
    </header>
    <div id="auditList" class="audit-list">
        <button id="createAuditBtn" class="btn">Crear Nueva Auditoría</button>
        <h2>Listado de Auditorías</h2>
        <table id="auditTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Activo</th>
                    <th>Resultado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="auditTableBody">
            <?php foreach ($auditorias as $auditoria): ?>
                <tr>
                    <td><?php echo htmlspecialchars($auditoria['id']); ?></td>
                    <td><?php echo htmlspecialchars($auditoria['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($activoNombres[$auditoria['id_activo']]); ?></td> <!-- Mostrar nombre del activo -->
                    <td><?php echo htmlspecialchars($auditoria['resultado']); ?></td>
                    <td>
                        <button class="btnEditSecurityBox btn">Editar</button>
                        <form method='post' action='/actions/auditoria/eliminar.php'>
                            <input type='hidden' name='id' value='<?php echo htmlspecialchars($auditoria['id']); ?>'>
                            <button type='submit' class='btn btn-danger'>Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para crear/editar auditoría -->
    <div id="auditModal" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <h2 id="modalTitle">Nueva Auditoría</h2>
            <form id="audiForm" action="/actions/auditoria/agregar.php" method="POST">
                <div class="form-group">
                    <label for="auditDate">Fecha:</label>
                    <input type="date" id="auditDate" name="auditDate" required>
                </div>
                <div class="form-group">
                    <label for="auditActivo">Activo:</label>
                    <select id="auditActivo" name="auditActivo" required>
                        <option value="">Selecciona un activo</option>
                        <?php foreach ($activos as $activo): ?>
                            <option value="<?php echo htmlspecialchars($activo['id']); ?>">
                                <?php echo htmlspecialchars($activo['nombre_activo']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="auditResultado">Resultado:</label>
                    <textarea id="auditResultado" name="auditResultado" required></textarea>
                </div>
                <button type="submit" id="modalSubmitBtn">Guardar</button>
            </form>
        </div>
    </div>
    <footer class="footer">
        <p>&copy; 2024  Todos los derechos reservados.</p>
    </footer>
    <script src="../public/js/auditorias.js"></script>
    <script>
   document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('auditModal');
    var openModalBtn = document.getElementById('createAuditBtn');
    var closeModalSpan = document.getElementById('closeModal');
    var form = document.getElementById('audiForm');

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
        xhr.open('POST', '/actions/auditoria/agregar.php', true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    updateTable(); // Actualiza la tabla con los nuevos datos
                    closeModal(); // Cierra el modal
                } else {
                    console.error('Error al guardar la auditoría:', response.message);
                }
            } else {
                console.error('Error al enviar los datos.');
            }
        };

        xhr.send(formData);
    };

    function updateTable() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/actions/auditoria/obtener_auditorias.php', true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                var auditorias = JSON.parse(xhr.responseText);
                var tableBody = document.getElementById('auditTableBody');
                tableBody.innerHTML = ''; // Limpiar la tabla actual

                auditorias.forEach(function(auditoria) {
                    var row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${auditoria.id}</td>
                        <td>${auditoria.fecha}</td>
                        <td>${auditoria.nombre_activo}</td>
                        <td>${auditoria.resultado}</td>
                        <td>
                            <button class="btnEditSecurityBox btn">Editar</button>
                            <form method='post' action='/actions/auditoria/eliminar.php' style="display:inline;">
                                <input type='hidden' name='id' value='${auditoria.id}'>
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
