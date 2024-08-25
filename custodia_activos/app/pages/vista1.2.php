<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custodia de Activos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../public/css/style1.2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header bg-primary text-white p-3">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 mx-auto">Bienvenido al Módulo de Custodia de Activos</h1>
            <button id="salir" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
        </div>
    </header>
    <div class="container-fluid d-flex flex-column align-items-center justify-content-center" style="height: calc(100vh - 118px);"> <!-- 118px es la altura total del header y footer -->
        <h2 class="text-center mb-4 smaller-text">Seleccione el proceso que desea realizar</h2>
        <div class="row w-100">
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="../pages/inventarioActivos.php" class="btn btn-outline-primary btn-block custom-btn">
                    <div class="icon-container">
                        <i class="fas fa-boxes fa-2x"></i>
                        <span>Inventario de Activos</span>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="../pages/cajasSeguridad.php" class="btn btn-outline-primary btn-block custom-btn">
                    <div class="icon-container">
                        <i class="fas fa-shield-alt fa-2x"></i>
                        <span>Cajas de Seguridad</span>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="../pages/cobroActivos.php" class="btn btn-outline-primary btn-block custom-btn">
                    <div class="icon-container">
                        <i class="fas fa-money-bill-alt fa-2x"></i>
                        <span>Cobros por Uso de Activos</span>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="../pages/gestionRiesgo.php" class="btn btn-outline-primary btn-block custom-btn">
                    <div class="icon-container">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                        <span>Gestión de Riesgos</span>
                    </div>
                </a>
            </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <a href="#" class="btn btn-outline-primary btn-block custom-btn" data-toggle="modal" data-target="#normasModal">
                        <div class="icon-container">
                            <i class="fas fa-gavel fa-2x"></i>
                            <span>Normas y Regulaciones</span>
                        </div>
                    </a>
                </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="../pages/auditorias.php" class="btn btn-outline-primary btn-block custom-btn">
                    <div class="icon-container">
                        <i class="fas fa-search fa-2x"></i>
                        <span>Auditorías</span>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="../pages/valorActivo.php" class="btn btn-outline-primary btn-block custom-btn">
                    <div class="icon-container">
                        <i class="fas fa-balance-scale fa-2x"></i>
                        <span>Valoración de Activos</span>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="../pages/localizacion.php" class="btn btn-outline-primary btn-block custom-btn">
                    <div class="icon-container">
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                        <span>Localización</span>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="../pages/documentos.php" class="btn btn-outline-primary btn-block custom-btn">
                    <div class="icon-container">
                        <i class="fas fa-file-alt fa-2x"></i>
                        <span>Documentos</span>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="../pages/tarifaActivo.php" class="btn btn-outline-primary btn-block custom-btn">
                    <div class="icon-container">
                        <i class="fas fa-dollar-sign fa-2x"></i>
                        <span>Tarifa Por Activo</span>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="../pages/tipoActivo.php" class="btn btn-outline-primary btn-block custom-btn">
                    <div class="icon-container">
                        <i class="fas fa-tags fa-2x"></i>
                        <span>Tipos de Activos</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <footer class="footer bg-primary text-white text-center py-3">
        <p>&copy; 2024 Todos los derechos reservados.</p>
    </footer>
     <!-- Modal -->
     <div class="modal fade" id="normasModal" tabindex="-1" aria-labelledby="normasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="normasModalLabel">Normas y Regulaciones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Artículo 1º-Objeto y definición.</strong> El presente reglamento regula la actividad de custodia de valores, así como los requisitos de funcionamiento, obligaciones y responsabilidades de las entidades que presten este servicio y de las entidades de depósito.</p>
                    <p>Para los efectos de este Reglamento, se entiende por custodia el servicio que presta una entidad, para el cuidado y conservación de valores y el efectivo relacionado con estos, así como el registro de su titularidad; con la obligación de devolver al titular, valores del mismo emisor, de la misma especie y las mismas características de los que le fueron entregados para su custodia. Esta responsabilidad no resulta afectada por el hecho de que delegue a un tercero, una parte o la totalidad de sus funciones, según los términos dispuestos en los Artículos 6 y 7 de este Reglamento.</p>
                    <p>La custodia puede incluir el servicio de administración de los derechos patrimoniales y políticos relacionados con los valores en custodia.</p>
                    <p>Por otra parte, para efectos de este Reglamento, las entidades de depósito son aquellas responsables de prestar a las entidades de custodia, el servicio de depósito centralizado de valores físicos y de registro de valores representados por medio de macrotítulo, en tanto no se realice un proceso de desmaterialización y contabilización mediante anotación electrónica en cuenta de estos valores.</p>

                    <p><strong>Artículo 2º-Responsabilidades.</strong> Las entidades de custodia deben cumplir con diligencia y eficiencia las funciones y servicios bajo su responsabilidad, en los términos previstos en las disposiciones legales, reglamentarias y contractuales. Además, son responsables por los daños y perjuicios que originen sus funcionarios o empleados, con ocasión de sus funciones, frente a los titulares de los valores o a terceros.</p>
                    <p>El titular es el propietario de los valores y del efectivo asociado a estos valores, depositados en la entidad de custodia y es responsable de la autenticidad de los valores objeto de custodia y de la validez de las transacciones de las que proceden. Por ello, las entidades de custodia de valores no son responsables por los defectos, la legitimidad o la nulidad de los valores o las transacciones de las cuales dichos documentos procedan.</p>

                    <p><strong>Artículo 3º-Entidades autorizadas para prestar servicios de custodia.</strong> Únicamente pueden ser entidades de custodia:</p>
                    <ul>
                        <li>a) Las sociedades anónimas denominadas centrales de custodia de valores, previamente autorizadas por la Superintendencia General de Valores y constituidas con el único fin de prestar los servicios que autoriza el presente Reglamento.</li>
                        <li>b) Las entidades financieras sujetas a la supervisión de la Superintendencia General de Entidades Financieras.</li>
                        <li>c) Los puestos de bolsa.</li>
                    </ul>

                    <p><strong>Artículo 4º-Tipos de entidades de custodia.</strong> Las entidades de custodia se clasifican en tres categorías:</p>
                    <ul>
                        <li>a) Categoría A: Puestos de bolsa que prestan únicamente los servicios básicos de custodia establecidos en el Artículo 5 de este Reglamento a carteras individuales y que cumplen con los requisitos generales de funcionamiento, de conformidad con Artículo 6 de este Reglamento.</li>
                        <li>b) Categoría B: Puestos de bolsa que prestan los servicios básicos de custodia establecidos en el Artículo 5 de este Reglamento, tanto para carteras individuales como fondos de inversión y que cumplen con los requisitos generales de funcionamiento, de conformidad con el Artículo 6 de este Reglamento y las demás condiciones para custodia de carteras colectivas que establece este Reglamento.</li>
                        <li>c) Categoría C: Entidades de custodia que prestan todos los servicios de custodia establecidos en el Artículo 5 de este Reglamento, tanto para carteras individuales como colectivas y cumplen con los requisitos generales de funcionamiento y los requisitos adicionales de funcionamiento para entidades de categoría C, de conformidad con los Artículos 6 y 7, respectivamente y demás condiciones de este Reglamento.</li>
                    </ul>
                    <p>Las entidades de categoría A y B deben cumplir con las exigencias de recursos propios sobre el volumen de los valores que estén bajo su custodia, de conformidad con la normativa respectiva.</p>

                    <p><strong>Artículo 5º-Servicios.</strong> Las entidades de custodia, en cualquiera de las categorías, deben estar en capacidad de prestar, al menos, los siguientes servicios básicos:</p>
                    <ul>
                        <li>a) La recepción de valores en custodia.</li>
                        <li>b) El servicio de liquidación de las operaciones bursátiles que se realicen con los valores objeto de custodia.</li>
                        <li>c) La administración y manejo del registro contable de los valores, tanto físicos como desmaterializados.</li>
                        <li>d) La administración y custodia del efectivo relacionado con los valores objeto de custodia.</li>
                        <li>e) La administración de los valores en custodia, lo cual comprende el cobro de amortizaciones, dividendos, intereses, así como de cualquier otro derecho patrimonial derivado de los valores objeto de custodia. También puede comprender el ejercicio de los derechos políticos derivados de los valores, cuando el cliente lo haya autorizado de forma expresa.</li>
                    </ul>
                    <p>Las entidades de custodia de categoría C pueden prestar, además, los siguientes servicios complementarios:</p>
                    <ul>
                        <li>a) Recopilación y análisis de la información sobre el desempeño de las carteras custodiadas y análisis de decisiones de compra o venta.</li>
                        <li>b) Control de cumplimiento de la política de inversión, para carteras colectivas y carteras individuales de manejo discrecional administradas por los puestos de bolsa.</li>
                        <li>c) Préstamo de valores. Esta posibilidad debe estar claramente indicada en el contrato de custodia, así como toda la información relativa a las ganancias que se percibirán por el préstamo.</li>
                        <li>d) Análisis y medición de riesgos de las carteras custodiadas.</li>
                        <li>e) Valoración de carteras a precios de mercado.</li>
                        <li>f) Administración del libro de participaciones de los fondos de inversión.</li>
                        <li>g) Los demás servicios complementarios que apruebe mediante resolución, el Superintendente General de Valores.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById('salir').addEventListener('click', function() {
        window.location.href = 'index.php';
    });
</script>
</body>
</html>
