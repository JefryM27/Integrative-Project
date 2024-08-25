<?php
include "../shared/header.php";
include '../models/solicitudes.php'; 
include '../models/revision_solicitud.php';

if (isset($_POST['solicitud_id'])) {
    $solicitud_id = $_POST['solicitud_id'];
    
    $solicitud = getSolicitudById($solicitud_id);
    $archivos_adjuntos = getArchivosAdjuntosBySolicitudId($solicitud_id);

    $cedulaFile = '';
    $planoFile = '';
    $estudioCasaFile = '';
    $salarioDesglozadoFile = '';
    $comprobanteMatricula = '';

    foreach ($archivos_adjuntos as $archivo) {
        if ($archivo['tipo_archivo'] == 'Cédula') {
            $cedulaFile = $archivo['nombre_archivo'];
        } elseif ($archivo['tipo_archivo'] == 'Plano') {
            $planoFile = $archivo['nombre_archivo'];
        } elseif ($archivo['tipo_archivo'] == 'Estudio de la Casa') {
            $estudioCasaFile = $archivo['nombre_archivo'];
        } elseif ($archivo['tipo_archivo'] == 'Salario Desglosado') {
            $salarioDesglozadoFile = $archivo['nombre_archivo'];
        } elseif ($archivo['tipo_archivo'] == 'Comprobante de Matrícula') {
            $comprobanteMatricula = $archivo['nombre_archivo'];
        }
    }

    if ($solicitud) {
        $numero_de_cuenta = $solicitud['numero_de_cuenta'] ?? '';
        $monto_prestamo = $solicitud['monto_prestamo'] ?? '';
        $plazo_prestamo_deseado = $solicitud['plazo_prestamo_deseado'] ?? '';
        $salario_solicitante = $solicitud['salario_solicitante'] ?? '';
        $tipo_moneda = $solicitud['tipo_moneda'] ?? '';
    } else {
        echo "Solicitud no encontrada.";
        exit;
    }
} else {
    echo "ID de solicitud no proporcionado.";
    exit;
}
?>

