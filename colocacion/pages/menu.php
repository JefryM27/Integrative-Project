<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/menu.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">Colocación</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav><br>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a href="./vista_solicitudes_prestamos.php" class="text-decoration-none">
                    <div class="card card-custom">
                        <div class="card-body card-body-custom text-center">
                            <i class="fas fa-file-alt fa-2x mb-2"></i>
                            <h5 class="card-title card-title-custom">Revisión Solicitudes de Préstamos</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="./vista_prestamos.php" class="text-decoration-none">
                    <div class="card card-custom">
                        <div class="card-body card-body-custom text-center">
                            <i class="fas fa-check-circle fa-2x mb-2"></i>
                            <h5 class="card-title card-title-custom">Decisión Préstamo</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="./agregar_producto_prestamo.php" class="text-decoration-none">
                    <div class="card card-custom">
                        <div class="card-body card-body-custom text-center">
                            <i class="fas fa-plus fa-2x mb-2"></i>
                            <h5 class="card-title card-title-custom">Productos Préstamos</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="./prestamos_aprovados.php" class="text-decoration-none">
                    <div class="card card-custom">
                        <div class="card-body card-body-custom text-center">
                            <i class="fas fa-thumbs-up fa-2x mb-2"></i>
                            <h5 class="card-title card-title-custom">Préstamos Aprobados</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (jQuery, Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
