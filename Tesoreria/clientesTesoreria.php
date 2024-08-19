<?php
include('utils/database.php');

function obtenerClientes()
{
    $conexion = get_mysql_connection();
    $query = "SELECT * FROM clientes_tesoreria";
    $resultado = $conexion->query($query);
    $clientes = [];

    while ($fila = $resultado->fetch_assoc()) {
        $clientes[] = $fila;
    }

    $conexion->close();
    return $clientes;
}

function agregarCliente($nombre, $cuenta_iban, $organizacion)
{
    $conexion = get_mysql_connection();
    $query = "INSERT INTO clientes_tesoreria (nombre, cuenta_iban, organizacion) 
              VALUES ('$nombre', '$cuenta_iban', '$organizacion')";
    $conexion->query($query);
    $conexion->close();
}

function editarCliente($id, $nombre, $cuenta_iban, $organizacion)
{
    $conexion = get_mysql_connection();
    $query = "UPDATE clientes_tesoreria SET nombre='$nombre', cuenta_iban='$cuenta_iban', organizacion='$organizacion' 
              WHERE id='$id'";
    $conexion->query($query);
    $conexion->close();
}

function eliminarCliente($id)
{
    $conexion = get_mysql_connection();
    $query = "DELETE FROM clientes_tesoreria WHERE id='$id'";
    $conexion->query($query);
    $conexion->close();
}

// Manejo de solicitudes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'agregarCliente':
                agregarCliente($_POST['nombre'], $_POST['cuenta_iban'], $_POST['organizacion']);
                header('Location: clientesTesoreria.php');
                exit();
            case 'editarCliente':
                editarCliente($_POST['id'], $_POST['nombre'], $_POST['cuenta_iban'], $_POST['organizacion']);
                header('Location: clientesTesoreria.php');
                exit();
            case 'eliminarCliente':
                eliminarCliente($_POST['id']);
                header('Location: clientesTesoreria.php');
                exit();
        }
    }
}

// Obtener datos para mostrar en la interfaz
$clientes = obtenerClientes();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes de Tesorería</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="header d-flex justify-content-between align-items-center px-3 py-2">
        <div>
            <a href="index.html" class="btn btn-light mx-3 my-2">Volver</a>
        </div>
        <h3 class="text-center flex-grow-1">Gestión de Clientes de Tesorería</h3>
        <h5 class="navbar navbar-light">logo</h5>
    </div>
    <div class="container-fluid">
        <div class="content">
            <div class="row justify-content-center mb-3">
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Cuenta IBAN</th>
                                    <th>Organización</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clientes as $cliente): ?>
                                    <tr>
                                        <td>
                                            <?= $cliente['id'] ?>
                                        </td>
                                        <td>
                                            <?= $cliente['nombre'] ?>
                                        </td>
                                        <td>
                                            <?= $cliente['cuenta_iban'] ?>
                                        </td>
                                        <td>
                                            <?= $cliente['organizacion'] ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-lg btn-sm mx-1" data-bs-toggle="modal"
                                                data-bs-target="#modalEditarCliente"
                                                onclick="cargarClienteParaEditar(<?= $cliente['id'] ?>, '<?= $cliente['nombre'] ?>', '<?= $cliente['cuenta_iban'] ?>', '<?= $cliente['organizacion'] ?>')">Editar</button>
                                            <button class="btn btn-danger btn-lg btn-sm mx-1" data-bs-toggle="modal"
                                                data-bs-target="#modalEliminarCliente"
                                                onclick="prepararEliminarCliente(<?= $cliente['id'] ?>)">Eliminar</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-primary btn-lg mb-3" data-bs-toggle="modal"
                        data-bs-target="#modalAgregarCliente">Agregar Cliente</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Cliente -->
    <div class="modal fade" id="modalAgregarCliente" tabindex="-1" aria-labelledby="modalAgregarClienteLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarClienteLabel">Agregar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarCliente" method="POST" action="clientesTesoreria.php">
                        <input type="hidden" name="accion" value="agregarCliente">
                        <label for="nombreCliente" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreCliente" name="nombre"
                            placeholder="Ingrese el nombre" required>
                        <label for="cuentaIban" class="form-label">Cuenta IBAN</label>
                        <input type="text" class="form-control" id="cuentaIban" name="cuenta_iban"
                            placeholder="Ingrese la cuenta IBAN" required>
                        <label for="organizacion" class="form-label">Organización</label>
                        <select class="form-select" id="organizacion" name="organizacion" required>
                            <option value="Org A">Org A</option>
                            <option value="Org B">Org B</option>
                            <option value="Org C">Org C</option>
                            <option value="Org D">Org D</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-lg mt-3">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Cliente -->
    <div class="modal fade" id="modalEditarCliente" tabindex="-1" aria-labelledby="modalEditarClienteLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarClienteLabel">Editar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditarCliente" method="POST" action="clientesTesoreria.php">
                        <input type="hidden" name="accion" value="editarCliente">
                        <input type="hidden" name="id" id="idClienteEdit">
                        <label for="nombreClienteEdit" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreClienteEdit" name="nombre"
                            placeholder="Ingrese el nombre" required>
                        <label for="cuentaIbanEdit" class="form-label">Cuenta IBAN</label>
                        <input type="text" class="form-control" id="cuentaIbanEdit" name="cuenta_iban"
                            placeholder="Ingrese la cuenta IBAN" required>
                        <label for="organizacionEdit" class="form-label">Organización</label>
                        <select class="form-select" id="organizacionEdit" name="organizacion" required>
                            <option value="Org A">Org A</option>
                            <option value="Org B">Org B</option>
                            <option value="Org C">Org C</option>
                            <option value="Org D">Org D</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-lg mt-3">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar Cliente -->
    <div class="modal fade" id="modalEliminarCliente" tabindex="-1" aria-labelledby="modalEliminarClienteLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEliminarClienteLabel">Eliminar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="clientesTesoreria.php">
                        <input type="hidden" name="accion" value="eliminarCliente">
                        <input type="hidden" name="id" id="idClienteEliminar">
                        <p>¿Estás seguro de eliminar este cliente?</p>
                        <button type="submit" class="btn btn-danger btn-lg">Eliminar</button>
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
        function cargarClienteParaEditar(id, nombre, cuentaIban, organizacion) {
            document.getElementById('idClienteEdit').value = id;
            document.getElementById('nombreClienteEdit').value = nombre;
            document.getElementById('cuentaIbanEdit').value = cuentaIban;
            document.getElementById('organizacionEdit').value = organizacion;
        }

        function prepararEliminarCliente(id) {
            document.getElementById('idClienteEliminar').value = id;
        }
    </script>
</body>

</html>