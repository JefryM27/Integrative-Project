<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Cobros</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Gestión de Cobros</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Cobros/cobros.php">Cobros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reportes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Configuración</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4 flex-grow-1">
        <div class="header text-center">
            <h2>Gestión de Cobros</h2>
        </div>
        <div class="text-center mt-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cobroModal">
                Realizar Cobro
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="cobroModal" tabindex="-1" role="dialog" aria-labelledby="cobroModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cobroModalLabel">Procedimientos de Cobro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="cobroForm" action="procesar_cobro.php" method="POST">
                            <div class="form-group">
                                <label for="nombre">Nombre del Socio:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del socio" required>
                            </div>
                            <div class="form-group">
                                <label for="monto">Monto Adeudado:</label>
                                <input type="number" class="form-control" id="monto" name="monto" placeholder="Ingrese el monto adeudado" required>
                            </div>
                            <div class="form-group">
                                <label for="tipoCobro">Tipo de Cobro:</label>
                                <select class="form-control" id="tipoCobro" name="tipoCobro" required>
                                    <option value="administrativo">Cobro Administrativo</option>
                                    <option value="judicial">Cobro Judicial</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="numeroCaso">Número de Caso:</label>
                                <input type="text" class="form-control" id="numeroCaso" name="numeroCaso" placeholder="Ingrese el número de caso" required>
                            </div>
                            <div class="form-group d-none" id="abogadoGroup">
                                <label for="nombreAbogado">Nombre del Abogado:</label>
                                <input type="text" class="form-control" id="nombreAbogado" name="nombreAbogado" placeholder="Ingrese el nombre del abogado">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Realizar Cobro</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center mt-4">
        &copy; 2024 Gestión de Cobros
    </footer>

    <script>
        $(document).ready(function(){
            $('#tipoCobro').on('change', function(){
                if($(this).val() === 'judicial'){
                    $('#abogadoGroup').removeClass('d-none');
                    $('#nombreAbogado').attr('required', true);
                } else {
                    $('#abogadoGroup').addClass('d-none');
                    $('#nombreAbogado').removeAttr('required');
                }
            });
        });
    </script>
</body>
</html>
