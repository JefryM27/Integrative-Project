<?php
include "../shared/header.php";
include '../models/revision_solicitud.php';

if (isset($_POST['solicitud_id'])) {
    $solicitud_id = $_POST['solicitud_id'];
    
    $solicitud = getSolicitudById($solicitud_id);

    if ($solicitud) {
        $salary = $solicitud['salario_solicitante'];
        $loanAmount = $solicitud['monto_prestamo'];
        $loanTerm = $solicitud['plazo_prestamo_deseado'];
        $currency = $solicitud['tipo_moneda'];
    } else {
        echo "<div class='alert alert-danger text-center' role='alert'>Solicitud no encontrada.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger text-center' role='alert'>ID de solicitud no proporcionado.</div>";
    exit;
}
?>

<body>
    <div class="container mt-5">
        <!-- Botón de regreso -->
        <div class="mb-4">
            <a href="./vista_solicitudes_prestamos.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Atrás
            </a>
        </div>
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h2 class="mb-0">Análisis de Préstamo</h2>
            </div>
            <div class="card-body">
                <form id="loanForm">
                    <div class="form-group mb-4">
                        <label for="salary" class="form-label">Salario Mensual:</label>
                        <input type="number" class="form-control form-control-lg" id="salary" value="<?php echo htmlspecialchars($salary); ?>" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="loanAmount" class="form-label">Monto del Préstamo:</label>
                        <input type="number" class="form-control form-control-lg" id="loanAmount" value="<?php echo htmlspecialchars($loanAmount); ?>" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="loanTerm" class="form-label">Plazo del Préstamo (Meses):</label>
                        <input type="number" class="form-control form-control-lg" id="loanTerm" value="<?php echo htmlspecialchars($loanTerm); ?>" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="currency" class="form-label">Moneda:</label>
                        <select class="form-control form-control-lg" id="currency" required>
                            <option value="USD" <?php echo ($currency === 'USD') ? 'selected' : ''; ?>>Dólares</option>
                            <option value="CRC" <?php echo ($currency === 'CRC') ? 'selected' : ''; ?>>Colones</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Analizar</button>
                </form>
                <div class="result-section mt-5">
                    <h4 class="text-center">Resultado:</h4>
                    <p id="result" class="text-center font-weight-bold"></p>
                    <p id="monthlyPaymentResult" class="text-center font-weight-bold"></p>
                    <div class="d-flex justify-content-center">
                        <canvas id="comparisonChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../public/js/revision_prestamo_formula.js"></script>

    <?php
    include "../shared/footer.php";
    ?>
</body>
