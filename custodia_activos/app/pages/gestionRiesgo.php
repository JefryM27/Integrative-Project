<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/riesgo.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/activos.php');

if (isset($_GET['id']) || true) { // Cambiar `true` a `false` para producción
    // Filtrar los activos según el estado
    $riesgos = obtenerRiesgos();
    $activos = obtenerActivos();
} else {
    header("Location: /pages/gestionRiesgo.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Riesgos</title>
    <link rel="stylesheet" href="../public/css/gestionRiesgo.css">
</head>

<body>
    <header class="header">
        <h1>Gestión de Riesgos</h1>
        <button data-href="vista1.2.php" id="cerrar"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
    </header>
    <div class="content">
        <button id="createRiskBtn" class="btn">Agregar Nuevo Riesgo</button>
        <h2>Listado de Riesgos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Activo</th>
                    <th>Descripción</th>
                    <th>Nivel</th>
                    <th>Tipo de riesgo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="riskTableBody">
            <?php foreach ($riesgos as $riesgo): ?>
                <tr>
                    <td><?php echo htmlspecialchars($riesgo['id']); ?></td>
                    <td><?php echo htmlspecialchars($riesgo['descripcion']); ?></td>
                    <td><?php echo htmlspecialchars($riesgo['nivel']); ?></td>
                    <td><?php echo htmlspecialchars($riesgo['id_activo']); ?></td>
                    <td><?php echo htmlspecialchars($riesgo['tipo_riesgo']); ?></td>
                    <td>
                        <button class="btnEditSecurityBox btn">Editar</button>
                        <form method='post' action='/actions/riesgo/eliminar.php'>
                            <input type='hidden' name='id' value='<?php echo htmlspecialchars($riesgo['id']); ?>'>
                            <button type='submit' class='btn btn-danger'>Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar/editar riesgo -->
    <div id="modalCrear" class="modal">
        <div class="modal-content">
            <span id="closeCrear" class="close">&times;</span>
            <h2 id="modalTitle">Nuevo Riesgo</h2>
            <form id="addRiskForm">
                <div class="form-group">
                    <label for="riskActivo">Activo:</label>
                    <select id="riskActivo" name="riskActivo" required>
                    <option value="" disabled selected>Seleccione el activo</option>
                    <?php foreach ($activos as $activo): ?>
                        <option value="<?php echo htmlspecialchars($activo['id']); ?>">
                            <?php echo htmlspecialchars($activo['nombre_activo']); ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="riskDescription">Descripción:</label>
                    <input type="text" id="riskDescription" name="riskDescription" required>
                </div>
                <div class="form-group">
                    <label for="riskLevel">Nivel:</label>
                    <select id="riskLevel" name="riskLevel" required>
                        <option value="">Selecciona el nivel</option>
                        <option value="Alto">Alto</option>
                        <option value="Medio">Medio</option>
                        <option value="Bajo">Bajo</option>
                    </select>
                    <div class="form-group">
                        <label for="riskTipoRiesgo">Tipo de riesgo:</label>
                        <input type="text" id="riskTipoRiesgo" name="riskTipoRiesgo" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" id="modalSubmitBtn" class="btn">Guardar</button>
                    <button type="button" id="cancelCrear" class="btn">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function () {
    const createRiskBtn = document.getElementById('createRiskBtn');
    const modalCrear = document.getElementById('modalCrear');
    const closeCrear = document.getElementById('closeCrear');
    const addRiskForm = document.getElementById('addRiskForm');
    const modalTitle = document.getElementById('modalTitle');
    const riskActivo = document.getElementById('riskActivo');
    const riskDescription = document.getElementById('riskDescription');
    const riskLevel = document.getElementById('riskLevel');
    const riskTipoRiesgo = document.getElementById('riskTipoRiesgo');
    let editMode = false;
    let currentRiskId = null;

    createRiskBtn.addEventListener('click', () => {
        modalTitle.textContent = 'Nuevo Riesgo';
        addRiskForm.reset();
        currentRiskId = null;
        editMode = false;
        modalCrear.style.display = 'block';
    });

    closeCrear.addEventListener('click', () => {
        modalCrear.style.display = 'none';
    });

    document.getElementById('cerrar').addEventListener('click', function () {
        window.location.href = this.getAttribute('data-href');
    });

    window.addEventListener('click', (event) => {
        if (event.target === modalCrear) {
            modalCrear.style.display = 'none';
        }
    });

    addRiskForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const activoId = riskActivo.value;
        const activoText = riskActivo.options[riskActivo.selectedIndex].text; // Obtener la descripción del activo
        const descripcion = riskDescription.value;
        const nivel = riskLevel.value;
        const tipoRiesgo = riskTipoRiesgo.value;

        if (editMode) {
            // Lógica para actualizar un riesgo existente
            const row = document.getElementById(`risk-${currentRiskId}`);
            row.children[1].textContent = activoText;
            row.children[2].textContent = descripcion;
            row.children[3].textContent = nivel;
            row.children[4].textContent = tipoRiesgo;
        } else {
            // Lógica para agregar un nuevo riesgo
            const newId = document.querySelectorAll('#riskTableBody tr').length + 1;
            const newRow = `
                <tr id="risk-${newId}">
                    <td>${newId}</td>
                    <td>${activoText}</td> <!-- Mostrar la descripción del activo -->
                    <td>${descripcion}</td>
                    <td>${nivel}</td>
                    <td>${tipoRiesgo}</td>
                    <td>
                        <button class="btnEditRisk btn" onclick="editRisk(${newId}, '${activoId}', '${descripcion}', '${nivel}', '${tipoRiesgo}')">Editar</button>
                        <button onclick="deleteRisk(${newId})" class="btn btn-danger">Eliminar</button>
                    </td>
                </tr>
            `;
            document.querySelector('#riskTableBody').insertAdjacentHTML('beforeend', newRow);
        }

        modalCrear.style.display = 'none';
    });

    window.editRisk = function (id, activoId, descripcion, nivel, tipoRiesgo) {
        modalTitle.textContent = 'Editar Riesgo';
        riskActivo.value = activoId;
        riskDescription.value = descripcion;
        riskLevel.value = nivel;
        riskTipoRiesgo.value = tipoRiesgo;
        currentRiskId = id;
        editMode = true;
        modalCrear.style.display = 'block';
    };

    window.deleteRisk = function (id) {
        const row = document.getElementById(`risk-${id}`);
        row.remove();
    };
});
    </script>

    <footer>
        <p>&copy; 2024  Todos los derechos reservados.</p>
    </footer>
</body>

</html>