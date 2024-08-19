<?php
include('utils/database.php');

// Función para procesar el pago de una factura
function pagarFactura($facturaId, $cuentaDebitar, $montoPagado, $divisa, $fechaPago, $cedula)
{
    $conexion = get_mysql_connection();

    // Validar si hay fondos suficientes (simplificado)
    $queryFondos = "SELECT saldo FROM cuentas WHERE numero_cuenta = '$cuentaDebitar'";
    $resultado = $conexion->query($queryFondos);
    $fondos = $resultado->fetch_assoc()['saldo'];

    if ($fondos >= $montoPagado) {
        // Realizar el pago: insertar en tabla de pagos y actualizar la factura
        $queryPago = "INSERT INTO pagos_facturas (factura_id, cuenta_debitar, monto_pagado, divisa, fecha_pago, cedula_cliente) 
                      VALUES ('$facturaId', '$cuentaDebitar', '$montoPagado', '$divisa', '$fechaPago', '$cedula')";
        $conexion->query($queryPago);

        // Actualizar el estado de la factura
        $queryActualizarFactura = "UPDATE facturas SET estado = 'Pagado' WHERE id = '$facturaId'";
        $conexion->query($queryActualizarFactura);

        // Actualizar el saldo de la cuenta
        $nuevoSaldo = $fondos - $montoPagado;
        $queryActualizarCuenta = "UPDATE cuentas SET saldo = '$nuevoSaldo' WHERE numero_cuenta = '$cuentaDebitar'";
        $conexion->query($queryActualizarCuenta);

        $conexion->close();
        return true;
    } else {
        $conexion->close();
        return false; // Fondos insuficientes
    }
}

// Función para procesar el pago de un préstamo
function pagarPrestamo($prestamoId, $cuentaDebitar, $montoPagado, $divisa, $fechaPago, $cedula, $organizacion)
{
    $conexion = get_mysql_connection();

    // Validar si hay fondos suficientes
    $queryFondos = "SELECT saldo FROM cuentas WHERE numero_cuenta = '$cuentaDebitar'";
    $resultado = $conexion->query($queryFondos);
    $fondos = $resultado->fetch_assoc()['saldo'];

    if ($fondos >= $montoPagado) {
        // Realizar el pago: insertar en tabla de pagos y actualizar el préstamo
        $queryPago = "INSERT INTO pagos_prestamos (prestamo_id, cuenta_debitar, monto_pagado, divisa, fecha_pago, cedula_cliente, organizacion) 
                      VALUES ('$prestamoId', '$cuentaDebitar', '$montoPagado', '$divisa', '$fechaPago', '$cedula', '$organizacion')";
        $conexion->query($queryPago);

        // Actualizar el estado del préstamo
        $queryActualizarPrestamo = "UPDATE prestamos SET estado = 'Pagado' WHERE id = '$prestamoId'";
        $conexion->query($queryActualizarPrestamo);

        // Actualizar el saldo de la cuenta
        $nuevoSaldo = $fondos - $montoPagado;
        $queryActualizarCuenta = "UPDATE cuentas SET saldo = '$nuevoSaldo' WHERE numero_cuenta = '$cuentaDebitar'";
        $conexion->query($queryActualizarCuenta);

        $conexion->close();
        return true;
    } else {
        $conexion->close();
        return false; // Fondos insuficientes
    }
}

// Procesar la solicitud de pago si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['pagarFactura'])) {
        $facturaId = $_POST['facturaId'];
        $cuentaDebitar = $_POST['cuentaDebitar'];
        $montoPagado = $_POST['montoPagado'];
        $divisa = $_POST['divisa'];
        $fechaPago = $_POST['fechaPago'];
        $cedula = $_POST['cedula'];

        if (pagarFactura($facturaId, $cuentaDebitar, $montoPagado, $divisa, $fechaPago, $cedula)) {
            echo "<script>alert('Pago de factura realizado exitosamente.');</script>";
        } else {
            echo "<script>alert('Fondos insuficientes para realizar el pago de la factura.');</script>";
        }
    }

    if (isset($_POST['pagarPrestamo'])) {
        $prestamoId = $_POST['prestamoId'];
        $cuentaDebitar = $_POST['cuentaDebitarPrestamo'];
        $montoPagado = $_POST['montoPagadoPrestamo'];
        $divisa = $_POST['divisaPrestamo'];
        $fechaPago = $_POST['fechaPagoPrestamo'];
        $cedula = $_POST['cedulaPrestamo'];
        $organizacion = $_POST['organizacionPrestamo'];

        if (pagarPrestamo($prestamoId, $cuentaDebitar, $montoPagado, $divisa, $fechaPago, $cedula, $organizacion)) {
            echo "<script>alert('Pago de préstamo realizado exitosamente.');</script>";
        } else {
            echo "<script>alert('Fondos insuficientes para realizar el pago del préstamo.');</script>";
        }
    }
}
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
</head>

