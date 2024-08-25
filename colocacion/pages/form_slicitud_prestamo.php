<?php
include "../shared/header.php";
?>
<body>
<link rel="stylesheet" href="../public/css/form_solicitud_prestamo.css">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center color1 text-white">
                <h2 class="h222">COODESCA</h2>
                <h2 class="h222">Solicitud de Préstamo</h2>
            </div>
            <div class="card-body">
                <form id="loanForm" action="../models/insertar_solicitud.php" method="POST" enctype="multipart/form-data">
                    <div id="accordion">
                        
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="bi bi-person-circle"></i> 1. INFORMACIÓN PERSONAL
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="numeroCuenta">Número de Cuenta</label>
                                        <input type="text" class="form-control" id="numeroCuenta" name="numero_de_cuenta" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="idCliente">ID Cliente</label>
                                        <select class="form-control" id="idCliente" name="id_cliente" required>
                                            <?php for ($i = 1; $i <= 20; $i++) { ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 2: Información Financiera -->
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="bi bi-wallet2"></i> 2. INFORMACIÓN FINANCIERA
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="loanAmount">Monto del Préstamo</label>
                                        <input type="text" class="form-control" id="loanAmount" name="monto_prestamo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="loanTerm">Plazo del Préstamo Deseado</label>
                                        <input type="text" class="form-control" id="loanTerm" name="plazo_prestamo_deseado" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="salary">Salario del Solicitante</label>
                                        <input type="text" class="form-control" id="salary" name="salario_solicitante" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 3: Adjuntar Archivos -->
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="bi bi-file-earmark-arrow-up"></i> 3. ADJUNTAR ARCHIVOS
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="cedulaFile">Adjuntar Cédula</label>
                                        <input type="file" class="form-control-file" id="cedulaFile" name="cedulaFile" accept=".pdf,.jpg,.png" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="planoFile">Adjuntar Plano</label>
                                        <input type="file" class="form-control-file" id="planoFile" name="planoFile" accept=".pdf,.jpg,.png">
                                    </div>
                                    <div class="form-group">
                                        <label for="estudioCasaFile">Adjuntar Estudio de la Casa</label>
                                        <input type="file" class="form-control-file" id="estudioCasaFile" name="estudioCasaFile" accept=".pdf,.jpg,.png">
                                    </div>
                                    <div class="form-group">
                                        <label for="salarioDesglozadoFile">Adjuntar Salario Desglosado</label>
                                        <input type="file" class="form-control-file" id="salarioDesglozadoFile" name="salarioDesglozadoFile" accept=".pdf,.jpg,.png">
                                    </div>
                                    <div class="form-group">
                                        <label for="comprobanteMatricula">Adjuntar Comprobante de Matrícula de Estudio</label>
                                        <input type="file" class="form-control-file" id="comprobanteMatricula" name="comprobanteMatricula" accept=".pdf,.jpg,.png">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 4: Escoger Moneda -->
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        <i class="bi bi-currency-dollar"></i> 4. ESCOGER MONEDA
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="monedaSelect2">Seleccionar Moneda</label>
                                        <select class="form-control" id="monedaSelect2" name="tipo_moneda" required>
                                            <option value="Colon">Colón</option>
                                            <option value="Dolar">Dólar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-footer mt-4 text-center">
                            <a href="menu_clientes.php" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Enviar</button>
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
