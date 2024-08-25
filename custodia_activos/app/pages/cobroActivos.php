<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/cobroActivo.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/activos.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/tarifaTipoActivo.php');

if (isset($_GET['id']) || true) { // Cambiar `true` a `false` para producción
    $cobros = obtenerCobroActivos();
    $activos = obtenerActivos();
    $tarifas = obtenerTarifaTipoActivos();
    $clientes = obtenerClientes(); 
} else {
    header("Location: /pages/cobroActivos.php");
    exit();
}

function getActivoName($id, $activos) {
    foreach ($activos as $activo) {
        if ($activo['id'] == $id) {
            return $activo['nombre_activo'];
        }
    }
    return 'Desconocido';
}

function getTarifaMonto($id, $tarifas) {
    foreach ($tarifas as $tarifa) {
        if ($tarifa['id'] == $id) {
            return $tarifa['monto'];
        }
    }
    return 'Desconocido';
}

function getClienteNombre($id, $clientes) {
    foreach ($clientes as $cliente) {
        if ($cliente['cliente_id'] == $id) {
            return $cliente['nombre'];
        }
    }
    return 'Desconocido';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cobros por Uso de Activos</title>
    <link rel="stylesheet" href="../public/css/cobroActivos.css">
</head>
<body>
    <header class="header">
        <h1>Cobro de activos</h1>
        <button data-href="/pages/vista1.2.php" id="cerrar"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
    </header>
    <div id="chargeList" class="charge-list">
        <button id="createChargeBtn" class="btn">Registrar Nuevo Cobro</button>
        <h2>Listado de Cobros</h2>
        <table id="chargeTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Activo</th>
                    <th>Tarifa</th>
                    <th>Cliente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="chargeTableBody">
<?php foreach ($cobros as $cobro): ?>
    <tr id="charge-<?php echo htmlspecialchars($cobro['id']); ?>">
        <td><?php echo htmlspecialchars($cobro['id']); ?></td>
        <td><?php echo htmlspecialchars($cobro['fecha']); ?></td>
        <td><?php echo htmlspecialchars(getActivoName($cobro['id_activo'], $activos)); ?></td>
        <td><?php echo htmlspecialchars(getTarifaMonto($cobro['id_tarifa'], $tarifas)); ?></td>
        <td><?php echo htmlspecialchars(getClienteNombre($cobro['id_cliente'], $clientes)); ?></td>
        <td>
            <button class="btn edit-btn" onclick="openEditModal(
                <?php echo htmlspecialchars($cobro['id']); ?>, 
                '<?php echo htmlspecialchars($cobro['fecha']); ?>', 
                '<?php echo htmlspecialchars(getActivoName($cobro['id_activo'], $activos)); ?>', 
                '<?php echo htmlspecialchars(getTarifaMonto($cobro['id_tarifa'], $tarifas)); ?>', 
                '<?php echo htmlspecialchars(getClienteNombre($cobro['id_cliente'], $clientes)); ?>')">Editar</button>
            <form method='post' action='/actions/cobroActivo/eliminar.php'>
                <input type='hidden' name='id' value='<?php echo htmlspecialchars($cobro['id']); ?>'>
                <button type='submit' class='btn btn-danger delete-btn'>Eliminar</button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>
</tbody>
        </table>
    </div>

    <div id="chargeModal" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <h2 id="modalTitle">Nuevo Cobro</h2>
            <form id="addAssetForm" action="/actions/cobroActivo/agregar.php" method="POST">
                <input type="hidden" id="chargeId" name="chargeId">
                <div class="form-group">
                    <label for="chargeDate">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" required>
                </div>
                <div class="form-group">
                    <label for="chargeAsset">Activo:</label>
                    <select id="chargeAsset" name="chargeAsset" required>
                    <option value="" disabled selected>Seleccione el activo</option>
                    <?php foreach ($activos as $activo): ?>
                        <option value="<?php echo htmlspecialchars($activo['id']); ?>">
                            <?php echo htmlspecialchars($activo['nombre_activo']); ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="chargeAmount">Tarifa:</label>
                    <select id="chargeAmount" name="chargeAmount" required>
                    <option value="" disabled selected>Seleccione la tarifa</option>
                    <?php foreach ($tarifas as $tarifa): ?>
                        <option value="<?php echo htmlspecialchars($tarifa['id']); ?>">
                            <?php echo htmlspecialchars($tarifa['monto']); ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="chargeClient">Cliente:</label>
                    <select id="chargeClient" name="chargeClient" required>
                        <option value="">Seleccione el cliente</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?php echo htmlspecialchars($cliente['cliente_id']); ?>">
                                <?php echo htmlspecialchars($cliente['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn">Guardar</button>
            </form>
        </div>
    </div>
    <footer class="footer">
        <p>&copy; 2024 Todos los derechos reservados.</p>
    </footer>

    <script src="../public/js/cobroActivos.js"></script>
</body>
</html>
