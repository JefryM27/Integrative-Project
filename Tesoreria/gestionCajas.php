<?php
include('utils/database.php');

function obtenerCajas()
{
    $conexion = get_mysql_connection();
    $query = "SELECT * FROM cajas";
    $resultado = $conexion->query($query);
    $cajas = [];

    while ($fila = $resultado->fetch_assoc()) {
        $cajas[] = $fila;
    }

    $conexion->close();
    return $cajas;
}


function obtenerArqueos()
{
    $conexion = get_mysql_connection();
    $query = "SELECT a.*, c.nombre AS caja FROM arqueos a 
              INNER JOIN cajas c ON a.caja_id = c.id";
    $resultado = $conexion->query($query);
    $arqueos = [];

    while ($fila = $resultado->fetch_assoc()) {
        $arqueos[] = $fila;
    }

    $conexion->close();
    return $arqueos;
}

function agregarArqueo($fecha, $caja_id, $responsable, $saldo_inicial, $entradas, $salidas, $saldo_final)
{
    $conexion = get_mysql_connection();
    $query = "INSERT INTO arqueos (fecha, caja_id, responsable, saldo_inicial, entradas, salidas, saldo_final) 
              VALUES ('$fecha', '$caja_id', '$responsable', '$saldo_inicial', '$entradas', '$salidas', '$saldo_final')";
    $conexion->query($query);
    $conexion->close();
}

function editarArqueo($id, $fecha, $caja_id, $responsable, $saldo_inicial, $entradas, $salidas, $saldo_final)
{
    $conexion = get_mysql_connection();
    $query = "UPDATE arqueos SET fecha='$fecha', caja_id='$caja_id', responsable='$responsable', 
              saldo_inicial='$saldo_inicial', entradas='$entradas', salidas='$salidas', saldo_final='$saldo_final' 
              WHERE id='$id'";
    $conexion->query($query);
    $conexion->close();
}

function eliminarArqueo($id)
{
    $conexion = get_mysql_connection();
    $query = "DELETE FROM arqueos WHERE id='$id'";
    $conexion->query($query);
    $conexion->close();
}

function transferirDinero($solicitud_id, $caja_destino_id, $moneda, $monto, $descripcion)
{
    $conexion = get_mysql_connection();
    $query = "INSERT INTO transferencias (solicitud_id, caja_destino_id, moneda, monto, descripcion) 
              VALUES ('$solicitud_id', '$caja_destino_id', '$moneda', '$monto', '$descripcion')";
    $conexion->query($query);

    // Actualizar el saldo de la caja de destino
    $queryActualizarSaldo = "UPDATE cajas SET saldo = saldo + $monto WHERE id = '$caja_destino_id'";
    $conexion->query($queryActualizarSaldo);

    $conexion->close();
}

// Manejo de solicitudes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'agregarArqueo':
                agregarArqueo(
                    $_POST['fecha'],
                    $_POST['caja_id'],
                    $_POST['responsable'],
                    $_POST['saldo_inicial'],
                    $_POST['entradas'],
                    $_POST['salidas'],
                    $_POST['saldo_final']
                );
                break;
            case 'editarArqueo':
                editarArqueo(
                    $_POST['id'],
                    $_POST['fecha'],
                    $_POST['caja_id'],
                    $_POST['responsable'],
                    $_POST['saldo_inicial'],
                    $_POST['entradas'],
                    $_POST['salidas'],
                    $_POST['saldo_final']
                );
                break;
            case 'eliminarArqueo':
                eliminarArqueo($_POST['id']);
                break;
            case 'transferirDinero':
                transferirDinero(
                    $_POST['solicitud_id'],
                    $_POST['caja_destino_id'],
                    $_POST['moneda'],
                    $_POST['monto'],
                    $_POST['descripcion']
                );
                break;
        }
    }
}



