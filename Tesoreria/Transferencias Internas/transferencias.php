<?php
include '../utils/database.php';

$conn = get_mysql_connection();

// Cargar cuentas
$cuentasQuery = "SELECT id, numero_cuenta FROM cuentasbanco";
$cuentasResult = $conn->query($cuentasQuery);

// Cargar organizaciones
$organizacionesQuery = "SELECT organizacion_id, nombre FROM organizaciones";
$organizacionesResult = $conn->query($organizacionesQuery);

// Cargar transferencias recientes
$transferenciasQuery = "SELECT t.id, c.numero_cuenta AS cuenta_origen, t.cuenta_destino, t.moneda, t.monto, t.fecha_hora, t.descripcion, t.estado, o.nombre AS organizacion 
                        FROM transferenciasinternas t 
                        JOIN cuentasbanco c ON t.id_cuenta = c.id
                        JOIN organizaciones o ON t.id_organizacion = o.organizacion_id";
$transferenciasResult = $conn->query($transferenciasQuery);

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transferencias Internas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="header d-flex justify-content-between align-items-center px-3 py-2">
        <div>
            <a href="../index.html" class="btn btn-light mx-3 my-2">Volver</a>
        </div>
        <h3 class="text-center flex-grow-1">Transferencias Internas</h3>
        <h5 class="navbar navbar-light">logo</h5>
    </div>
    <div class="container-fluid">
        <div class="content">
            <!-- Tabla de transferencias recientes -->
            <div class="row mx-3">
                <div class="col-md-4">
                    <h3>Transferencias Recientes</h3>
                </div>
                <!-- Filtros -->
                <!-- Colocar filtros aquí si es necesario -->
            </div>

            <div class="row justify-content-center mb-3">
                <div class="col-md-10">
                    <div class="table-responsive mt-4" style="max-height: 390px; overflow-y: auto;">
                        <table class="table table-bordered" id="transferenciasTable">
                            <thead>
                                <tr>
                                    <th>Numero de Transferencia</th>
                                    <th>Cuenta Origen</th>
                                    <th>Cuenta Destino</th>
                                    <th>Moneda</th>
                                    <th>Monto</th>
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Organización</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $transferenciasResult->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['cuenta_origen']; ?></td>
                                        <td><?php echo $row['cuenta_destino']; ?></td>
                                        <td><?php echo $row['moneda']; ?></td>
                                        <td><?php echo number_format($row['monto'], 2); ?></td>
                                        <td><?php echo $row['fecha_hora']; ?></td>
                                        <td><?php echo $row['descripcion']; ?></td>
                                        <td><?php echo $row['estado']; ?></td>
                                        <td><?php echo $row['organizacion']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario de transferencia -->
        <div class="row mb-5 justify-content-center">
            <div class="col-md-6">
                <h3>Realizar Transferencia</h3>
                <form id="formTransferencia" action="procesarTransferencia.php" method="POST">
                    <div class="mb-3">
                        <label for="tipoTransferencia" class="form-label">Tipo de Transferencia</label>
                        <select class="form-select" id="tipoTransferencia" name="tipoTransferencia" disabled>
                            <option value="Interna">Interna</option>
                            <option value="Externa">Externa</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="divisaTransaccion" class="form-label">Moneda</label>
                        <select class="form-select" id="divisaTransaccion" name="divisaTransaccion"
                            onchange="filtrarCuentasPorMoneda()">
                            <option value="">Seleccione una moneda</option>
                            <option value="CRC">CRC</option>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                        </select>
                    </div>
                    <div class="mb-3" id="cuentasContainer" style="display: none;">
                        <label for="cuentaOrigen" class="form-label">Cuenta Origen</label>
                        <select class="form-select" id="cuentaOrigen" name="cuentaOrigen" required>
                            <!-- Opciones se rellenarán con JavaScript -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cuentaDestino" class="form-label">Cuenta Destino</label>
                        <input type="text" class="form-control" id="cuentaDestino" name="cuentaDestino"
                            placeholder="Ingrese la cuenta de destino" required>
                    </div>
                    <div class="mb-3">
                        <label for="monto" class="form-label">Monto</label>
                        <input type="number" step="0.01" class="form-control" id="monto" name="monto"
                            placeholder="Ingrese el monto a transferir" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion"
                            placeholder="Ingrese la descripción" required>
                    </div>
                    <div class="mb-3">
                        <label for="organizacion" class="form-label">Organización</label>
                        <select class="form-select" id="organizacion" name="organizacion">
                            <?php while ($org = $organizacionesResult->fetch_assoc()): ?>
                                <option value="<?php echo $org['organizacion_id']; ?>">
                                    <?php echo $org['nombre']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg" id="realizarTransferenciaBtn">Realizar
                        Transferencia</button>
                </form>
            </div>
            <div class="col-md-5">
                <h3>Transferencias Internas Completadas</h3>
                <canvas id="Chart3"></canvas>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.getElementById('cuentaOrigen').addEventListener('change', function () {
            var selectedOption = this.options[this.selectedIndex];
            document.getElementById('numeroCuentaOrigen').value = selectedOption.getAttribute('data-numero-cuenta');
        });

        function filtrarCuentasPorMoneda() {
            var monedaSeleccionada = document.getElementById('divisaTransaccion').value;
            var cuentasContainer = document.getElementById('cuentasContainer');
            var cuentaOrigenSelect = document.getElementById('cuentaOrigen');

            if (!monedaSeleccionada) {
                cuentasContainer.style.display = 'none';
                cuentaOrigenSelect.innerHTML = '';
                return;
            }

            cuentasContainer.style.display = 'block';
            cuentaOrigenSelect.innerHTML = '';

            fetch('getCuentas.php?moneda=' + monedaSeleccionada)
                .then(response => response.json())
                .then(data => {
                    data.forEach(cuenta => {
                        var option = document.createElement('option');
                        option.value = cuenta.id;  // Aquí solo se usa el ID
                        option.textContent = cuenta.numero_cuenta;  // Mostrar el número de cuenta
                        cuentaOrigenSelect.appendChild(option);
                    });
                });
        }



        document.addEventListener('DOMContentLoaded', function () {
            fetch('getTransferenciasCompletadas.php')
                .then(response => response.json())
                .then(data => {
                    var dias = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    var diasTraducidos = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
                    var transferenciasPorDia = Array(7).fill(0); // Inicializar con ceros

                    // Rellenar los datos en transferenciasPorDia según el día de la semana
                    data.forEach(item => {
                        var diaIndex = dias.indexOf(item.dia);
                        if (diaIndex !== -1) {
                            transferenciasPorDia[diaIndex] = item.total;
                        }
                    });

                    // Crear el gráfico
                    var scheduledTransfersCtx = document.getElementById('Chart3').getContext('2d');
                    var Chart3 = new Chart(scheduledTransfersCtx, {
                        type: 'line',
                        data: {
                            labels: diasTraducidos,
                            datasets: [{
                                label: 'Transferencias Completadas',
                                data: transferenciasPorDia,
                                backgroundColor: 'rgba(59, 89, 152, 0.2)',
                                borderColor: 'rgba(59, 89, 152, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        });
    </script>
    <footer class="footer">
        <p>&copy; 2024 Cooperativa de Ahorro. Todos los derechos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>