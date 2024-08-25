<?php
include '../shared/header.php';
include '../models/solicitudes.php';

$solicitudes = getAllSolicitudes();
?>

<body>
    <main class="container main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <a href="menu.php" class="btn btn-danger">Atrás</a>
            <h1 class="h2">Solicitudes de préstamos</h1>
        </div>

        <div class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar" id="searchInput" aria-label="Buscar solicitudes">
                <button class="btn btn-outline-secondary" type="button" id="searchButton" aria-label="Buscar">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>ID de Préstamo</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Tipo Préstamo</th>
                        <th>Monto</th>
                        <th>Salario Bruto</th>
                        <th>Revisión</th>
                        <th>Estudio</th>
                    </tr>
                </thead>
                <tbody id="loanTableBody">
                    <?php if (empty($solicitudes)): ?>
                        <tr>
                            <td colspan="8" class="text-center">No se encontraron solicitudes</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($solicitudes as $solicitud): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($solicitud['solicitud_id']); ?></td>
                            <td><?php echo htmlspecialchars($solicitud['cedula']); ?></td>
                            <td><?php echo htmlspecialchars($solicitud['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($solicitud['tipo_prestamo']); ?></td>
                            <td><?php echo number_format($solicitud['monto_prestamo'], 2); ?></td>
                            <td><?php echo number_format($solicitud['salario_solicitante'], 2); ?></td>
                            <td>
                                <form action="./revision_solicitud.php" method="POST">
                                    <input type="hidden" name="solicitud_id" value="<?php echo htmlspecialchars($solicitud['solicitud_id']); ?>">
                                    <button type="submit" class="btn btn-primary">Revisar</button>
                                </form>
                            </td>
                            <td>
                                <form action="./revision_prestamo_formula.php" method="POST">
                                    <input type="hidden" name="solicitud_id" value="<?php echo htmlspecialchars($solicitud['solicitud_id']); ?>">
                                    <button type="submit" class="btn btn-secondary">Estudio</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const tableRows = document.querySelectorAll('#loanTableBody tr');
            tableRows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const matches = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(searchInput));
                row.style.display = matches ? '' : 'none';
            });
        });

        document.getElementById('searchInput').addEventListener('input', function() {
            document.getElementById('searchButton').click();
        });
    </script>
</body>
<?php
include "../shared/footer.php";
?>
