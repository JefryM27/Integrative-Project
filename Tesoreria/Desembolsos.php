<?php
include('utils/database.php');

function validarFondos($cuenta, $monto)
{
    $conexion = get_mysql_connection();
    $query = "SELECT saldo FROM cuentas WHERE numero_cuenta = '$cuenta'";
    $resultado = $conexion->query($query);
    $saldo = $resultado->fetch_assoc()['saldo'];

    $conexion->close();
    return $saldo >= $monto;
}

function procesarPagoDesembolso($idDesembolso, $cuentaDebitar, $monto)
{
    $conexion = get_mysql_connection();

    // Validar fondos
    if (!validarFondos($cuentaDebitar, $monto)) {
        return false;
    }

    // Restar monto de la cuenta
    $query = "UPDATE cuentas SET saldo = saldo - $monto WHERE numero_cuenta = '$cuentaDebitar'";
    if (!$conexion->query($query)) {
        die("Error al restar el monto de la cuenta: " . $conexion->error);
    }

    // Actualizar estado del desembolso
    $query = "UPDATE desembolsos SET estado = 'Pagado' WHERE id = '$idDesembolso'";
    if (!$conexion->query($query)) {
        die("Error al actualizar el estado del desembolso: " . $conexion->error);
    }

    // Obtener el tipo de desembolso para actualizar el estado
    $query = "SELECT tipo_desembolso, id_tipo_desembolso FROM desembolsos WHERE id = '$idDesembolso'";
    $resultado = $conexion->query($query);
    $desembolso = $resultado->fetch_assoc();

    switch ($desembolso['tipo_desembolso']) {
        case 'factura':
            $query = "UPDATE facturas SET estado = 'Pagado' WHERE id = " . $desembolso['id_tipo_desembolso'];
            break;
        case 'prestamo':
            $query = "UPDATE prestamos SET estado = 'Pagado' WHERE id = " . $desembolso['id_tipo_desembolso'];
            break;
        case 'contrato':
            $query = "UPDATE contratos SET estado = 'Pagado' WHERE id = " . $desembolso['id_tipo_desembolso'];
            break;
    }

    if (!$conexion->query($query)) {
        die("Error al actualizar el estado del tipo de desembolso: " . $conexion->error);
    }

    $conexion->close();

    return true;
}

// Manejo de solicitudes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === 'pagarDesembolso') {
        $idDesembolso = $_POST['idDesembolso'];
        $cuentaDebitar = $_POST['cuentaDebitar'];
        $monto = $_POST['monto'];

        if (procesarPagoDesembolso($idDesembolso, $cuentaDebitar, $monto)) {
            header('Location: desembolsos.php?success=1');
            exit();
        } else {
            header('Location: desembolsos.php?error=1');
            exit();
        }
    }
}

function obtenerDesembolsosPendientes()
{
    $conexion = get_mysql_connection();
    $query = "
        SELECT 
            d.id, 
            d.tipo_desembolso, 
            d.moneda, 
            d.monto, 
            d.fecha_pago, 
            o.nombre AS organizacion, 
            COALESCE(f.descripcion, p.descripcion, c.descripcion) AS descripcion, 
            d.estado
        FROM desembolsos d
        LEFT JOIN organizaciones o ON d.id_organizacion = o.organizacion_id
        LEFT JOIN facturas f ON d.id_tipo_desembolso = f.id AND d.tipo_desembolso = 'factura'
        LEFT JOIN prestamos p ON d.id_tipo_desembolso = p.id AND d.tipo_desembolso = 'prestamo'
        LEFT JOIN contratos c ON d.id_tipo_desembolso = c.id AND d.tipo_desembolso = 'contrato'
        WHERE d.estado = 'Pendiente'";

    $resultado = $conexion->query($query);
    $desembolsos = [];

    while ($fila = $resultado->fetch_assoc()) {
        $desembolsos[] = $fila;
    }

    $conexion->close();
    return $desembolsos;
}





