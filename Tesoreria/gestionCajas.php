<?php
include('utils/database.php');

// Función para obtener las cajas
function obtenerCajas()
{
    $conexion = get_mysql_connection();
    $query = "SELECT * FROM cajas";
    $resultado = $conexion->query($query);
    $cajas = [];

    while ($fila = $resultado->fetch_assoc()) {
        $cajas[] = $fila;
    }

    $conexion->close();
    return $cajas;
}

// Función para obtener transferencias completadas a cajas
function obtenerTransferenciasCompletadas($caja_id = null)
{
    $conexion = get_mysql_connection();
    $query = "
        SELECT 
            t.id, 
            t.monto, 
            t.moneda, 
            t.fecha_transferencia, 
            t.descripcion, 
            c.nombre AS caja_destino 
        FROM transferencias_cajas t
        JOIN cajas c ON t.caja_destino_id = c.id";

    if ($caja_id) {
        $query .= " WHERE t.caja_destino_id = " . intval($caja_id);
    }

    $resultado = $conexion->query($query);
    $transferencias = [];

    while ($fila = $resultado->fetch_assoc()) {
        $transferencias[] = $fila;
    }

    $conexion->close();
    return $transferencias;
}

// Función para obtener solicitudes de dinero a caja
function obtenerSolicitudesDineroCaja()
{
    $conexion = get_mysql_connection();
    $query = "SELECT s.id, c.nombre AS caja_solicitante, s.moneda, s.fecha_solicitud, s.estado 
              FROM solicitudes_dinero s 
              INNER JOIN cajas c ON s.caja_solicitante_id = c.id 
              WHERE s.estado != 'Pagado'"; // Filtrar solo solicitudes pendientes

    $resultado = $conexion->query($query);
    $solicitudes = [];

    while ($fila = $resultado->fetch_assoc()) {
        $solicitudes[] = $fila;
    }

    $conexion->close();
    return $solicitudes;
}

// Función para transferir dinero a una caja
function transferirDinero($solicitud_id, $caja_destino_nombre, $moneda, $monto, $descripcion)
{
    $conexion = get_mysql_connection();

    // Buscar el ID de la caja basado en el nombre
    $queryObtenerId = "SELECT id FROM cajas WHERE nombre = '$caja_destino_nombre'";
    $resultado = $conexion->query($queryObtenerId);

    if ($resultado->num_rows > 0) {
        $caja_destino_id = $resultado->fetch_assoc()['id'];
    } else {
        die("Error: No se encontró la caja destino con el nombre: " . $caja_destino_nombre);
    }

    // Registrar la transferencia
    $query = "INSERT INTO transferencias_cajas (solicitud_id, caja_destino_id, moneda, monto, descripcion, fecha_transferencia) 
              VALUES ('$solicitud_id', '$caja_destino_id', '$moneda', '$monto', '$descripcion', NOW())";
    $conexion->query($query);

    // Actualizar el saldo de la caja de destino
    $queryActualizarSaldo = "UPDATE cajas SET saldo = saldo + $monto WHERE id = '$caja_destino_id'";
    $conexion->query($queryActualizarSaldo);

    // Actualizar el estado de la solicitud a 'Pagado'
    $queryActualizarEstadoSolicitud = "UPDATE solicitudes_dinero SET estado = 'Pagado' WHERE id = '$solicitud_id'";
    $conexion->query($queryActualizarEstadoSolicitud);

    $conexion->close();
}



// Manejo de solicitudes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'transferirDinero':
                transferirDinero(
                    $_POST['solicitud_id'],
                    $_POST['caja_destino_id'],
                    $_POST['moneda'],
                    $_POST['monto'],
                    $_POST['descripcion']
                );
                break;
        }
    }
}


