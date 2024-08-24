<?php
include('utils/database.php');

// Función para obtener todas las inversiones registradas
function obtenerInversiones()
{
    $conexion = get_mysql_connection();
    $query = "
        SELECT 
        i.id, 
        i.tipo, 
        i.moneda, 
        i.monto, 
        i.fecha_inicio, 
        i.fecha_fin, 
        i.finalizada, 
        c.numero_cuenta AS cuenta_banco,
        o.nombre AS organizacion
    FROM inversiones i
    JOIN cuentasbanco c ON i.id_cuenta = c.id
    JOIN organizaciones o ON i.id_organizacion = o.organizacion_id";

    $resultado = $conexion->query($query);
    $inversiones = [];

    while ($fila = $resultado->fetch_assoc()) {
        $inversiones[] = $fila;
    }

    $conexion->close();
    return $inversiones;
}

// Función para registrar una nueva inversión
function registrarInversion($tipo, $moneda, $monto, $fecha_inicio, $fecha_fin, $cuenta_debitar, $organizacion)
{
    $conexion = get_mysql_connection();

    if ($tipo === 'certificado') {
        $tipo_certificado = $_POST['tipo_certificado'] ?? '';
        $valor_nominal = $_POST['valor_nominal'] ?? '';
        $tasa_interes = $_POST['tasa_interes'] ?? '';
        $fecha_vencimiento = $_POST['fecha_vencimiento'] ?? '';
        $vendible = isset($_POST['vendible']) ? 1 : 0;

        // Imprimir los valores para depuración
        echo "Tipo Certificado: $tipo_certificado<br>";
        echo "Valor Nominal: $valor_nominal<br>";
        echo "Tasa de Interés: $tasa_interes<br>";
        echo "Fecha de Vencimiento: $fecha_vencimiento<br>";
        echo "Vendible: $vendible<br>";

        if (empty($tipo_certificado) || empty($valor_nominal) || empty($tasa_interes) || empty($fecha_vencimiento)) {
            echo "Error: Uno o más campos obligatorios para el certificado están vacíos.";
            return;
        }

        // Inserta la inversión
        $queryInversion = "INSERT INTO inversiones (tipo, moneda, monto, fecha_inicio, fecha_fin, id_cuenta, id_organizacion)
                            VALUES ('$tipo', '$moneda', '$monto', '$fecha_inicio', '$fecha_fin', '$cuenta_debitar', '$organizacion')";
        if (!$conexion->query($queryInversion)) {
            echo "Error al registrar la inversión: " . $conexion->error;
            return;
        }
        $id_inversion = $conexion->insert_id;

        // Inserta los detalles del certificado 
        $queryCertificado = "INSERT INTO certificados (tipo, valor_nominal, tasa_interes, fecha_vencimiento, vendible, id_inversion, id_organizacion)
                             VALUES ('$tipo_certificado', '$valor_nominal', '$tasa_interes', '$fecha_vencimiento', '$vendible', '$id_inversion', '$organizacion')";

        if ($conexion->query($queryCertificado) === TRUE) {
            echo "Nuevo certificado registrado correctamente";
        } else {
            echo "Error: " . $queryCertificado . "<br>" . $conexion->error;
        }
    } elseif ($tipo === 'proveedor') {
        $nombre_proveedor = $_POST['nombre_proveedor'] ?? '';
        $cuenta_iban = $_POST['cuenta_iban'] ?? '';
        $tasa_interes = $_POST['tasa_interes'] ?? '';
        $fecha_vencimiento = $_POST['fecha_vencimiento'] ?? '';

        if (empty($nombre_proveedor) || empty($cuenta_iban) || empty($tasa_interes) || empty($fecha_vencimiento)) {
            echo "Error: Uno o más campos obligatorios para el proveedor están vacíos.";
            return;
        }

        // Inserta la inversión
        $queryInversion = "INSERT INTO inversiones (tipo, moneda, monto, fecha_inicio, fecha_fin, id_cuenta, id_organizacion)
                            VALUES ('$tipo', '$moneda', '$monto', '$fecha_inicio', '$fecha_fin', '$cuenta_debitar', '$organizacion')";
        if (!$conexion->query($queryInversion)) {
            echo "Error al registrar la inversión: " . $conexion->error;
            return;
        }
        $id_inversion = $conexion->insert_id;

        // Inserta los detalles del proveedor
        $queryProveedor = "INSERT INTO proveedorestesoreria (nombre, cuenta_iban, tasa_interes, fecha_vencimiento, id_inversion, id_organizacion)
                           VALUES ('$nombre_proveedor', '$cuenta_iban', '$tasa_interes', '$fecha_vencimiento', '$id_inversion', '$organizacion')";
        if (!$conexion->query($queryProveedor)) {
            echo "Error al registrar el proveedor: " . $conexion->error;
            return;
        }

        echo "Proveedor registrado con éxito.";
    }

    $conexion->close();
}