function obtenerDesembolsosRealizados()
{
    $conexion = get_mysql_connection();
    $query = "
        SELECT 
            d.id, 
            d.tipo_desembolso, 
            d.moneda, 
            d.monto, 
            d.fecha_pago, 
            o.nombre AS organizacion
        FROM desembolsos d
        LEFT JOIN organizaciones o ON d.id_organizacion = o.organizacion_id
        WHERE d.estado = 'Pagado'";

    $resultado = $conexion->query($query);
    if (!$resultado) {
        die("Error al obtener desembolsos realizados: " . $conexion->error);
    }
    $desembolsos = [];

    while ($fila = $resultado->fetch_assoc()) {
        $desembolsos[] = $fila;
    }

    $conexion->close();
    return $desembolsos;
}

function obtenerCuentasDebitar()
{
    $conexion = get_mysql_connection();
    $query = "SELECT numero_cuenta FROM cuentas";
    $resultado = $conexion->query($query);
    $cuentas = [];

    while ($fila = $resultado->fetch_assoc()) {
        $cuentas[] = $fila['numero_cuenta'];
    }

    $conexion->close();
    return $cuentas;
}

$desembolsosPendientes = obtenerDesembolsosPendientes();
$desembolsosRealizados = obtenerDesembolsosRealizados();
$cuentasDebitar = obtenerCuentasDebitar();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Desembolsos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .container-fluid {
            flex: 1;
        }

        .footer {
            background-color: #3b5998;
            color: white;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>

</head>

<body>
    <div class="header d-flex justify-content-between align-items-center px-3 py-2">
        <div>
            <a href="index.html" class="btn btn-light mx-3 my-2">Volver</a>
        </div>
        <h3 class="text-center flex-grow-1">Desembolsos</h3>
        <h5 class="navbar navbar-light">logo</h5>
    </div>
    <div class="container-fluid">
        <h3 class="text-center">Desembolsos Pendientes</h3>
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Moneda</th>
                        <th>Monto</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($desembolsosPendientes as $desembolso): ?>
                        <tr>
                            <td><?= $desembolso['id'] ?></td>
                            <td><?= $desembolso['tipo_desembolso'] ?></td>
                            <td><?= $desembolso['moneda'] ?></td>
                            <td>₡<?= number_format($desembolso['monto'], 2) ?></td>
                            <td><?= $desembolso['descripcion'] ?></td>
                            <td><?= $desembolso['estado'] ?></td>
                            <td>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalPagarDesembolso"
                                    onclick="cargarDatosDesembolso(<?= $desembolso['id'] ?>, '<?= $desembolso['tipo_desembolso'] ?>', '<?= $desembolso['moneda'] ?>', <?= $desembolso['monto'] ?>)">Pagar</button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h3 class="text-center">Desembolsos Realizados</h3>
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Moneda</th>
                        <th>Monto</th>
                        <th>Fecha de Pago</th>
                        <th>Organización</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($desembolsosRealizados as $desembolso): ?>
                        <tr>
                            <td><?= $desembolso['id'] ?></td>
                            <td><?= $desembolso['tipo_desembolso'] ?></td>
                            <td><?= $desembolso['moneda'] ?></td>
                            <td>₡<?= number_format($desembolso['monto'], 2) ?></td>
                            <td><?= $desembolso['fecha_pago'] ?></td>
                            <td><?= $desembolso['organizacion'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Pago de Desembolso -->
    <div class="modal fade" id="modalPagarDesembolso" tabindex="-1" aria-labelledby="modalPagarDesembolsoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPagarDesembolsoLabel">Confirmar Pago de Desembolso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPagarDesembolso" method="POST" action="desembolsos.php">
                        <input type="hidden" name="accion" value="pagarDesembolso">
                        <input type="hidden" name="idDesembolso" id="idDesembolso">
                        <div class="mb-3">
                            <label for="cuentaDebitar" class="form-label">Cuenta a Debitar</label>
                            <select class="form-select" id="cuentaDebitar" name="cuentaDebitar">
                                <?php foreach ($cuentasDebitar as $cuenta): ?>
                                    <option value="<?= $cuenta ?>"><?= $cuenta ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="montoDesembolso" class="form-label">Monto a Pagar</label>
                            <input type="number" class="form-control" id="montoDesembolso" name="monto" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Confirmar Pago</button>
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
        function cargarDatosDesembolso(id, tipo, moneda, monto) {
            document.getElementById('idDesembolso').value = id;
            document.getElementById('montoDesembolso').value = monto;
        }
    </script>
</body>

</html>