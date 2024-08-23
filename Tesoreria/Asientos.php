<?php
include('utils/database.php');

// Función para obtener todos los asientos
function obtenerAsientos()
{
    $conexion = get_mysql_connection();
    $query = "SELECT * FROM asientos";
    $resultado = $conexion->query($query);
    $asientos = [];

    while ($fila = $resultado->fetch_assoc()) {
        $asientos[] = $fila;
    }

    $conexion->close();
    return $asientos;
}

// Función para crear un nuevo asiento
function crearAsiento($fecha, $cuenta, $denominacion, $debe, $haber, $glosa)
{
    $conexion = get_mysql_connection();
    $query = "INSERT INTO asientos (fecha, cuenta, denominacion, debe, haber, glosa) VALUES ('$fecha', '$cuenta', '$denominacion', '$debe', '$haber', '$glosa')";
    if ($conexion->query($query) === TRUE) {
        echo "Nuevo asiento creado correctamente";
    } else {
        echo "Error: " . $query . "<br>" . $conexion->error;
    }
    $conexion->close();
}

// Función para modificar un asiento existente
function modificarAsiento($id, $fecha, $cuenta, $denominacion, $debe, $haber, $glosa)
{
    $conexion = get_mysql_connection();
    $query = "UPDATE asientos SET fecha='$fecha', cuenta='$cuenta', denominacion='$denominacion', debe='$debe', haber='$haber', glosa='$glosa' WHERE id='$id'";
    if ($conexion->query($query) === TRUE) {
        echo "Asiento modificado correctamente";
    } else {
        echo "Error: " . $query . "<br>" . $conexion->error;
    }
    $conexion->close();
}

// Función para borrar un asiento
function borrarAsiento($id)
{
    $conexion = get_mysql_connection();
    $query = "DELETE FROM asientos WHERE id='$id'";
    if ($conexion->query($query) === TRUE) {
        echo "Asiento borrado correctamente";
    } else {
        echo "Error: " . $query . "<br>" . $conexion->error;
    }
    $conexion->close();
}

// Función para consultar un asiento
function consultarAsiento($id)
{
    $conexion = get_mysql_connection();
    $query = "SELECT * FROM asientos WHERE id='$id'";
    $resultado = $conexion->query($query);
    $asiento = null;
    if ($resultado->num_rows > 0) {
        $asiento = $resultado->fetch_assoc();
    }
    $conexion->close();
    return $asiento;
}

// Manejo de solicitudes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        if ($accion == 'crear') {
            crearAsiento($_POST['fecha'], $_POST['cuenta'], $_POST['denominacion'], $_POST['debe'], $_POST['haber'], $_POST['glosa']);
        } elseif ($accion == 'modificar') {
            modificarAsiento($_POST['id'], $_POST['fecha'], $_POST['cuenta'], $_POST['denominacion'], $_POST['debe'], $_POST['haber'], $_POST['glosa']);
        } elseif ($accion == 'borrar') {
            borrarAsiento($_POST['id']);
        } elseif ($accion == 'consultar') {
            $asiento = consultarAsiento($_POST['id']);
            if ($asiento) {
                // Aquí puedes hacer algo con el asiento consultado, como mostrarlo en el modal
            } else {
                echo "Asiento no encontrado";
            }
        }
    }
}

