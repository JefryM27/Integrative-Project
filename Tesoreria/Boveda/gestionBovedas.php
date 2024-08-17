<?php
include '../utils/database.php';

$conn = get_mysql_connection();

// Consulta SQL para obtener las organizaciones
$query_orgs = "SELECT organizacion_id, nombre FROM organizaciones";
$result_orgs = $conn->query($query_orgs);

$organizations = [];
while ($row = $result_orgs->fetch_assoc()) {
    $organizations[] = $row;
}

// Función para obtener la información de una bóveda específica
function getBovedaById($conn, $id)
{
    $stmt = $conn->prepare("SELECT * FROM boveda WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $boveda = $result->fetch_assoc();
    $stmt->close();
    return $boveda;
}

// Manejar la creación, edición y eliminación de bóvedas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Crear Bóveda
        if ($action === 'create') {
            $responsable = $_POST['responsable'];
            $ubicacion = $_POST['ubicacion'];
            $monto_crc = $_POST['monto_crc'];
            $monto_usd = $_POST['monto_usd'];
            $monto_eur = $_POST['monto_eur'];
            $id_organizacion = $_POST['id_organizacion'];

            $stmt = $conn->prepare("INSERT INTO boveda (responsable, ubicacion, monto_crc, monto_usd, monto_eur, id_organizacion) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ssdddi', $responsable, $ubicacion, $monto_crc, $monto_usd, $monto_eur, $id_organizacion);
            $stmt->execute();
            $stmt->close();
        }

        // Editar Bóveda
        if ($action === 'edit') {
            $id = $_POST['id'];
            $responsable = $_POST['responsable'];
            $ubicacion = $_POST['ubicacion'];
            $monto_crc = $_POST['monto_crc'];
            $monto_usd = $_POST['monto_usd'];
            $monto_eur = $_POST['monto_eur'];
            $id_organizacion = $_POST['id_organizacion'];

            $stmt = $conn->prepare("UPDATE boveda SET responsable = ?, ubicacion = ?, monto_crc = ?, monto_usd = ?, monto_eur = ?, id_organizacion = ? WHERE id = ?");
            $stmt->bind_param('ssddiii', $responsable, $ubicacion, $monto_crc, $monto_usd, $monto_eur, $id_organizacion, $id);
            $stmt->execute();
            $stmt->close();
        }

        // Eliminar Bóveda
        if ($action === 'delete') {
            $id = $_POST['id'];

            $stmt = $conn->prepare("DELETE FROM boveda WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();
        }

        // Redirigir para evitar el reenvío de formulario al recargar
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Consulta SQL para obtener los datos de la boveda junto con el nombre de la organización
$query = "
    SELECT b.id, b.responsable, b.ubicacion, b.monto_crc, b.monto_usd, b.monto_eur, b.id_organizacion, o.nombre AS nombre_organizacion
    FROM boveda b
    JOIN organizaciones o ON b.id_organizacion = o.organizacion_id
    ORDER BY b.id ASC";

$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Bóvedas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="header d-flex justify-content-between align-items-center px-3 py-2">
        <div>
            <a href="../index.html" class="btn btn-light mx-3 my-2">Volver</a>
        </div>
        <h3 class="text-center flex-grow-1">Gestión de Bóvedas</h3>
        <h5 class="navbar navbar-light">logo</h5>
    </div>
    <div class="container-fluid">
    <div class="content">
        <div class="row justify-content-center mt-2">
            <div class="col-md-10">

                <!-- Combobox para filtrar por organización -->
                <div class="col-md-4 mb-3">
                    <label for="filtro_organizacion" class="form-label">Filtrar por Organización:</label>
                    <select class="form-select" id="filtro_organizacion" onchange="filtrarPorOrganizacion()">
                        <option value="">Todas las Organizaciones</option>
                        <?php foreach ($organizations as $org): ?>
                            <option value="<?php echo $org['organizacion_id']; ?>"><?php echo $org['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="table-responsive mt-4" style="max-height: 441px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Responsable</th>
                                <th>Ubicación</th>
                                <th>Monto CRC</th>
                                <th>Monto USD</th>
                                <th>Monto EUR</th>
                                <th>Nombre de la Organización</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="bovedas_tbody">
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr data-organizacion-id="<?php echo $row['id_organizacion']; ?>">
                                    <td><a href="boveda.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
                                    <td><?php echo $row['responsable']; ?></td>
                                    <td><?php echo $row['ubicacion']; ?></td>
                                    <td><?php echo number_format($row['monto_crc'], 2); ?></td>
                                    <td><?php echo number_format($row['monto_usd'], 2); ?></td>
                                    <td><?php echo number_format($row['monto_eur'], 2); ?></td>
                                    <td><?php echo $row['nombre_organizacion']; ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-lg btn-sm mx-1"
                                            onclick="openEditModal(<?php echo $row['id']; ?>)">Editar</button>
                                        <button class="btn btn-danger btn-lg btn-sm mx-1"
                                            onclick="openDeleteModal(<?php echo $row['id']; ?>)">Eliminar</button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary btn-lg btn-sm mx-1" data-bs-toggle="modal"
                    data-bs-target="#modalCrearBoveda">Crear Bóveda</button>
            </div>
        </div>
    </div>
</div>

    <!-- Modal Crear Bóveda -->
    <div class="modal fade" id="modalCrearBoveda" tabindex="-1" aria-labelledby="modalCrearBovedaLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearBovedaLabel">Crear Bóveda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formCrearBoveda" method="POST" action="">
                        <input type="hidden" name="action" value="create">
                        <div class="mb-3">
                            <label for="responsable_create" class="form-label">Responsable</label>
                            <input type="text" class="form-control" id="responsable_create" name="responsable"
                                placeholder="Ingrese el nombre del responsable" required>
                        </div>
                        <div class="mb-3">
                            <label for="ubicacion_create" class="form-label">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacion_create" name="ubicacion"
                                placeholder="Ingrese la ubicación" required>
                        </div>
                        <div class="mb-3">
                            <label for="monto_crc_create" class="form-label">Monto en CRC</label>
                            <input type="number" class="form-control" id="monto_crc_create" name="monto_crc"
                                placeholder="Ingrese el monto en Colones" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label for="monto_usd_create" class="form-label">Monto en USD</label>
                            <input type="number" class="form-control" id="monto_usd_create" name="monto_usd"
                                placeholder="Ingrese el monto en Dólares" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label for="monto_eur_create" class="form-label">Monto en EUR</label>
                            <input type="number" class="form-control" id="monto_eur_create" name="monto_eur"
                                placeholder="Ingrese el monto en Euros" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label for="id_organizacion_create" class="form-label">Organización</label>
                            <select class="form-select" id="id_organizacion_create" name="id_organizacion" required>
                                <?php foreach ($organizations as $org): ?>
                                    <option value="<?php echo $org['organizacion_id']; ?>"><?php echo $org['nombre']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear Bóveda</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Bóveda -->
    <div class="modal fade" id="modalEditarBoveda" tabindex="-1" aria-labelledby="modalEditarBovedaLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarBovedaLabel">Editar Bóveda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditarBoveda" method="POST" action="">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" id="id_edit" name="id">
                        <div class="mb-3">
                            <label for="responsable_edit" class="form-label">Responsable</label>
                            <input type="text" class="form-control" id="responsable_edit" name="responsable"
                                placeholder="Ingrese el nombre del responsable" required>
                        </div>
                        <div class="mb-3">
                            <label for="ubicacion_edit" class="form-label">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacion_edit" name="ubicacion"
                                placeholder="Ingrese la ubicación" required>
                        </div>
                        <div class="mb-3">
                            <label for="monto_crc_edit" class="form-label">Monto en CRC</label>
                            <input type="number" class="form-control" id="monto_crc_edit" name="monto_crc"
                                placeholder="Ingrese el monto en Colones" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label for="monto_usd_edit" class="form-label">Monto en USD</label>
                            <input type="number" class="form-control" id="monto_usd_edit" name="monto_usd"
                                placeholder="Ingrese el monto en Dólares" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label for="monto_eur_edit" class="form-label">Monto en EUR</label>
                            <input type="number" class="form-control" id="monto_eur_edit" name="monto_eur"
                                placeholder="Ingrese el monto en Euros" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label for="id_organizacion_edit" class="form-label">Organización</label>
                            <select class="form-select" id="id_organizacion_edit" name="id_organizacion" required>
                                <?php foreach ($organizations as $org): ?>
                                    <option value="<?php echo $org['organizacion_id']; ?>"><?php echo $org['nombre']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar Bóveda -->
    <div class="modal fade" id="modalEliminarBoveda" tabindex="-1" aria-labelledby="modalEliminarBovedaLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEliminarBovedaLabel">Eliminar Bóveda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de que desea eliminar esta bóveda?</p>
                    <form id="formEliminarBoveda" method="POST" action="">
                        <input type="hidden" id="action_delete" name="action" value="delete">
                        <input type="hidden" id="id_delete" name="id">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-5">
        <p>&copy; 2024 Cooperativa de Ahorro. Todos los derechos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openEditModal(id) {
            // Aquí haces la petición AJAX para obtener los datos de la bóveda
            fetch(`getBoveda.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('id_edit').value = data.id;
                    document.getElementById('responsable_edit').value = data.responsable;
                    document.getElementById('ubicacion_edit').value = data.ubicacion;
                    document.getElementById('monto_crc_edit').value = data.monto_crc;
                    document.getElementById('monto_usd_edit').value = data.monto_usd;
                    document.getElementById('monto_eur_edit').value = data.monto_eur;
                    document.getElementById('id_organizacion_edit').value = data.id_organizacion;
                    const modal = new bootstrap.Modal(document.getElementById('modalEditarBoveda'));
                    modal.show();
                });
        }

        function openDeleteModal(id) {
            document.getElementById('id_delete').value = id;
            const modal = new bootstrap.Modal(document.getElementById('modalEliminarBoveda'));
            modal.show();
        }

        function filtrarPorOrganizacion() {
        const organizacionId = document.getElementById('filtro_organizacion').value;
        const rows = document.querySelectorAll('#bovedas_tbody tr');

        rows.forEach(row => {
            if (organizacionId === "" || row.getAttribute('data-organizacion-id') === organizacionId) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    </script>
</body>

</html>