// Obtener datos para mostrar en la interfaz
$cajas = obtenerCajas();
$arqueos = obtenerArqueos();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Cajas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="header d-flex justify-content-between align-items-center px-3 py-2">
        <div>
            <a href="index.html" class="btn btn-light mx-3 my-2">Volver</a>
        </div>
        <h3 class="text-center flex-grow-1">Gestion de Cajas</h3>
        <h5 class="navbar navbar-light">logo</h5>
    </div>
    <div class="container-fluid">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-3 mx-5">
                    <h3>Arqueo de Cajas</h3>
                </div>
                <div class="col-md-3">
                    <label for="filterCedula" class="form-label">Filtrar por #</label>
                    <input type="text" class="form-control" id="filterCedula" placeholder="Ingrese número de Registro">
                </div>
                <div class="col-md-3">
                    <label for="filterTipo" class="form-label">Filtrar por Caja</label>
                    <select class="form-select" id="filterTipo">
                        <option value="">Todas</option>
                        <option value="Caja 1">Caja 1</option>
                        <option value="Caja 2">Caja 2</option>
                        <option value="Caja 3">Caja 3</option>
                        <option value="Caja Chica">Caja Chica</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Caja</th>
                                <th>Responsable</th>
                                <th>Saldo Inicial</th>
                                <th>Entradas</th>
                                <th>Salidas</th>
                                <th>Saldo Final</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($arqueos as $arqueo): ?>
                                <tr data-id="<?= $arqueo['id'] ?>">
                                    <td><?= $arqueo['id'] ?></td>
                                    <td class="registro-fecha"><?= $arqueo['fecha'] ?></td>
                                    <td class="registro-caja" data-caja-id="<?= $arqueo['caja_id'] ?>"><?= $arqueo['caja'] ?></td>
                                    <td class="registro-responsable"><?= $arqueo['responsable'] ?></td>
                                    <td class="registro-saldo-inicial">₡<?= number_format($arqueo['saldo_inicial'], 2) ?></td>
                                    <td class="registro-entradas">₡<?= number_format($arqueo['entradas'], 2) ?></td>
                                    <td class="registro-salidas">₡<?= number_format($arqueo['salidas'], 2) ?></td>
                                    <td class="registro-saldo-final">₡<?= number_format($arqueo['saldo_final'], 2) ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-lg btn-sm mx-1" data-bs-toggle="modal"
                                            data-bs-target="#modalRegistro"
                                            onclick="editarRegistro(<?= $arqueo['id'] ?>)">Editar</button>
                                        <button class="btn btn-danger btn-lg btn-sm mx-1" data-bs-toggle="modal"
                                            data-bs-target="#modalEliminarRegistro"
                                            onclick="eliminarRegistro(<?= $arqueo['id'] ?>)">Eliminar</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
                <button class="btn btn-primary btn-lg btn-sm mx-1 mb-5" data-bs-toggle="modal"
                    data-bs-target="#modalRegistro">Añadir Registro</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-5">
            <h3>Transferir Dinero a Cajas</h3>
        </div>
    </div>
    <form id="formTransferencia" method="POST" action="gestionCajas.php">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-3 mb-5">
                <input type="hidden" name="accion" value="transferirDinero">
                <label for="solicitud" class="form-label">Solicitud de dinero</label>
                <select class="form-select" id="solicitud" name="solicitud_id" required>
                    <option value="1">Caja 1 - Euro</option>
                    <option value="2">Caja 2 - Dólar</option>
                    <option value="3">Caja 3 - Colones</option>
                </select>
                <label for="cajaDestino" class="form-label">Caja de Destino</label>
                <select class="form-select" id="cajaDestino" name="caja_destino_id" required>
                    <?php foreach ($cajas as $caja): ?>
                        <option value="<?= $caja['id'] ?>">
                            <?= $caja['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="moneda" class="form-label">Moneda</label>
                <select class="form-select" id="moneda" name="moneda" required>
                    <option value="CRC">Colones</option>
                    <option value="USD">Dólares</option>
                    <option value="EUR">Euros</option>
                </select>
                <label for="montoTransferencia" class="form-label">Monto a Transferir</label>
                <input type="number" class="form-control" id="montoTransferencia" name="monto"
                    placeholder="Ingrese el monto a transferir" required>
                <label for="descripcionTransferencia" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcionTransferencia" name="descripcion"
                    placeholder="Ingrese una descripción">
                <button type="submit" class="btn btn-primary btn-lg mt-3">Transferir</button>
            </div>

            <div class="col-md-5">
                <h4>Gráfico de Transferencias a Cajas Completadas</h4>
                <canvas id="scheduledTransfersChart"></canvas>
            </div>
        </div>
    </form>

    <!-- Modal para Añadir/Editar Registro -->
    <div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="modalRegistroLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRegistroLabel">Añadir/Editar Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formRegistro" method="POST" action="gestionCajas.php">
                        <input type="hidden" name="accion" id="registroAccion" value="agregarArqueo">
                        <input type="hidden" name="id" id="registroId">
                        <div class="mb-3">
                            <label for="registroFecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="registroFecha" name="fecha" required>
                        </div>
                        <div class="mb-3">
                            <label for="registroCaja" class="form-label">Caja</label>
                            <select class="form-select" id="registroCaja" name="caja_id" required>
                                <?php foreach ($cajas as $caja): ?>
                                    <option value="<?= $caja['id'] ?>">
                                        <?= $caja['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="registroResponsable" class="form-label">Responsable</label>
                            <input type="text" class="form-control" id="registroResponsable" name="responsable"
                                placeholder="Ingrese el nombre del responsable" required>
                        </div>
                        <div class="mb-3">
                            <label for="registroSaldoInicial" class="form-label">Saldo Inicial</label>
                            <input type="number" class="form-control" id="registroSaldoInicial" name="saldo_inicial"
                                placeholder="Ingrese el saldo inicial" required>
                        </div>
                        <div class="mb-3">
                            <label for="registroEntradas" class="form-label">Entradas</label>
                            <input type="number" class="form-control" id="registroEntradas" name="entradas"
                                placeholder="Ingrese las entradas" required>
                        </div>
                        <div class="mb-3">
                            <label for="registroSalidas" class="form-label">Salidas</label>
                            <input type="number" class="form-control" id="registroSalidas" name="salidas"
                                placeholder="Ingrese las salidas" required>
                        </div>
                        <div class="mb-3">
                            <label for="registroSaldoFinal" class="form-label">Saldo Final</label>
                            <input type="number" class="form-control" id="registroSaldoFinal" name="saldo_final"
                                placeholder="Ingrese el saldo final" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Registro</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Confirmar Eliminación -->
    <div class="modal fade" id="modalEliminarRegistro" tabindex="-1" aria-labelledby="modalEliminarRegistroLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEliminarRegistroLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de eliminar este registro?</p>
                    <form method="POST" action="gestionCajas.php">
                        <input type="hidden" name="accion" value="eliminarArqueo">
                        <input type="hidden" name="id" id="eliminarRegistroId">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Cooperativa de Ahorro. Todos los derechos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="grafTransferencias.js"></script>
    <script>
        function editarRegistro(id) {
            // Buscar los datos del registro en el DOM
            const registro = document.querySelector(`tr[data-id="${id}"]`);

            // Obtener los valores de las celdas correspondientes
            const fecha = registro.querySelector('.registro-fecha').textContent.trim();
            const cajaId = registro.querySelector('.registro-caja').getAttribute('data-caja-id');
            const responsable = registro.querySelector('.registro-responsable').textContent.trim();
            const saldoInicial = parseFloat(registro.querySelector('.registro-saldo-inicial').textContent.replace('₡', '').replace(',', ''));
            const entradas = parseFloat(registro.querySelector('.registro-entradas').textContent.replace('₡', '').replace(',', ''));
            const salidas = parseFloat(registro.querySelector('.registro-salidas').textContent.replace('₡', '').replace(',', ''));
            const saldoFinal = parseFloat(registro.querySelector('.registro-saldo-final').textContent.replace('₡', '').replace(',', ''));

            // Rellenar los campos del modal con los datos del registro
            document.getElementById('registroId').value = id;
            document.getElementById('registroAccion').value = 'editarArqueo';
            document.getElementById('registroFecha').value = fecha;
            document.getElementById('registroCaja').value = cajaId;
            document.getElementById('registroResponsable').value = responsable;
            document.getElementById('registroSaldoInicial').value = saldoInicial;
            document.getElementById('registroEntradas').value = entradas;
            document.getElementById('registroSalidas').value = salidas;
            document.getElementById('registroSaldoFinal').value = saldoFinal;

            // Mostrar el modal
            const modalRegistro = new bootstrap.Modal(document.getElementById('modalRegistro'));
            modalRegistro.show();
        }


        function eliminarRegistro(id) {
            document.getElementById('eliminarRegistroId').value = id;
        }
    </script>
</body>

</html>