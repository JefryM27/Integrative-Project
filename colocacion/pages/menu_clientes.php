<?php
include "../shared/header.php";
?>
<link rel="stylesheet" href="../public/css/menu_clientes.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Contenido principal -->
<div class="container">
    <div class="row justify-content-center loan-section">
        <div class="col-lg-5 col-md-6 col-sm-12 mb-4">
            <div class="card loan-box">
                <div class="card-body">
                    <h3 class="card-title"><a href="./form_slicitud_prestamo.php">Préstamo de Vivienda</a></h3>
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viviendaModal">
                        <i class="fas fa-home"></i> Ver requisitos
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12 mb-4">
            <div class="card loan-box">
                <div class="card-body">
                    <h3 class="card-title"><a href="./form_slicitud_prestamo.php">Préstamo Personal</a></h3>
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#personalModal">
                        <i class="fas fa-user"></i> Ver requisitos
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12 mb-4">
            <div class="card loan-box">
                <div class="card-body">
                    <h3 class="card-title"><a href="./form_slicitud_prestamo.php">Préstamo de Negocios</a></h3>
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#negociosModal">
                        <i class="fas fa-briefcase"></i> Ver requisitos
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12 mb-4">
            <div class="card loan-box">
                <div class="card-body">
                    <h3 class="card-title"><a href="./form_slicitud_prestamo.php">Préstamo de Educación</a></h3>
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#educacionModal">
                        <i class="fas fa-graduation-cap"></i> Ver requisitos
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12 mb-4">
            <div class="card loan-box">
                <div class="card-body">
                    <h3 class="card-title"><a href="./form_slicitud_prestamo.php">Tarjetas</a></h3>
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#tarjetasModal">
                        <i class="fas fa-credit-card"></i> Ver requisitos
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modales para los requisitos -->
<div class="modal fade" id="viviendaModal" tabindex="-1" role="dialog" aria-labelledby="viviendaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viviendaModalLabel">Requisitos para Préstamo de Vivienda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Requisitos Generales:</h5>
                <ul>
                    <li>Edad mínima: 18 años.</li>
                    <li>Residencia legal en el país.</li>
                    <li>Capacidad legal para contraer préstamos.</li>
                </ul>
                <h5>Documentación de Propiedad:</h5>
                <ul>
                    <li>Título de propiedad o contrato de compraventa.</li>
                    <li>Documentación de la propiedad a ser hipotecada.</li>
                    <li>Evaluación de la propiedad por un tasador autorizado.</li>
                </ul>
                <h5>Historial Crediticio:</h5>
                <ul>
                    <li>Buen historial de crédito con puntaje mínimo de 700.</li>
                    <li>Verificación de deudas anteriores.</li>
                </ul>
                <h5>Capacidad de Pago:</h5>
                <ul>
                    <li>Demostrar ingresos estables y suficientes.</li>
                    <li>Relación ingresos-deudas adecuada.</li>
                </ul>
                <h5>Enganche:</h5>
                <ul>
                    <li>Generalmente entre el 10% y el 20% del precio de compra.</li>
                    <li>Ahorros o fuente de financiamiento para el enganche.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="personalModal" tabindex="-1" role="dialog" aria-labelledby="personalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="personalModalLabel">Requisitos para Préstamo Personal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Requisitos Generales:</h5>
                <ul>
                    <li>Edad mínima: 18 años.</li>
                    <li>Asociación activa y en buen estado con la cooperativa.</li>
                    <li>Capacidad legal para contraer préstamos.</li>
                </ul>
                <h5>Documentación requerida:</h5>
                <ul>
                    <li>Cédula de identidad o documento de identificación válido.</li>
                    <li>Comprobante de domicilio.</li>
                </ul>
                <h5>Capacidad de Pago:</h5>
                <ul>
                    <li>Presentar constancia de ingresos estables.</li>
                    <li>Relación ingresos-deudas adecuada.</li>
                </ul>
                <h5>Garantías:</h5>
                <ul>
                    <li>Garantías personales o avales, dependiendo del monto del préstamo.</li>
                    <li>Posiblemente se requiera un seguro de vida o de desempleo.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="negociosModal" tabindex="-1" role="dialog" aria-labelledby="negociosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="negociosModalLabel">Requisitos para Préstamo de Negocios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Requisitos Generales:</h5>
                <ul>
                    <li>Edad mínima: 18 años.</li>
                    <li>Registro legal del negocio.</li>
                    <li>Plan de negocio detallado.</li>
                    <li>Capacidad legal para contraer préstamos.</li>
                </ul>
                <h5>Documentación requerida:</h5>
                <ul>
                    <li>Documentación de registro del negocio.</li>
                    <li>Estados financieros de los últimos 2 años.</li>
                </ul>
                <h5>Historial Crediticio:</h5>
                <ul>
                    <li>Buen historial de crédito del negocio y de los socios.</li>
                </ul>
                <h5>Capacidad de Pago:</h5>
                <ul>
                    <li>Demostrar ingresos estables y previsiones financieras.</li>
                    <li>Relación ingresos-deudas adecuada.</li>
                </ul>
                <h5>Garantías:</h5>
                <ul>
                    <li>Garantías personales o bienes del negocio.</li>
                    <li>Posiblemente se requiera un seguro de crédito.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="educacionModal" tabindex="-1" role="dialog" aria-labelledby="educacionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="educacionModalLabel">Requisitos para Préstamo de Educación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Requisitos Generales:</h5>
                <ul>
                    <li>Edad mínima: 18 años.</li>
                    <li>Inscripción en una institución educativa reconocida.</li>
                    <li>Capacidad legal para contraer préstamos.</li>
                </ul>
                <h5>Documentación requerida:</h5>
                <ul>
                    <li>Comprobante de inscripción o aceptación en la institución.</li>
                    <li>Documentación de identificación.</li>
                </ul>
                <h5>Capacidad de Pago:</h5>
                <ul>
                    <li>Demostrar ingresos estables y previsiones financieras.</li>
                    <li>Relación ingresos-deudas adecuada.</li>
                </ul>
                <h5>Garantías:</h5>
                <ul>
                    <li>Posiblemente se requiera un aval o garantía.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tarjetasModal" tabindex="-1" role="dialog" aria-labelledby="tarjetasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tarjetasModalLabel">Requisitos para Tarjetas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Requisitos Generales:</h5>
                <ul>
                    <li>Edad mínima: 18 años.</li>
                    <li>Residencia legal en el país.</li>
                    <li>Capacidad legal para solicitar tarjetas de crédito.</li>
                </ul>
                <h5>Documentación requerida:</h5>
                <ul>
                    <li>Cédula de identidad o documento de identificación válido.</li>
                    <li>Comprobante de domicilio.</li>
                    <li>Comprobante de ingresos.</li>
                </ul>
                <h5>Historial Crediticio:</h5>
                <ul>
                    <li>Buen historial de crédito con puntaje mínimo de 650.</li>
                    <li>Verificación de deudas anteriores.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php
include "../shared/footer.php";
?>