// Función para obtener las cuentas bancarias
function obtenerCuentasBancarias()
{
    $conexion = get_mysql_connection();
    $query = "SELECT id, numero_cuenta, moneda FROM cuentasbanco";
    $resultado = $conexion->query($query);
    $cuentas = [];

    while ($fila = $resultado->fetch_assoc()) {
        $cuentas[] = $fila;
    }

    $conexion->close();
    return $cuentas;
}

// Función para obtener las organizaciones
function obtenerOrganizaciones()
{
    $conexion = get_mysql_connection();
    $query = "SELECT organizacion_id, nombre FROM organizaciones";
    $resultado = $conexion->query($query);
    $organizaciones = [];

    while ($fila = $resultado->fetch_assoc()) {
        $organizaciones[] = $fila;
    }

    $conexion->close();
    return $organizaciones;
}

// Manejo de solicitudes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] == 'registrarInversion') {
        registrarInversion(
            $_POST['tipo_inversion'],
            $_POST['moneda'],
            $_POST['monto'],
            $_POST['fecha_inicio'],
            $_POST['fecha_fin'],
            $_POST['cuenta_debitar'],
            $_POST['organizacion']
        );
        header('Location: inversiones.php');
        exit();
    }
}

// Obtener datos para mostrar en la interfaz
$inversiones = obtenerInversiones();
$cuentasBancarias = obtenerCuentasBancarias();
$organizaciones = obtenerOrganizaciones();

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
                <div class="col-md-6 form-container">
                    <h3>Registrar Nueva Inversión</h3>
                    <form id="formRegistrarInversion" method="POST" action="inversiones.php">
                        <input type="hidden" name="accion" value="registrarInversion">

                        <div class="mb-3">
                            <label for="tipoInversion" class="form-label">Tipo de Inversión</label>
                            <select class="form-select" id="tipoInversion" name="tipo_inversion" required>
                                <option value="certificado">Certificado</option>
                                <option value="proveedor">Proveedor</option>
                            </select>
                        </div>

                        <div id="camposCertificado" style="display:none;">
                            <div class="mb-3">
                                <label for="tipoCertificado" class="form-label">Tipo de Certificado</label>
                                <input type="text" class="form-control" id="tipoCertificado" name="tipo_certificado">
                            </div>
                            <div class="mb-3">
                                <label for="valorNominal" class="form-label">Valor Nominal</label>
                                <input type="number" class="form-control" id="valorNominal" name="valor_nominal">
                            </div>
                            <div class="mb-3">
                                <label for="tasaInteresCertificado" class="form-label">Tasa de Interés</label>
                                <input type="number" step="0.01" class="form-control" id="tasaInteresCertificado"
                                    name="tasa_interes">
                            </div>
                            <div class="mb-3">
                                <label for="fechaVencimientoCertificado" class="form-label">Fecha de Vencimiento</label>
                                <input type="date" class="form-control" id="fechaVencimientoCertificado"
                                    name="fecha_vencimiento">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="vendibleCertificado"
                                    name="vendible">
                                <label for="vendibleCertificado" class="form-check-label">Es Vendible</label>
                            </div>
                        </div>

                        <div id="camposProveedor" style="display:none;">
                            <div class="mb-3">
                                <label for="nombreProveedor" class="form-label">Nombre del Proveedor</label>
                                <input type="text" class="form-control" id="nombreProveedor" name="nombre_proveedor">
                            </div>
                            <div class="mb-3">
                                <label for="cuentaIBANProveedor" class="form-label">Cuenta IBAN</label>
                                <input type="text" class="form-control" id="cuentaIBANProveedor" name="cuenta_iban">
                            </div>
                            <div class="mb-3">
                                <label for="tasaInteresProveedor" class="form-label">Tasa de Interés</label>
                                <input type="number" step="0.01" class="form-control" id="tasaInteresProveedor"
                                    name="tasa_interes">
                            </div>
                            <div class="mb-3">
                                <label for="fechaVencimientoProveedor" class="form-label">Fecha de Vencimiento</label>
                                <input type="date" class="form-control" id="fechaVencimientoProveedor"
                                    name="fecha_vencimiento">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="monedaInversion" class="form-label">Moneda</label>
                            <select class="form-select" id="monedaInversion" name="moneda"
                                onchange="filtrarCuentasPorMoneda()">
                                <option value="">Seleccione una moneda</option>
                                <option value="CRC">CRC - Colón Costarricense</option>
                                <option value="USD">USD - Dólar Estadounidense</option>
                                <option value="EUR">EUR - Euro</option>
                            </select>
                        </div>
                        <!-- Mostrar las cuentas desde la base de datos -->
                        <div class="mb-3" id="cuentasContainer" style="display: none;">
                            <label for="cuentaDebitar" class="form-label">Cuenta A Debitar</label>
                            <select class="form-select" id="cuentaDebitar" name="cuenta_debitar" required>
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
                        <!-- Mostrar las organizaciones desde la base de datos -->
                        <div class="mb-3">
                            <label for="organizacion" class="form-label">Organización</label>
                            <select class="form-select" id="organizacion" name="organizacion" required>
                                <?php foreach ($organizaciones as $organizacion): ?>
                                    <option value="<?= $organizacion['organizacion_id'] ?>"><?= $organizacion['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg" id="registrarInversionBtn">Registrar
                            Inversión</button>
                    </form>
                </div>
                <div class="col-md-6 table-container">
                    <h3>Inversiones registradas</h3>
                    <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Moneda</th>
                                    <th>Monto</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha de Fin</th>
                                    <th>Organización</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($inversiones as $inversion): ?>
                                    <tr>
                                        <td><?= $inversion['tipo'] ?></td>
                                        <td><?= $inversion['moneda'] ?></td>
                                        <td>₡<?= number_format($inversion['monto'], 2) ?></td>
                                        <td><?= $inversion['fecha_inicio'] ?></td>
                                        <td><?= $inversion['fecha_fin'] ?></td>
                                        <td><?= $inversion['organizacion'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div> <!-- Fin del div .table-responsive -->
                </div> <!-- Fin del contenedor de la tabla -->
            </div>
        </div>
    </div>

    <footer class="footer mt-5">
        <p>&copy; 2024 Cooperativa de Ahorro. Todos los derechos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mostrar/Ocultar campos específicos según el tipo de inversión seleccionado
        document.addEventListener('DOMContentLoaded', function () {
            var tipoInversion = document.getElementById('tipoInversion').value;
            toggleCamposInversion(tipoInversion);

            document.getElementById('tipoInversion').addEventListener('change', function () {
                toggleCamposInversion(this.value);
            });

            document.getElementById('monedaInversion').addEventListener('change', filtrarCuentasPorMoneda);
        });

        function toggleCamposInversion(tipoInversion) {
            document.getElementById('camposCertificado').style.display = (tipoInversion === 'certificado') ? 'block' : 'none';
            document.getElementById('camposProveedor').style.display = (tipoInversion === 'proveedor') ? 'block' : 'none';
        }

        function filtrarCuentasPorMoneda() {
            var monedaSeleccionada = document.getElementById('monedaInversion').value;
            var cuentaDebitarSelect = document.getElementById('cuentaDebitar');
            var cuentasContainer = document.getElementById('cuentasContainer');

            // Limpiar las opciones del select
            cuentaDebitarSelect.innerHTML = '';

            // Filtrar y mostrar las cuentas correspondientes a la moneda seleccionada
            <?php foreach ($cuentasBancarias as $cuenta): ?>
                if ('<?= $cuenta['moneda'] ?>' === monedaSeleccionada) {
                    var option = document.createElement('option');
                    option.value = '<?= $cuenta['id'] ?>';
                    option.textContent = '<?= $cuenta['numero_cuenta'] ?>';
                    cuentaDebitarSelect.appendChild(option);
                }
            <?php endforeach; ?>

            // Mostrar u ocultar el contenedor de cuentas según si hay cuentas para la moneda seleccionada
            if (cuentaDebitarSelect.options.length > 0) {
                cuentasContainer.style.display = 'block';
            } else {
                cuentasContainer.style.display = 'none';
            }
        }
    </script>
</body>

</html>