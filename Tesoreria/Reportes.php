<?php
include('utils/database.php');

function generarReporte($tipo, $fechaInicio, $fechaFin)
{
    $conexion = get_mysql_connection();
    $reporte = [];

    switch ($tipo) {
        case 'financiero':
            $query = "SELECT * FROM reportes_financieros WHERE fecha BETWEEN '$fechaInicio' AND '$fechaFin'";
            break;
        case 'transacciones':
            $query = "SELECT * FROM reportes_transacciones WHERE fecha BETWEEN '$fechaInicio' AND '$fechaFin'";
            break;
        case 'auditoria':
            $query = "SELECT * FROM reportes_auditoria WHERE fecha BETWEEN '$fechaInicio' AND '$fechaFin'";
            break;
        case 'transferencias':
            $query = "SELECT * FROM reportes_transferencias WHERE fecha BETWEEN '$fechaInicio' AND '$fechaFin'";
            break;
        default:
            return [];
    }

    $resultado = $conexion->query($query);

    while ($fila = $resultado->fetch_assoc()) {
        $reporte[] = $fila;
    }

    $conexion->close();
    return $reporte;
}

// Manejo de solicitudes POST para la generación de reportes
$reporteGenerado = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['tipoReporte'], $_POST['fechaInicio'], $_POST['fechaFin'])) {
        $tipoReporte = $_POST['tipoReporte'];
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFin = $_POST['fechaFin'];

        $reporteGenerado = generarReporte($tipoReporte, $fechaInicio, $fechaFin);
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="header d-flex justify-content-between align-items-center px-3 py-2 mb-3">
        <div>
            <a href="index.html" class="btn btn-light mx-3 my-2">Volver</a>
        </div>
        <h3 class="text-center flex-grow-1">Reportes</h3>
        <h5 class="navbar navbar-light">logo</h5>
    </div>
    <div class="container-fluid">
        <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
            <div class="card p-2" style="width: 30rem;">
                <div class="card-body">
                    <form method="POST" action="reportes.php">
                        <div class="mb-3">
                            <label for="tipoReporte" class="form-label">Tipo de Reporte</label>
                            <select class="form-select" id="tipoReporte" name="tipoReporte" required>
                                <option value="financiero">Reporte Financiero</option>
                                <option value="transacciones">Reporte de Transacciones</option>
                                <option value="auditoria">Reporte de Auditoría</option>
                                <option value="transferencias">Reporte de Transferencias</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechaFin" class="form-label">Fecha de Fin</label>
                            <input type="date" class="form-control" id="fechaFin" name="fechaFin" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">Generar Reporte</button>
                    </form>
                </div>
            </div>
        </div>

        <?php if ($reporteGenerado !== null && !empty($reporteGenerado)): ?>
            <div class="container mt-5">
                <h4 class="text-center">Resultados del Reporte</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <?php foreach (array_keys($reporteGenerado[0]) as $columna): ?>
                                    <th><?= $columna ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reporteGenerado as $fila): ?>
                                <tr>
                                    <?php foreach ($fila as $valor): ?>
                                        <td><?= $valor ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php elseif ($reporteGenerado !== null): ?>
            <div class="container mt-5">
                <h4 class="text-center">No se encontraron resultados para el rango de fechas y tipo de reporte seleccionado.</h4>
            </div>
        <?php endif; ?>
    </div>

    <footer class="footer mt-3">
        <p>&copy; 2024 Cooperativa de Ahorro. Todos los derechos reservados.</p>
    </footer>
</body>

</html>