<body>
    <link rel="stylesheet" href="../public/css/form_solicitud_prestamo.css">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center color1 text-white">
                <h2>COODESCA</h2>
                <p>Revisión de Préstamo</p>
            </div>
            <div class="card-body">
                <form id="loanForm" action="../models/actualizar_solicitud.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="solicitud_id" value="<?php echo htmlspecialchars($solicitud_id); ?>">
                    <div id="accordion">
                        <!-- Sección 1: Información Personal -->
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <a class="btn btn-link" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        1. INFORMACIÓN PERSONAL
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="numeroCuenta">Número de Cuenta</label>
                                        <input type="text" class="form-control" id="numeroCuenta" name="numero_de_cuenta" value="<?php echo htmlspecialchars($numero_de_cuenta); ?>" required>
                                        <div class="custom-control custom-checkbox mt-2">
                                            <input type="checkbox" class="custom-control-input" id="checkNumeroCuenta" <?php echo !empty($numero_de_cuenta) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="checkNumeroCuenta">Completado</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 2: Información Financiera -->
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <a class="btn btn-link collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        2. INFORMACIÓN FINANCIERA
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="loanAmount">Monto del Préstamo</label>
                                        <input type="text" class="form-control" id="loanAmount" name="monto_prestamo" value="<?php echo htmlspecialchars($monto_prestamo); ?>" required>
                                        <div class="custom-control custom-checkbox mt-2">
                                            <input type="checkbox" class="custom-control-input" id="checkLoanAmount" <?php echo !empty($monto_prestamo) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="checkLoanAmount">Completado</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="loanTerm">Plazo del Préstamo Deseado</label>
                                        <input type="text" class="form-control" id="loanTerm" name="plazo_prestamo_deseado" value="<?php echo htmlspecialchars($plazo_prestamo_deseado); ?>" required>
                                        <div class="custom-control custom-checkbox mt-2">
                                            <input type="checkbox" class="custom-control-input" id="checkLoanTerm" <?php echo !empty($plazo_prestamo_deseado) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="checkLoanTerm">Completado</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="salary">Salario del Solicitante</label>
                                        <input type="text" class="form-control" id="salary" name="salario_solicitante" value="<?php echo htmlspecialchars($salario_solicitante); ?>" required>
                                        <div class="custom-control custom-checkbox mt-2">
                                            <input type="checkbox" class="custom-control-input" id="checkSalary" <?php echo !empty($salario_solicitante) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="checkSalary">Completado</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 3: Adjuntar Archivos -->
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <a class="btn btn-link collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        3. ADJUNTAR ARCHIVOS
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="cedulaFile">Adjuntar Cédula</label>
                                        <input type="file" class="form-control-file" id="cedulaFile" name="cedulaFile" accept=".pdf,.jpg,.png">
                                        <?php if (!empty($cedulaFile)): ?>
                                            <a href="ruta/a/archivos/<?php echo htmlspecialchars($cedulaFile); ?>" download>Descargar Cédula</a>
                                        <?php endif; ?>
                                        <div class="custom-control custom-checkbox mt-2">
                                            <input type="checkbox" class="custom-control-input" id="checkCedulaFile" <?php echo !empty($cedulaFile) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="checkCedulaFile">Completado</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="planoFile">Adjuntar Plano</label>
                                        <input type="file" class="form-control-file" id="planoFile" name="planoFile" accept=".pdf,.jpg,.png">
                                        <?php if (!empty($planoFile)): ?>
                                            <a href="ruta/a/archivos/<?php echo htmlspecialchars($planoFile); ?>" download>Descargar Plano</a>
                                        <?php endif; ?>
                                        <div class="custom-control custom-checkbox mt-2">
                                            <input type="checkbox" class="custom-control-input" id="checkPlanoFile" <?php echo !empty($planoFile) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="checkPlanoFile">Completado</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="estudioCasaFile">Adjuntar Estudio de la Casa</label>
                                        <input type="file" class="form-control-file" id="estudioCasaFile" name="estudioCasaFile" accept=".pdf,.jpg,.png">
                                        <?php if (!empty($estudioCasaFile)): ?>
                                            <a href="ruta/a/archivos/<?php echo htmlspecialchars($estudioCasaFile); ?>" download>Descargar Estudio de la Casa</a>
                                        <?php endif; ?>
                                        <div class="custom-control custom-checkbox mt-2">
                                            <input type="checkbox" class="custom-control-input" id="checkEstudioCasaFile" <?php echo !empty($estudioCasaFile) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="checkEstudioCasaFile">Completado</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="salarioDesglozadoFile">Adjuntar Salario Desglosado</label>
                                        <input type="file" class="form-control-file" id="salarioDesglozadoFile" name="salarioDesglozadoFile" accept=".pdf,.jpg,.png">
                                        <?php if (!empty($salarioDesglozadoFile)): ?>
                                            <a href="ruta/a/archivos/<?php echo htmlspecialchars($salarioDesglozadoFile); ?>" download>Descargar Salario Desglosado</a>
                                        <?php endif; ?>
                                        <div class="custom-control custom-checkbox mt-2">
                                            <input type="checkbox" class="custom-control-input" id="checkSalarioDesglozadoFile" <?php echo !empty($salarioDesglozadoFile) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="checkSalarioDesglozadoFile">Completado</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="comprobanteMatricula">Adjuntar Comprobante de Matrícula de Estudio</label>
                                        <input type="file" class="form-control-file" id="comprobanteMatricula" name="comprobanteMatricula" accept=".pdf,.jpg,.png">
                                        <?php if (!empty($comprobanteMatricula)): ?>
                                            <a href="ruta/a/archivos/<?php echo htmlspecialchars($comprobanteMatricula); ?>" download>Descargar Comprobante de Matrícula</a>
                                        <?php endif; ?>
                                        <div class="custom-control custom-checkbox mt-2">
                                            <input type="checkbox" class="custom-control-input" id="checkComprobanteMatricula" <?php echo !empty($comprobanteMatricula) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="checkComprobanteMatricula">Completado</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 4: Escoger Moneda -->
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    <a class="btn btn-link collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        4. ESCOGER MONEDA
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="monedaSelect2">Seleccionar Moneda</label>
                                        <select class="form-control" id="monedaSelect2" name="tipo_moneda" required>
                                            <option value="Colon" <?php echo ($tipo_moneda === 'Colon') ? 'selected' : ''; ?>>Colón</option>
                                            <option value="Dolar" <?php echo ($tipo_moneda === 'Dolar') ? 'selected' : ''; ?>>Dólar</option>
                                        </select>
                                        <div class="custom-control custom-checkbox mt-2">
                                            <input type="checkbox" class="custom-control-input" id="checkMonedaSelect" <?php echo !empty($tipo_moneda) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="checkMonedaSelect">Completado</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-footer mt-4 text-center">
                            <a href="./vista_solicitudes_prestamos.php" class="btn btn-danger">Volver</a>
                            <button type="submit" class="btn btn-primary">Actualizar Solicitud</button>
                        </div><br>

                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include "../shared/footer.php";
?>
