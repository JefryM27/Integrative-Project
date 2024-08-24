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
    $query = "INSERT INTO asientos (fecha, cuenta, denominacion, debe, haber, glosa) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("sssdds", $fecha, $cuenta, $denominacion, $debe, $haber, $glosa);
    if ($stmt->execute()) {
        echo "<script>alert('Nuevo asiento creado correctamente');</script>";
    } else {
        echo "<script>alert('Error: " . addslashes($stmt->error) . "');</script>";
    }
    $stmt->close();
    $conexion->close();
}

// Función para modificar un asiento existente
function modificarAsiento($id, $fecha, $cuenta, $denominacion, $debe, $haber, $glosa)
{
    $conexion = get_mysql_connection();
    $query = "UPDATE asientos SET fecha=?, cuenta=?, denominacion=?, debe=?, haber=?, glosa=? WHERE id=?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("sssddsi", $fecha, $cuenta, $denominacion, $debe, $haber, $glosa, $id);
    if ($stmt->execute()) {
        echo "<script>alert('Asiento modificado correctamente');</script>";
    } else {
        echo "<script>alert('Error: " . addslashes($stmt->error) . "');</script>";
    }
    $stmt->close();
    $conexion->close();
}

// Función para borrar un asiento
function borrarAsiento($id)
{
    $conexion = get_mysql_connection();
    $query = "DELETE FROM asientos WHERE id=?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Asiento borrado correctamente');</script>";
    } else {
        echo "<script>alert('Error: " . addslashes($stmt->error) . "');</script>";
    }
    $stmt->close();
    $conexion->close();
}

function consultarAsiento($id)
{
    $conexion = get_mysql_connection();
    $query = "SELECT * FROM asientos WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $asiento = null;

    if ($resultado->num_rows > 0) {
        $asiento = $resultado->fetch_assoc();
    }

    $stmt->close();
    $conexion->close();
    return $asiento;
}

