<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooperativa de Ahorro y Crédito</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="/css/styles.css" />

    <style>
        header,
        footer {
            background-color: #3b5998 !important;
        }

        .bg-primary {
            background-color: #3b5998 !important;
        }

        .btn-primary {
            background-color: #3b5998 !important;
        }

        .card-body i,
        .card-body h5 {
            color: #000 !important;
        }

        .card-body {
            padding: 0.5rem;
        }

        .card-title {
            font-size: 1rem;
        }

        .modal-content {
            font-size: 0.9rem;
        }

        .form-control,
        .btn {
            font-size: 0.9rem;
        }

        .modal-header h5 {
            font-size: 1.5rem;
            color: #3b5998;
            text-align: center;
            width: 100%;
        }

        .close {
            font-size: 1.2rem;
        }

        .list-group-item {
            padding: 0.5rem;
        }

        .btn-sm {
            font-size: 0.8rem;
        }

        h2,
        h5 {
            font-size: 1.2rem;
        }

        .modal-footer .btn-primary {
            float: left;
            margin-right: auto;
        }

        .modal-footer .btn-close-red {
            float: right;
        }
    </style>
</head>

<body>
    <header class="bg-primary text-white py-3">
        <div class="container d-flex justify-content-center align-items-center position-relative">
            <h1 class="m-0 text-center">Cooperativa de Ahorro y Crédito</h1>
            <div class="logo-container position-absolute" style="right: 0">
                <img src="/icons/logo.png" alt="Logo de la Cooperativa" class="logo" />
            </div>
        </div>
    </header>
    <div class="d-flex">
        <aside id="sidebar" class="bg-primary text-white p-3">
            <ul class="list-unstyled">
                <li>
                    <a href="#modalCreditosInternos" class="text-white d-flex align-items-center" data-toggle="modal"><img src="/icons/prestamos.png" alt="Préstamos" class="mr-2" />
                        Registro de préstamos</a>
                </li>
                <li>
                    <a href="#modalRegistroProveedores" class="text-white d-flex align-items-center" data-toggle="modal"><img src="/icons/proveedores.png" alt="Proveedores" class="mr-2" />
                        Registro de Proveedores</a>
                </li>
                <li>
                    <a href="#modalPagosProveedores" class="text-white d-flex align-items-center" data-toggle="modal"><img src="/icons/pagos.png" alt="Pagos" class="mr-2" /> Pagos a
                        Proveedores</a>
                </li>
                <li>
                    <a href="#modalGestionIntereses" class="text-white d-flex align-items-center" data-toggle="modal"><img src="/icons/intereses.png" alt="Intereses" class="mr-2" />
                        Gestión de Intereses</a>
                </li>
                <li>
                    <a href="#modalRegistroFacturasPorPagar" class="text-white d-flex align-items-center" data-toggle="modal">
                        <img src="/icons/facturas_por_pagar.png" alt="Facturas Por Pagar" class="mr-2" />
                        Registro de Facturas Por Pagar
                    </a>
                </li>
                <li>
                    <a href="#modalRegistroFacturasPorCobrar" class="text-white d-flex align-items-center" data-toggle="modal">
                        <img src="/icons/facturas_por_cobrar.png" alt="Facturas Por Cobrar" class="mr-2" />
                        Registro de Facturas Por Cobrar
                    </a>
                </li>
                <li>
                    <a href="#modalRegistroPagos" class="text-white d-flex align-items-center" data-toggle="modal"><img src="/icons/pagos.png" alt="Pagos" class="mr-2" /> Registro
                        de Pagos</a>
                </li>
                <li>
                    <a href="#modalRegistroCobros" class="text-white d-flex align-items-center" data-toggle="modal"><img src="/icons/pagos.png" alt="Cobros" class="mr-2" /> Registro
                        de Cobros</a>
                </li>
                <li>
                    <a href="#modalReportes" class="text-white d-flex align-items-center" data-toggle="modal"><img src="/icons/reportes.png" alt="Reportes" class="mr-2" />
                        Reportes</a>
                </li>
                <li>
                    <a href="#modalRegistroNotasCredito" class="text-white d-flex align-items-center" data-toggle="modal"><img src="/icons/credit.png" alt="Notas de Crédito" class="mr-2" />
                        Registro de Notas de Crédito</a>
                </li>
                <li>
                    <a href="#modalRegistroNotasDebito" class="text-white d-flex align-items-center" data-toggle="modal"><img src="/icons/debit.png" alt="Notas de Débito" class="mr-2" />
                        Registro de Notas de Débito</a>
                </li>
                <li>
                    <a href="#modalCreacionAsientos" class="text-white d-flex align-items-center" data-toggle="modal"><img src="/icons/book.png" alt="Asientos" class="mr-2" />
                        Creación de Asientos</a>
                </li>
            </ul>
        </aside>
        <main class="flex-fill p-3">
            <section id="inicio">
                <h2>Sección de Cuentas por Cobrar | Pagar</h2>
                <p>
                    Ofrecemos soluciones financieras para nuestros socios con
                    transparencia y confianza.
                </p>
            </section>
            <section id="modulos">
                <h2>Módulos</h2>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-hand-holding-usd fa-2x"></i>
                                <h5 class="card-title mt-2">Créditos Internos</h5>
                                <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#modalCreditosInternos">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-user-check fa-2x"></i>
                                <h5 class="card-title mt-2">Registro de Proveedores</h5>
                                <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#modalRegistroProveedores">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-file-invoice-dollar fa-2x"></i>
                                <h5 class="card-title mt-2">Pagos a Proveedores</h5>
                                <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#modalPagosProveedores">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-percentage fa-2x"></i>
                                <h5 class="card-title mt-2">Gestión de Intereses</h5>
                                <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#modalGestionIntereses">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-receipt fa-2x"></i>
                                <h5 class="card-title mt-2">Registro de Facturas Por Pagar</h5>
                                <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#modalRegistroFacturasPorPagar">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-receipt fa-2x"></i>
                                <h5 class="card-title mt-2">Registro de Facturas Por Cobrar</h5>
                                <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#modalRegistroFacturasPorCobrar">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-money-check-alt fa-2x"></i>
                                <h5 class="card-title mt-2">Registro de Pagos</h5>
                                <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#modalRegistroPagos">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-money-check-alt fa-2x"></i>
                                <h5 class="card-title mt-2">Registro de Cobros</h5>
                                <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#modalRegistroCobros">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-chart-line fa-2x"></i>
                                <h5 class="card-title mt-2">Reportes</h5>
                                <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#modalReportes">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-file-invoice fa-2x"></i>
                                <h5 class="card-title mt-2">Registro de Notas de Crédito</h5>
                                <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#modalRegistroNotasCredito">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-file-invoice fa-2x"></i>
                                <h5 class="card-title mt-2">Registro de Notas de Débito</h5>
                                <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#modalRegistroNotasDebito">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-book fa-2x"></i>
                                <h5 class="card-title mt-2">Creación de Asientos</h5>
                                <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#modalCreacionAsientos">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <footer class="bg-primary text-white text-center py-3">
        © 2024 Cooperativa de Ahorro y Crédito
    </footer>

    <!-- Incluye los archivos de los modales -->
    <?php include 'modals/modal_registro_facturas_por_pagar.php'; ?>
    <?php include 'modals/modal_registro_facturas_por_cobrar.php'; ?>
    <?php include 'modals/modal_registro_pagos.php'; ?>
    <?php include 'modals/modal_registro_cobros.php'; ?>
    <?php include 'modals/modal_registro_proveedores.php'; ?>
    <?php include 'modals/modal_gestion_intereses.php'; ?>
    <?php include 'modals/modal_creacion_asientos.php'; ?>
    <?php include 'modals/modal_registro_notas_credito.php'; ?>
    <?php include 'modals/modal_registro_notas_debito.php'; ?>
    <?php include 'modals/modal_registro_reportes.php'; ?>
    <?php include 'modals/modal_registro_creditos.php'; ?>
    <?php include 'modals/modal_registro_pagos_proveedores.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/js/script.js"></script>
</body>

</html>