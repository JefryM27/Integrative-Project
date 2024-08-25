<?php
include "../shared/header.php";
include "../models/prestamos.php";

$prestamos = getAllLoans();
?>

<body>
    <!-- Main content -->
    <main class="container main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <!-- Botón de Atrás -->
            <a href="menu.php" class="btn btn-danger">
                <i class="bi bi-arrow-left"></i> Atrás
            </a>
            <h1 class="h2">Préstamos Activos</h1>
        </div>

        <!-- Search bar -->
        <div class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar por ID, Solicitud o Estado" id="searchInput">
                <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
            </div>
        </div>

        <!-- Loan info cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card loan-info bg-light shadow-sm rounded">
                    <div class="card-body text-center">
                        <h3 class="card-title text-primary" id="approvedLoanCount">
                            <?php echo count($prestamos); ?>
                        </h3>
                        <h4>Cantidad de Préstamos Activos</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>ID Solicitud</th>
                        <th>Monto Aprobado</th>
                        <th>Fecha de Aprobación</th>
                        <th>Interés Aprobado (%)</th>
                        <th>Plazo Aprobado (Meses)</th>
                        <th>Fecha de Desembolso</th>
                        <th>Estado del Préstamo</th>
                    </tr>
                </thead>
                <tbody id="approvedLoanTableBody">
                    <?php foreach ($prestamos as $prestamo): ?>
                        <tr>
                            <td><?php echo $prestamo['id']; ?></td>
                            <td><?php echo $prestamo['solicitud_id']; ?></td>
                            <td><?php echo number_format($prestamo['monto_aprobado'], 2); ?></td>
                            <td><?php echo date('d-m-Y', strtotime($prestamo['fecha_aprobacion'])); ?></td>
                            <td><?php echo number_format($prestamo['interes_aprobado'], 2); ?>%</td>
                            <td><?php echo $prestamo['plazo_aprobado']; ?> meses</td>
                            <td><?php echo date('d-m-Y', strtotime($prestamo['fecha_desembolso'])); ?></td>
                            <td>
                                <a href="#" class="loan-status text-info" 
                                   data-id="<?php echo $prestamo['id']; ?>"
                                   data-solicitud-id="<?php echo $prestamo['solicitud_id']; ?>"
                                   data-monto-aprobado="<?php echo number_format($prestamo['monto_aprobado'], 2); ?>"
                                   data-fecha-aprobacion="<?php echo date('d-m-Y', strtotime($prestamo['fecha_aprobacion'])); ?>"
                                   data-interes-aprobado="<?php echo number_format($prestamo['interes_aprobado'], 2); ?>"
                                   data-plazo-aprobado="<?php echo $prestamo['plazo_aprobado']; ?>"
                                   data-fecha-desembolso="<?php echo date('d-m-Y', strtotime($prestamo['fecha_desembolso'])); ?>"
                                   data-estado="<?php echo ucfirst($prestamo['estado_prestamo']); ?>"
                                   data-bs-toggle="modal" data-bs-target="#loanModal">
                                   <?php echo ucfirst($prestamo['estado_prestamo']); ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="loanModal" tabindex="-1" aria-labelledby="loanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-3 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="loanModalLabel">Detalles del Préstamo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Loan Details will be injected here by JavaScript -->
                    <div id="loanDetails" class="p-3"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var loanModal = document.getElementById('loanModal');
            loanModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget; // Button that triggered the modal
                var id = button.getAttribute('data-id');
                var solicitudId = button.getAttribute('data-solicitud-id');
                var montoAprobado = button.getAttribute('data-monto-aprobado');
                var fechaAprobacion = button.getAttribute('data-fecha-aprobacion');
                var interesAprobado = button.getAttribute('data-interes-aprobado');
                var plazoAprobado = button.getAttribute('data-plazo-aprobado');
                var fechaDesembolso = button.getAttribute('data-fecha-desembolso');
                var estado = button.getAttribute('data-estado');

                var modalBody = document.getElementById('loanDetails');
                modalBody.innerHTML = `
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>ID:</strong> ${id}</p>
                            <p><strong>ID Solicitud:</strong> ${solicitudId}</p>
                            <p><strong>Monto Aprobado:</strong> ${montoAprobado}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Fecha de Aprobación:</strong> ${fechaAprobacion}</p>
                            <p><strong>Interés Aprobado (%):</strong> ${interesAprobado}%</p>
                            <p><strong>Plazo Aprobado (Meses):</strong> ${plazoAprobado}</p>
                            <p><strong>Fecha de Desembolso:</strong> ${fechaDesembolso}</p>
                            <p><strong>Estado del Préstamo:</strong> ${estado}</p>
                        </div>
                    </div>
                `;
            });
        });
    </script>
</body>
</html>

<?php
include "../shared/footer.php";
?>