<body>
    <div class="header d-flex justify-content-between align-items-center px-3 py-2">
        <div>
            <a href="index.html" class="btn btn-light mx-3 my-2">Volver</a>
        </div>
        <h3 class="text-center flex-grow-1">Gestión de Desembolsos</h3>
        <h5 class="navbar navbar-light">logo</h5>
    </div>
    <div class="container-fluid">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h5>Facturas Pendientes</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Proveedor</th>
                                    <th>Moneda</th>
                                    <th>Monto</th>
                                    <th>Fecha de Factura</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Ejemplo: agregar botón con función setFacturaId -->
                                <tr>
                                    <td>1</td>
                                    <td>Proveedor A</td>
                                    <td>CRC</td>
                                    <td>₡500,000</td>
                                    <td>2024-06-01</td>
                                    <td>Compra de suministros</td>
                                    <td>Pendiente</td>
                                    <td>
                                        <button class="btn btn-primary btn-lg" data-bs-toggle="modal"
                                            data-bs-target="#modalPagarFactura" onclick="setFacturaId(1)">Pagar</button>
                                    </td>
                                </tr>
                                <!-- Más filas según sea necesario -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Tabla de facturas pagadas, préstamos pendientes y pagados aquí -->
            </div>
        </div>
    </div>

    <!-- Modal de Pago de Factura -->
    <div class="modal fade" id="modalPagarFactura" tabindex="-1" aria-labelledby="modalPagarFacturaLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPagarFacturaLabel">Confirmar Pago de Factura</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPago" method="POST" action="">
                        <input type="hidden" name="facturaId" id="facturaId">
                        <div class="mb-3">
                            <label for="cuentaDebitar" class="form-label">Cuenta a Debitar</label>
                            <select class="form-select" name="cuentaDebitar" id="cuentaDebitar">
                                <option value="12345678">Cuenta 12345678</option>
                                <option value="87654321">Cuenta 87654321</option>
                                <option value="11223344">Cuenta 11223344</option>
                                <option value="44332211">Cuenta 44332211</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="montoPagado" class="form-label">Monto a Pagar</label>
                            <input type="number" class="form-control" name="montoPagado" id="montoPagado"
                                placeholder="Ingrese el monto a pagar">
                        </div>
                        <div class="mb-3">
                            <label for="divisa" class="form-label">Divisa</label>
                            <select class="form-select" name="divisa" id="divisa">
                                <option value="CRC">CRC - Colón Costarricense</option>
                                <option value="USD">USD - Dólar Estadounidense</option>
                                <option value="EUR">EUR - Euro</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fechaPago" class="form-label">Fecha de Pago</label>
                            <input type="datetime-local" class="form-control" name="fechaPago" id="fechaPago">
                        </div>
                        <div class="mb-3">
                            <label for="cedula" class="form-label">Cédula</label>
                            <input type="text" class="form-control" name="cedula" id="cedula"
                                placeholder="Ingrese la cédula del cliente">
                        </div>
                        <button type="submit" class="btn btn-primary" name="pagarFactura">Confirmar Pago</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Pago de Préstamo -->
    <div class="modal fade" id="modalPagarPrestamo" tabindex="-1" aria-labelledby="modalPagarPrestamoLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPagarPrestamoLabel">Confirmar Pago de Préstamo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPagoPrestamo" method="POST" action="">
                        <input type="hidden" name="prestamoId" id="prestamoId">
                        <div class="mb-3">
                            <label for="cuentaDebitarPrestamo" class="form-label">Cuenta a Debitar</label>
                            <select class="form-select" name="cuentaDebitarPrestamo" id="cuentaDebitarPrestamo">
                                <option value="12345678">Cuenta 12345678</option>
                                <option value="87654321">Cuenta 87654321</option>
                                <option value="11223344">Cuenta 11223344</option>
                                <option value="44332211">Cuenta 44332211</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="montoPagadoPrestamo" class="form-label">Monto a Pagar</label>
                            <input type="number" class="form-control" name="montoPagadoPrestamo"
                                id="montoPagadoPrestamo" placeholder="Ingrese el monto a pagar">
                        </div>
                        <div class="mb-3">
                            <label for="divisaPrestamo" class="form-label">Divisa</label>
                            <select class="form-select" name="divisaPrestamo" id="divisaPrestamo">
                                <option value="CRC">CRC - Colón Costarricense</option>
                                <option value="USD">USD - Dólar Estadounidense</option>
                                <option value="EUR">EUR - Euro</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fechaPagoPrestamo" class="form-label">Fecha de Pago</label>
                            <input type="date" class="form-control" name="fechaPagoPrestamo" id="fechaPagoPrestamo">
                        </div>
                        <div class="mb-3">
                            <label for="cedulaPrestamo" class="form-label">Cédula</label>
                            <input type="text" class="form-control" name="cedulaPrestamo" id="cedulaPrestamo"
                                placeholder="Ingrese la cédula del cliente">
                        </div>
                        <div class="mb-3">
                            <label for="organizacionPrestamo" class="form-label">Organización</label>
                            <select class="form-select" name="organizacionPrestamo" id="organizacionPrestamo">
                                <option value="Org A">Org A</option>
                                <option value="Org B">Org B</option>
                                <option value="Org C">Org C</option>
                                <option value="Org D">Org D</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="pagarPrestamo">Confirmar Pago</button>
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
        function setFacturaId(id) {
            document.getElementById('facturaId').value = id;
        }

        function setPrestamoId(id) {
            document.getElementById('prestamoId').value = id;
        }
    </script>
</body>

</html>