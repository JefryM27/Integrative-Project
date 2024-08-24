
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cooperativa de Ahorro y Crédito</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="style/index.css">
   
</head>

<body>
    <header class="bg-primary text-white py-3">
        <div class="container d-flex justify-content-center align-items-center position-relative">
            <h1 class="m-0 text-center">Modulo de Caja Chica</h1>
            <div class="logo-container position-absolute" style="right: 0">
                <img src="/icons/logo.png" alt="Logo" class="logo" />
            </div>
        </div>
    </header>

    <div class="container my-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-plus fa-2x"></i>
                        <h5 class="card-title mt-2">Agregar Dinero</h5>
                        <a href="pages/agregarDinero.php" class="btn btn-primary btn-block">Ingresar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-boxes fa-2x"></i>
                        <h5 class="card-title mt-2">Gestión de Caja Chica</h5>
                        <a href="pages/cajaChica.php" class="btn btn-primary btn-block">Ingresar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-eye fa-2x"></i>
                        <h5 class="card-title mt-2">Ver Gastos</h5>
                        <a href="pages/gastos.php" class="btn btn-primary btn-block">Ingresar</a>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-file-invoice fa-2x"></i>
                        <h5 class="card-title mt-2">Registrar Factura</h5>
                        <a href="pages/registroFactura.php" class="btn btn-primary btn-block">Ingresar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-bar fa-2x"></i>
                        <h5 class="card-title mt-2">Reportes</h5>
                        <a href="pages/reporte.php" class="btn btn-primary btn-block">Ingresar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-money-check-alt fa-2x"></i>
                        <h5 class="card-title mt-2">Liquidar Vale</h5>
                        <a href="pages/liquidacionVale.php" class="btn btn-primary btn-block">Ingresar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-money-bill-wave fa-2x"></i>
                        <h5 class="card-title mt-2">Liquidación de Caja Chica</h5>
                        <a href="pages/liquidacionCajaChica.php" class="btn btn-primary btn-block">Ingresar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-book fa-2x"></i>
                        <h5 class="card-title mt-2">Asientos Contables</h5>
                        <a href="pages/asientosContables.php" class="btn btn-primary btn-block">Ingresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>