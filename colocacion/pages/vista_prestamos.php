<?php
include "../shared/header.php";
include '../models/solicitudes.php'; 

// Obtener las solicitudes en revisión
$solicitudes = getSolicitudesEnRevision();
?>
<body>
    <main class="container main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <a href="menu.php" class="btn btn-danger">Atrás</a>
            <h1 class="h2">Préstamos Decicion</h1>
        </div>

        <div class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar" id="searchInput">
                <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card loan-info">
                    <div class="card-body text-center">
                        <h3 class="card-title" id="loanCount"><?php echo count($solicitudes); ?></h3>
                        <h3>Cantidad de Préstamos</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Tipo Préstamo</th>
                        <th>Monto</th>
                        <th>Salario Bruto</th>
                        <th>Revisión</th>
                        <th>Decisión</th>
                    </tr>
                </thead>
                <tbody id="loanTableBody">
                    <?php foreach ($solicitudes as $solicitud): ?>
                        <tr>
                            <td><?php echo $solicitud['solicitud_id']; ?></td>
                            <td><?php echo $solicitud['cedula']; ?></td>
                            <td><?php echo $solicitud['nombre']; ?></td>
                            <td><?php echo $solicitud['tipo_prestamo']; ?></td>
                            <td><?php echo number_format($solicitud['monto_prestamo'], 2); ?></td>
                            <td><?php echo number_format($solicitud['salario_solicitante'], 2); ?></td>
                            <td><?php echo $solicitud['estado_solicitud']; ?></td>
                            <td>
                                <form action="./decision_prestamo.php" method="POST">
                                    <input type="hidden" name="solicitud_id" value="<?php echo $solicitud['solicitud_id']; ?>">
                                    <button type="submit" class="btn btn-primary">Tomar Decisión</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include "../shared/footer.php";
?>