// Obtener datos para mostrar en la interfaz
$cajas = obtenerCajas();
// Llamar a la función con el filtro, si está seleccionado
$transferenciasCompletadas = obtenerTransferenciasCompletadas(isset($_POST['filterTipo']) ? $_POST['filterTipo'] : null);
$solicitudesDineroCaja = obtenerSolicitudesDineroCaja();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Cajas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="header d-flex justify-content-between align-items-center px-3 py-2">
        <div>
            <a href="index.html" class="btn btn-light mx-3 my-2">Volver</a>
        </div>
        <h3 class="text-center flex-grow-1">Gestión de Cajas</h3>
        <h5 class="navbar navbar-light">logo</h5>
    </div>
    <div class="container-fluid">
        <div class="content">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h3>Transferencias a Cajas Completadas</h3>
                </div>

                <!-- Formulario de Filtro -->
                <form method="POST" action="gestionCajas.php">
                    <div class="col-md-3">
                        <label for="filterTipo" class="form-label">Filtrar por Caja</label>
                        <select class="form-select" id="filterTipo" name="filterTipo" onchange="this.form.submit()">
                            <option value="">Todas</option>
                            <?php foreach ($cajas as $caja): ?>
                                <option value="<?= $caja['id'] ?>" <?= isset($_POST['filterTipo']) && $_POST['filterTipo'] == $caja['id'] ? 'selected' : '' ?>>
                                    <?= $caja['nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>

            </div>

            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Caja Destino</th>
                            <th>Monto</th>
                            <th>Moneda</th>
                            <th>Fecha de Transferencia</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody id="transferenciasCajasTable">
                        <?php foreach ($transferenciasCompletadas as $transferencia): ?>
                            <tr>
                                <td><?= $transferencia['id'] ?></td>
                                <td><?= $transferencia['caja_destino'] ?></td>
                                <td>₡<?= number_format($transferencia['monto'], 2) ?></td>
                                <td><?= $transferencia['moneda'] ?></td>
                                <td><?= $transferencia['fecha_transferencia'] ?></td>
                                <td><?= $transferencia['descripcion'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <h3 class="mt-5">Solicitudes de Dinero a Caja</h3>
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Caja Solicitante</th>
                            <th>Moneda</th>
                            <th>Fecha de Solicitud</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($solicitudesDineroCaja as $solicitud): ?>
                            <tr>
                                <td><?= $solicitud['id'] ?></td>
                                <td><?= $solicitud['caja_solicitante'] ?></td>
                                <td><?= $solicitud['moneda'] ?></td>
                                <td><?= $solicitud['fecha_solicitud'] ?></td>
                                <td><?= $solicitud['estado'] ?></td>
                                <td>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPagarSolicitud"
                                        onclick="cargarSolicitud(<?= $solicitud['id'] ?>, '<?= $solicitud['caja_solicitante'] ?>', '<?= $solicitud['moneda'] ?>')">
                                        Pagar
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <h4 class="mt-5">Gráfico de Transferencias a Cajas Completadas</h4>
            <canvas id="scheduledTransfersChart"></canvas>
        </div>
    </div>

    <!-- Modal para Pagar Solicitud de Dinero -->
    <div class="modal fade" id="modalPagarSolicitud" tabindex="-1" aria-labelledby="modalPagarSolicitudLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPagarSolicitudLabel">Pagar Solicitud de Dinero</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPagarSolicitud" method="POST" action="gestionCajas.php">
                        <input type="hidden" name="accion" value="transferirDinero">
                        <input type="hidden" name="solicitud_id" id="solicitudId">

                        <div class="mb-3">
                            <label for="cajaDestinoModal" class="form-label">Caja Destino</label>
                            <input type="text" class="form-control" id="cajaDestinoModal" name="caja_destino_nombre" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="monedaModal" class="form-label">Moneda</label>
                            <input type="text" class="form-control" id="monedaModal" name="moneda" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="montoTransferenciaModal" class="form-label">Monto a Transferir</label>
                            <input type="number" class="form-control" id="montoTransferenciaModal" name="monto" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcionTransferenciaModal" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="descripcionTransferenciaModal" name="descripcion">
                        </div>
                        <button type="submit" class="btn btn-primary">Confirmar Transferencia</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <footer class="footer">
        <p>&copy; 2024 Cooperativa de Ahorro. Todos los derechos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function cargarSolicitud(id, caja, moneda) {
            document.getElementById('solicitudId').value = id;
            document.getElementById('cajaDestinoModal').value = caja;
            document.getElementById('monedaModal').value = moneda;
        }
    </script>
</body>

</html>