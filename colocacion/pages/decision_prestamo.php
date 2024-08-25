<?php
include "../shared/header.php";

if (!isset($_POST['solicitud_id'])) {
    die("ID de la solicitud no proporcionado.");
}

$solicitud_id = $_POST['solicitud_id'];
?>

<br><br><br>
<link rel="stylesheet" href="../public/css/decision_prestamo.css">

<!-- Main Content -->
<div class="container container-custom">
    <div class="main-content">
        <h2 class="mb-4 text-center">Decisión</h2>
        <div class="decision-form mt-4">
            <form action="../models/procesar_decision.php" method="POST">
                <input type="hidden" name="solicitud_id" value="<?php echo htmlspecialchars($solicitud_id); ?>">
                
                <div class="mb-3">
                    <label for="comments" class="form-label">Comentarios:</label>
                    <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Decisión</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="decision" id="approved" value="Aprobado" checked>
                            <label class="form-check-label" for="approved">Aprobado</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="decision" id="rejected" value="Rechazado">
                            <label class="form-check-label" for="rejected">Rechazado</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="approvedAmount" class="form-label">Monto Aprobado:</label>
                    <input type="number" class="form-control" id="approvedAmount" name="monto_aprobado" step="0.01">
                </div>
                <div class="mb-3">
                    <label for="approvedInterest" class="form-label">Interés Aprobado:</label>
                    <input type="number" class="form-control" id="approvedInterest" name="interes_aprobado" step="0.01">
                </div>
                <div class="mb-3">
                    <label for="approvedTerm" class="form-label">Plazo Aprobado (meses):</label>
                    <input type="number" class="form-control" id="approvedTerm" name="plazo_aprobado">
                </div>
                <div class="mb-3">
                    <label for="disbursementDate" class="form-label">Fecha de Desembolso:</label>
                    <input type="date" class="form-control" id="disbursementDate" name="fecha_desembolso">
                </div>

                <!-- Evaluación de Riesgo del Préstamo -->
                <div class="mb-3">
                    <label for="loanRiskEvaluation" class="form-label">Evaluación de Riesgo del Préstamo</label>
                    <select class="form-select" id="loanRiskEvaluation" name="evaluacion_riesgo_prestamo">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <!-- Calificación del Cliente -->
                <div class="mb-3">
                    <label for="clientRating" class="form-label">Calificación del Cliente</label>
                    <select class="form-select" id="clientRating" name="calificacion_cliente">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-light btn-block">Enviar Decisión</button>
            </form>
        </div>
    </div>
</div>

<?php
include "../shared/footer.php";
?>
