<?php
include('utils/database.php');

function obtenerInversiones()
{
    $conexion = get_mysql_connection();
    $query = "SELECT * FROM inversiones";
    $resultado = $conexion->query($query);
    $inversiones = [];

    while ($fila = $resultado->fetch_assoc()) {
        $inversiones[] = $fila;
    }

    $conexion->close();
    return $inversiones;
}

function registrarInversion($moneda, $cuenta_debitar, $monto, $fecha_inicio, $fecha_fin, $cliente_tesoreria, $organizacion)
{
    $conexion = get_mysql_connection();
    $query = "INSERT INTO inversiones (moneda, cuenta_debitar, monto, fecha_inicio, fecha_fin, cliente_tesoreria, organizacion) 
              VALUES ('$moneda', '$cuenta_debitar', '$monto', '$fecha_inicio', '$fecha_fin', '$cliente_tesoreria', '$organizacion')";
    $conexion->query($query);
    $conexion->close();
}

// Manejo de solicitudes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] == 'registrarInversion') {
        registrarInversion(
            $_POST['moneda'],
            $_POST['cuenta_debitar'],
            $_POST['monto'],
            $_POST['fecha_inicio'],
            $_POST['fecha_fin'],
            $_POST['cliente_tesoreria'],
            $_POST['organizacion']
        );
        header('Location: inversiones.php');
        exit();
    }
}

// Obtener datos para mostrar en la interfaz
$inversiones = obtenerInversiones();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inversiones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="header d-flex justify-content-between align-items-center px-3 py-2">
        <div>
            <a href="index.html" class="btn btn-light mx-3 my-2">Volver</a>
        </div>
        <h3 class="text-center flex-grow-1">Inversiones</h3>
        <h5 class="navbar navbar-light">logo</h5>
    </div>
    <div class="container-fluid">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h3>Registrar Nueva Inversión</h3>
                </div>
                <div class="col-md-6">
                    <h3>Inversiones Registradas</h3>
                </div>
            </div>

            <div class="row mb-5 justify-content-center">
                <div class="col-md-6">
                    <form id="formRegistrarInversion" method="POST" action="inversiones.php">
                        <input type="hidden" name="accion" value="registrarInversion">
                        <div class="mb-3">
                            <label for="monedaInversion" class="form-label">Moneda</label>
                            <select class="form-select" id="monedaInversion" name="moneda" required>
                                <option value="CRC">CRC - Colón Costarricense</option>
                                <option value="USD">USD - Dólar Estadounidense</option>
                                <option value="EUR">EUR - Euro</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cuentaDebitar" class="form-label">Cuenta A Debitar</label>
                            <select class="form-select" id="cuentaDebitar" name="cuenta_debitar" required>
                                <option value="12345678">CR150236244</option>
                                <option value="87654321">12466314564</option>
                                <option value="11223344">5453434545</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="montoInversion" class="form-label">Monto</label>
                            <input type="number" class="form-control" id="montoInversion" name="monto"
                                placeholder="Ingrese el monto" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fechaInicio" name="fecha_inicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechaFin" class="form-label">Fecha de Fin</label>
                            <input type="date" class="form-control" id="fechaFin" name="fecha_fin" required>
                        </div>
                        <div class="mb-3">
                            <label for="clienteTesoreria" class="form-label">Cliente Tesorería</label>
                            <select class="form-select" id="clienteTesoreria" name="cliente_tesoreria" required>
                                <option value="Banco New York">Banco New York</option>
                                <option value="Bolsa de Valores">Bolsa de Valores</option>
                                <option value="Banco Costa Rica">Banco Costa Rica</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="organizacion" class="form-label">Organización</label>
                            <select class="form-select" id="organizacion" name="organizacion" required>
                                <option value="Org A">Org A</option>
                                <option value="Org B">Org B</option>
                                <option value="Org C">Org C</option>
                                <option value="Org D">Org D</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg" id="registrarInversionBtn">Registrar
                            Inversión</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th># Inversión</th>
                                    <th>Moneda</th>
                                    <th>Monto</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha de Fin</th>
                                    <th>Cliente</th>
                                    <th>Organización</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($inversiones as $inversion): ?>
                                    <tr>
                                        <td>
                                            <?= $inversion['id'] ?>
                                        </td>
                                        <td>
                                            <?= $inversion['moneda'] ?>
                                        </td>
                                        <td>₡
                                            <?= number_format($inversion['monto'], 2) ?>
                                        </td>
                                        <td>
                                            <?= $inversion['fecha_inicio'] ?>
                                        </td>
                                        <td>
                                            <?= $inversion['fecha_fin'] ?>
                                        </td>
                                        <td>
                                            <?= $inversion['cliente_tesoreria'] ?>
                                        </td>
                                        <td>
                                            <?= $inversion['organizacion'] ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-5">
        <p>&copy; 2024 Cooperativa de Ahorro. Todos los derechos reservados.</p>
    </footer>
</body>

</html>