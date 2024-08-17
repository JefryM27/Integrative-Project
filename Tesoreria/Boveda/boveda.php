<?php
include '../utils/database.php';

$conn = get_mysql_connection();

if (isset($_GET['id'])) {
    $boveda_id = $_GET['id'];

    // Consulta para obtener la información de la bóveda
    $stmt = $conn->prepare("SELECT * FROM boveda WHERE id = ?");
    $stmt->bind_param('i', $boveda_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $boveda = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "ID de bóveda no especificado.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $boveda_id = $_POST['boveda_id'];
        $moneda = $_POST['moneda'];
        $monto = $_POST['monto'];
        $descripcion = $_POST['descripcion'];

        // Actualizar la bóveda
        if ($action === 'ingresar') {
            $query = "UPDATE boveda SET monto_$moneda = monto_$moneda + ? WHERE id = ?";
            $tipo_accion = 'Ingreso';
        } elseif ($action === 'retirar') {
            $query = "UPDATE boveda SET monto_$moneda = monto_$moneda - ? WHERE id = ?";
            $tipo_accion = 'Retiro';
        }

        $stmt = $conn->prepare($query);
        $stmt->bind_param('di', $monto, $boveda_id);
        $stmt->execute();

        // Registrar la transacción en la tabla transacciones_boveda
        $stmt = $conn->prepare("INSERT INTO transacciones_boveda (boveda_id, moneda, monto, detalle, tipo_accion, id_organizacion) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('isdssi', $boveda_id, $moneda, $monto, $descripcion, $tipo_accion, $boveda['id_organizacion']);
        $stmt->execute();
        $stmt->close();

        // Redirigir después de la inserción
        header("Location: boveda.php?id=$boveda_id");
        exit();
    }

    // Procesar la actualización de tipo de cambio
    if ($_POST['action'] === 'actualizar_tipo_cambio') {
        $moneda_origen = $_POST['monedaOrigen'];
        $moneda_destino = $_POST['monedaDestino'];
        $tasa = $_POST['tasa'];
        $id_organizacion = 1;  // Puedes cambiar esto según la organización que necesites

        $stmt = $conn->prepare("INSERT INTO tipocambio (moneda_origen, moneda_destino, tasa, id_organizacion) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssdi', $moneda_origen, $moneda_destino, $tasa, $id_organizacion);
        $stmt->execute();
        $stmt->close();

        header("Location: boveda.php?id=" . $_GET['id']);
        exit();
    }
}

// Consulta para obtener los datos de tipo de cambio para los gráficos
$query = "
    SELECT moneda_origen, moneda_destino, tasa, fecha_actualizacion 
    FROM tipocambio 
    WHERE id_organizacion = ?
    ORDER BY fecha_actualizacion ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $boveda['id_organizacion']);
$stmt->execute();
$result = $stmt->get_result();

$colonesToUsdData = [];
$colonesToEurData = [];
$usdToEurData = [];

while ($row = $result->fetch_assoc()) {
    if ($row['moneda_origen'] === 'CRC' && $row['moneda_destino'] === 'USD') {
        $colonesToUsdData[] = $row['tasa'];
    } elseif ($row['moneda_origen'] === 'CRC' && $row['moneda_destino'] === 'EUR') {
        $colonesToEurData[] = $row['tasa'];
    } elseif ($row['moneda_origen'] === 'USD' && $row['moneda_destino'] === 'EUR') {
        $usdToEurData[] = $row['tasa'];
    }
}

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boveda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        .info-box {
            background-color: #3b5998;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            margin: 10px 0;
        }

        .btn-custom {
            background-color: #3b5998;
            color: white;
            padding: 20px;
            font-size: 18px;
            border-radius: 5px;
            width: 200px;
            height: 90px;
            display: block;
            margin: 10px auto;
        }

        .btn-custom:hover {
            background-color: #2d4373;
        }
    </style>
</head>

<body>
    <div class="header d-flex justify-content-between align-items-center px-3 py-2 mb-4">
        <div>
            <a href="gestionBovedas.php" class="btn btn-light mx-3 my-2">Volver</a>
        </div>
        <h3 class="text-center flex-grow-1">Boveda</h3>
        <h5 class="navbar navbar-light">logo</h5>
    </div>
    <div class="container-fluid">
        <div class="content">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h3>Total en Bóveda</h3>
                </div>
                <div class="col-md-6 mb-3">
                    <h3>Acciones</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="info-box">
                        <h4>CRC</h4>
                        <p>₡<?php echo number_format($boveda['monto_crc'], 2); ?></p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="info-box">
                        <h4>USD</h4>
                        <p>$<?php echo number_format($boveda['monto_usd'], 2); ?></p>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="info-box">
                        <h4>EUR</h4>
                        <p>€<?php echo number_format($boveda['monto_eur'], 2); ?></p>
                    </div>
                </div>

                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <button class="btn btn-custom mx-2" data-bs-toggle="modal"
                        data-bs-target="#modalIngresarDinero">Ingresar Dinero</button>
                    <button class="btn btn-custom mx-2" data-bs-toggle="modal"
                        data-bs-target="#modalRetirarDinero">Retirar Dinero</button>
                    <button class="btn btn-custom mx-2" data-bs-toggle="modal"
                        data-bs-target="#modalActualizarTipoCambio">Actualizar Tipo de Cambio</button>
                </div>
            </div>
            <div class="row justify-content-center">
                <h3 class="mb-5">Tasa de cambio:</h3>
                <div class="col-md-3 mt-1 mx-3">
                    <h4>CRC a USD</h4>
                    <canvas id="colonesToUsdChart"></canvas>
                </div>
                <div class="col-md-3 mt-1 mx-3">
                    <h4>CRC a EUR</h4>
                    <canvas id="colonesToEurChart"></canvas>
                </div>
                <div class="col-md-3 mt-1 mx-3 mb-4">
                    <h4>USD a EUR</h4>
                    <canvas id="usdToEurChart"></canvas>
                </div>
            </div>

            <!-- Modales -->
            <!-- Modal Ingresar Dinero -->
            <div class="modal fade" id="modalIngresarDinero" tabindex="-1" aria-labelledby="modalIngresarDineroLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalIngresarDineroLabel">Ingresar Dinero</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formIngresarDinero" method="POST" action="">
                                <input type="hidden" name="action" value="ingresar">
                                <input type="hidden" name="boveda_id" value="<?php echo $boveda['id']; ?>">
                                <label for="monedaIngreso" class="form-label">Moneda</label>
                                <select class="form-select" id="monedaIngreso" name="moneda">
                                    <option value="crc">Colones</option>
                                    <option value="usd">Dólares</option>
                                    <option value="eur">Euros</option>
                                </select>
                                <label for="montoIngreso" class="form-label">Monto</label>
                                <input type="number" class="form-control" id="montoIngreso" name="monto"
                                    placeholder="Ingrese el monto" step="0.01" required>
                                <label for="descripcionIngreso" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcionIngreso" name="descripcion"
                                    placeholder="Ingrese una descripción" required>
                                <button type="submit" class="btn btn-success btn-lg mt-3">Ingresar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Retirar Dinero -->
            <div class="modal fade" id="modalRetirarDinero" tabindex="-1" aria-labelledby="modalRetirarDineroLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalRetirarDineroLabel">Retirar Dinero</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formRetirarDinero" method="POST" action="">
                                <input type="hidden" name="action" value="retirar">
                                <input type="hidden" name="boveda_id" value="<?php echo $boveda['id']; ?>">
                                <label for="monedaRetiro" class="form-label">Moneda</label>
                                <select class="form-select" id="monedaRetiro" name="moneda">
                                    <option value="crc">Colones</option>
                                    <option value="usd">Dólares</option>
                                    <option value="eur">Euros</option>
                                </select>
                                <label for="montoRetiro" class="form-label">Monto</label>
                                <input type="number" class="form-control" id="montoRetiro" name="monto"
                                    placeholder="Ingrese el monto" step="0.01" required>
                                <label for="descripcionRetiro" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcionRetiro" name="descripcion"
                                    placeholder="Ingrese una descripción" required>
                                <button type="submit" class="btn btn-danger btn-lg mt-3">Retirar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Actualizar Tipo de Cambio -->
            <div class="modal fade" id="modalActualizarTipoCambio" tabindex="-1"
                aria-labelledby="modalActualizarTipoCambioLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalActualizarTipoCambioLabel">Actualizar Tipo de Cambio</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formActualizarTipoCambio" method="POST" action="">
                                <input type="hidden" name="action" value="actualizar_tipo_cambio">
                                <label for="monedaOrigen" class="form-label">Moneda Origen</label>
                                <select class="form-select" id="monedaOrigen" name="monedaOrigen">
                                    <option value="CRC">Colones</option>
                                    <option value="USD">Dólares</option>
                                    <option value="EUR">Euros</option>
                                </select>
                                <label for="monedaDestino" class="form-label">Moneda Destino</label>
                                <select class="form-select" id="monedaDestino" name="monedaDestino">
                                    <option value="CRC">Colones</option>
                                    <option value="USD">Dólares</option>
                                    <option value="EUR">Euros</option>
                                </select>
                                <label for="tasa" class="form-label">Tasa de Cambio</label>
                                <input type="number" step="0.0001" class="form-control" id="tasa" name="tasa"
                                    placeholder="Ingrese la tasa de cambio" required>
                                <button type="submit" class="btn btn-primary btn-lg mt-3">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-5">
        <p>&copy; 2024 Cooperativa de Ahorro. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="grafTasaCambio.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    var colonesToUsdData = <?php echo json_encode($colonesToUsdData); ?>;
    var colonesToEurData = <?php echo json_encode($colonesToEurData); ?>;
    var usdToEurData = <?php echo json_encode($usdToEurData); ?>;

    var colonesToUsdCtx = document.getElementById('colonesToUsdChart').getContext('2d');
    var colonesToUsdChart = new Chart(colonesToUsdCtx, {
        type: 'line',
        data: {
            labels: colonesToUsdData.map((_, i) => i + 1),
            datasets: [{
                label: 'Colones a USD',
                data: colonesToUsdData,
                backgroundColor: 'rgba(59, 89, 152, 0.2)',
                borderColor: 'rgba(59, 89, 152, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    });

    var colonesToEurCtx = document.getElementById('colonesToEurChart').getContext('2d');
    var colonesToEurChart = new Chart(colonesToEurCtx, {
        type: 'line',
        data: {
            labels: colonesToEurData.map((_, i) => i + 1),
            datasets: [{
                label: 'Colones a EUR',
                data: colonesToEurData,
                backgroundColor: 'rgba(59, 89, 152, 0.2)',
                borderColor: 'rgba(59, 89, 152, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    });

    var usdToEurCtx = document.getElementById('usdToEurChart').getContext('2d');
    var usdToEurChart = new Chart(usdToEurCtx, {
        type: 'line',
        data: {
            labels: usdToEurData.map((_, i) => i + 1),
            datasets: [{
                label: 'USD a EUR',
                data: usdToEurData,
                backgroundColor: 'rgba(59, 89, 152, 0.2)',
                borderColor: 'rgba(59, 89, 152, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    });
});
</script>
</body>

</html>