// Manejo de solicitudes POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        if ($accion === 'crear') {
            crearAsiento($_POST['fecha'], $_POST['cuenta'], $_POST['denominacion'], $_POST['debe'], $_POST['haber'], $_POST['glosa']);
        } elseif ($accion === 'modificar') {
            modificarAsiento($_POST['id'], $_POST['fecha'], $_POST['cuenta'], $_POST['denominacion'], $_POST['debe'], $_POST['haber'], $_POST['glosa']);
        } elseif ($accion === 'borrar') {
            borrarAsiento($_POST['id']);
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
                    <?php foreach ($asientos as $asiento): ?>
                        <div class="asiento" data-id="<?php echo $asiento['id']; ?>">
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
                                        <td rowspan="2"><?php echo $asiento['fecha']; ?></td>
                                        <td><?php echo $asiento['cuenta']; ?></td>
                                        <td><?php echo $asiento['denominacion']; ?></td>
                                        <td><?php echo number_format($asiento['debe'], 2); ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $asiento['cuenta']; ?></td>
                                        <td><?php echo $asiento['denominacion']; ?></td>
                                        <td></td>
                                        <td><?php echo number_format($asiento['haber'], 2); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="glosa">
                                <p><strong>Glosa:</strong> <?php echo $asiento['glosa']; ?></p>
                            </div>
                            <!-- Botones Modificar y Borrar -->
                            <div class="button-group">
                                <button class="btn btn-primary btn-lg" data-bs-toggle="modal"
                                    data-bs-target="#modificarModal"
                                    onclick="rellenarModificarModal(<?php echo htmlspecialchars(json_encode($asiento)); ?>)">
                                    Modificar
                                </button>
                                <button class="btn btn-danger btn-lg"
                                    onclick="confirmarBorrado(<?php echo $asiento['id']; ?>)">
                                    Borrar
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div> <!-- Fin del contenedor de asientos -->
                <div class="button-group">
                    <button class="btn btn-primary btn-lg" data-bs-toggle="modal"
                        data-bs-target="#crearModal">Crear</button>
                    <button class="btn btn-primary btn-lg" data-bs-toggle="modal"
                        data-bs-target="#consultarModal">Consultar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modals -->
    <!-- Crear Modal -->
    <div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="crearModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearModalLabel">Crear Asiento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" name="accion" value="crear">
                        <div class="form-group">
                            <label for="crearFecha">Fecha</label>
                            <input type="date" class="form-control" id="crearFecha" name="fecha" required>
                        </div>
                        <div class="form-group">
                            <label for="crearCuenta">Cuenta</label>
                            <input type="text" class="form-control" id="crearCuenta" name="cuenta"
                                placeholder="Ingrese la cuenta" required>
                        </div>
                        <div class="form-group">
                            <label for="crearDenominacion">Denominación</label>
                            <input type="text" class="form-control" id="crearDenominacion" name="denominacion"
                                placeholder="Ingrese la denominación" required>
                        </div>
                        <div class="form-group">
                            <label for="crearDebe">Debe</label>
                            <input type="number" class="form-control" id="crearDebe" name="debe"
                                placeholder="Ingrese el debe" required>
                        </div>
                        <div class="form-group">
                            <label for="crearHaber">Haber</label>
                            <input type="number" class="form-control" id="crearHaber" name="haber"
                                placeholder="Ingrese el haber" required>
                        </div>
                        <div class="form-group">
                            <label for="crearGlosa">Glosa</label>
                            <textarea class="form-control" id="crearGlosa" name="glosa" placeholder="Ingrese la glosa"
                                required></textarea>
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
    <div class="modal fade" id="modificarModal" tabindex="-1" aria-labelledby="modificarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modificarModalLabel">Modificar Asiento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" name="accion" value="modificar">
                        <div class="form-group">
                            <label for="modificarIDAsiento">ID del asiento</label>
                            <input type="text" class="form-control" id="modificarIDAsiento" name="id"
                                placeholder="Ingrese el ID del asiento" required>
                        </div>
                        <div class="form-group">
                            <label for="modificarFecha">Fecha</label>
                            <input type="date" class="form-control" id="modificarFecha" name="fecha" required>
                        </div>
                        <div class="form-group">
                            <label for="modificarCuenta">Cuenta</label>
                            <input type="text" class="form-control" id="modificarCuenta" name="cuenta"
                                placeholder="Ingrese la cuenta" required>
                        </div>
                        <div class="form-group">
                            <label for="modificarDenominacion">Denominación</label>
                            <input type="text" class="form-control" id="modificarDenominacion" name="denominacion"
                                placeholder="Ingrese la denominación" required>
                        </div>
                        <div class="form-group">
                            <label for="modificarDebe">Debe</label>
                            <input type="number" class="form-control" id="modificarDebe" name="debe"
                                placeholder="Ingrese el debe" required>
                        </div>
                        <div class="form-group">
                            <label for="modificarHaber">Haber</label>
                            <input type="number" class="form-control" id="modificarHaber" name="haber"
                                placeholder="Ingrese el haber" required>
                        </div>
                        <div class="form-group">
                            <label for="modificarGlosa">Glosa</label>
                            <textarea class="form-control" id="modificarGlosa" name="glosa"
                                placeholder="Ingrese la glosa" required></textarea>
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
    <div class="modal fade" id="borrarModal" tabindex="-1" aria-labelledby="borrarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="borrarModalLabel">Borrar Asiento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" name="accion" value="borrar">
                        <div class="form-group">
                            <label for="borrarIDAsiento">ID del asiento</label>
                            <input type="text" class="form-control" id="borrarIDAsiento" name="id"
                                placeholder="Ingrese el ID del asiento" required>
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
    <div class="modal fade" id="consultarModal" tabindex="-1" aria-labelledby="consultarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="consultarModalLabel">Consultar Asiento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para consultar asiento -->
                    <form id="consultarModalForm">
                        <div class="form-group">
                            <label for="consultarIDAsiento">ID del asiento</label>
                            <input type="text" class="form-control" id="consultarIDAsiento"
                                placeholder="Ingrese el ID del asiento">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-lg">Consultar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <footer>
        <p>&copy; 2024 Nombre de tu empresa. Todos los derechos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para rellenar el modal de modificar con los datos del asiento seleccionado
        function rellenarModificarModal(asiento) {
            document.getElementById('modificarIDAsiento').value = asiento.id;
            document.getElementById('modificarFecha').value = asiento.fecha;
            document.getElementById('modificarCuenta').value = asiento.cuenta;
            document.getElementById('modificarDenominacion').value = asiento.denominacion;
            document.getElementById('modificarDebe').value = asiento.debe;
            document.getElementById('modificarHaber').value = asiento.haber;
            document.getElementById('modificarGlosa').value = asiento.glosa;
        }

        // Función para confirmar el borrado de un asiento
        function confirmarBorrado(id) {
            if (confirm("¿Estás seguro de que deseas borrar este asiento?")) {
                // Crear un formulario oculto para enviar el ID del asiento a borrar
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = ''; // Debería ser la URL a donde se envía el formulario

                const inputAccion = document.createElement('input');
                inputAccion.type = 'hidden';
                inputAccion.name = 'accion';
                inputAccion.value = 'borrar';

                const inputID = document.createElement('input');
                inputID.type = 'hidden';
                inputID.name = 'id';
                inputID.value = id;

                form.appendChild(inputAccion);
                form.appendChild(inputID);

                document.body.appendChild(form);
                form.submit();
            }
        }
        document.getElementById('consultarModalForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const idConsultado = document.getElementById('consultarIDAsiento').value;
            const asientos = document.querySelectorAll('.asiento');
            let asientoEncontrado = false;

            asientos.forEach(asiento => {
                if (asiento.getAttribute('data-id') === idConsultado) {
                    asiento.style.display = 'block'; // Mostrar el asiento con el ID consultado
                    asientoEncontrado = true;
                } else {
                    asiento.style.display = 'none'; // Ocultar los demás asientos
                }
            });

            if (asientoEncontrado) {
                var modal = bootstrap.Modal.getInstance(document.getElementById('consultarModal'));
                modal.hide(); // Ocultar el modal si el asiento fue encontrado
            } else {
                alert('Asiento no encontrado');
                asientos.forEach(asiento => {
                    asiento.style.display = 'block'; // Volver a mostrar todos los asientos si no se encontró ninguno
                });
            }
        });


    </script>
</body>

</html>