// Obtener asientos para mostrar en la interfaz
$asientos = obtenerAsientos();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Asientos Contables</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/styles.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header,
        footer {
            background-color: #3b5998;
            color: white;
        }

        footer {
            margin-top: auto;
            padding: 10px;
            text-align: center;
        }

        .container {
            background-color: white;
            padding-top: 20px;
            padding-bottom: 20px;
            flex-grow: 1;
        }

        .standard-button {
            width: 150px;
            height: 50px;
            margin-bottom: 5px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
        }

        .asiento {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            background-color: #f8f9fa;
        }

        .asiento-table th,
        .asiento-table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }

        .asiento-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .glosa {
            margin-top: 10px;
        }

        /* Contenedor con desplazamiento fijo para los asientos */
        .asiento-container {
            max-height: 400px;
            /* Fija la altura máxima del contenedor */
            overflow-y: scroll;
            /* Agrega la barra de desplazamiento vertical */
            margin-bottom: 20px;
            /* Espacio adicional debajo del contenedor */
            border: 1px solid #dee2e6;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="header d-flex justify-content-between align-items-center px-3 py-2 mb-4">
        <div>
            <a href="index.html" class="btn btn-light mx-3 my-2">Volver</a>
        </div>
        <h3 class="text-center flex-grow-1">Gestión de Asientos Contables</h3>
        <h5 class="navbar navbar-light">logo</h5>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Contenedor para los asientos con desplazamiento fijo -->
                <div class="asiento-container">
                    <div class="asiento" data-id="1">
                        <table class="asiento-table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Cuenta</th>
                                    <th>Denominación</th>
                                    <th>Debe</th>
                                    <th>Haber</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td rowspan="2">15/12/20XX</td>
                                    <td>42121</td>
                                    <td>Facturas por pagar</td>
                                    <td>1,000.00</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>1011</td>
                                    <td>Efectivo y equivalente de efectivo</td>
                                    <td></td>
                                    <td>1,000.00</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="glosa">
                            <p><strong>Glosa:</strong> Pago de facturas pendientes</p>
                        </div>
                    </div>
                    <div class="asiento" data-id="2">
                        <table class="asiento-table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Cuenta</th>
                                    <th>Denominación</th>
                                    <th>Debe</th>
                                    <th>Haber</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td rowspan="2">05/01/2024</td>
                                    <td>50210</td>
                                    <td>Inventarios</td>
                                    <td>2,500.00</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>20110</td>
                                    <td>Cuentas por pagar</td>
                                    <td></td>
                                    <td>2,500.00</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="glosa">
                            <p><strong>Glosa:</strong> Compra de mercaderías a crédito</p>
                        </div>
                    </div>
                    <div class="asiento" data-id="3">
                        <table class="asiento-table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Cuenta</th>
                                    <th>Denominación</th>
                                    <th>Debe</th>
                                    <th>Haber</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td rowspan="2">10/01/2024</td>
                                    <td>10110</td>
                                    <td>Caja/Bancos</td>
                                    <td>1,200.00</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>40010</td>
                                    <td>Ventas</td>
                                    <td></td>
                                    <td>1,200.00</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="glosa">
                            <p><strong>Glosa:</strong> Venta de mercaderías al contado</p>
                        </div>
                    </div>
                </div> <!-- Fin del contenedor de asientos -->
                <div class="button-group">
                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#crearModal">Crear</button>
                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modificarModal">Modificar</button>
                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#borrarModal">Borrar</button>
                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#consultarModal">Consultar</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Nombre de tu empresa. Todos los derechos reservados.</p>
    </footer>

    <!-- Modals -->
    <!-- Crear Modal -->
    <div class="modal fade" id="crearModal" tabindex="-1" role="dialog" aria-labelledby="crearModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearModalLabel">Crear Asiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para crear asiento -->
                    <form>
                        <div class="form-group">
                            <label for="crearFecha">Fecha</label>
                            <input type="date" class="form-control" id="crearFecha">
                        </div>
                        <div class="form-group">
                            <label for="crearCuenta">Cuenta</label>
                            <input type="text" class="form-control" id="crearCuenta" placeholder="Ingrese la cuenta">
                        </div>
                        <div class="form-group">
                            <label for="crearDenominacion">Denominación</label>
                            <input type="text" class="form-control" id="crearDenominacion" placeholder="Ingrese la denominación">
                        </div>
                        <div class="form-group">
                            <label for="crearDebe">Debe</label>
                            <input type="number" class="form-control" id="crearDebe" placeholder="Ingrese el debe">
                        </div>
                        <div class="form-group">
                            <label for="crearHaber">Haber</label>
                            <input type="number" class="form-control" id="crearHaber" placeholder="Ingrese el haber">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-lg">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modificar Modal -->
    <div class="modal fade" id="modificarModal" tabindex="-1" role="dialog" aria-labelledby="modificarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modificarModalLabel">Modificar Asiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para modificar asiento -->
                    <form>
                        <div class="form-group">
                            <label for="modificarIDAsiento">ID del asiento</label>
                            <input type="text" class="form-control" id="modificarIDAsiento" placeholder="Ingrese el ID del asiento">
                        </div>
                        <div class="form-group">
                            <label for="modificarFecha">Fecha</label>
                            <input type="date" class="form-control" id="modificarFecha">
                        </div>
                        <div class="form-group">
                            <label for="modificarCuenta">Cuenta</label>
                            <input type="text" class="form-control" id="modificarCuenta" placeholder="Ingrese la cuenta">
                        </div>
                        <div class="form-group">
                            <label for="modificarDenominacion">Denominación</label>
                            <input type="text" class="form-control" id="modificarDenominacion" placeholder="Ingrese la denominación">
                        </div>
                        <div class="form-group">
                            <label for="modificarDebe">Debe</label>
                            <input type="number" class="form-control" id="modificarDebe" placeholder="Ingrese el debe">
                        </div>
                        <div class="form-group">
                            <label for="modificarHaber">Haber</label>
                            <input type="number" class="form-control" id="modificarHaber" placeholder="Ingrese el haber">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-lg">Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Borrar Modal -->
    <div class="modal fade" id="borrarModal" tabindex="-1" role="dialog" aria-labelledby="borrarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="borrarModalLabel">Borrar Asiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para borrar asiento -->
                    <form>
                        <div class="form-group">
                            <label for="borrarIDAsiento">ID del asiento</label>
                            <input type="text" class="form-control" id="borrarIDAsiento" placeholder="Ingrese el ID del asiento">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Consultar Modal -->
    <div class="modal fade" id="consultarModal" tabindex="-1" role="dialog" aria-labelledby="consultarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="consultarModalLabel">Consultar Asiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para consultar asiento -->
                    <form>
                        <div class="form-group">
                            <label for="consultarIDAsiento">ID del asiento</label>
                            <input type="text" class="form-control" id="consultarIDAsiento" placeholder="Ingrese el ID del asiento">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-lg">Consultar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>