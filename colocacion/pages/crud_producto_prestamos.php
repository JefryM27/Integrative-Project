<?php

include "../shared/header.php";
?>

<body>
    <link rel="stylesheet" href="../public/css/header.css">
    <div class="container">

        
        <h2 class="text-center">Productos de Préstamo</h2>
        
        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" class="form-control" id="searchInput" placeholder="Buscar productos de préstamo...">
        </div>

        <!-- Tabla de Productos de Préstamo -->
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Tipo de Producto</th>
                    <th>Descripción</th>
                    <th>Tasa de Interés</th>
                    <th>Plazo Mínimo (Meses)</th>
                    <th>Plazo Máximo (Meses)</th>
                    <th>Monto Máximo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="productTable">
                <!-- Aquí se deben cargar dinámicamente los productos de préstamo -->
                <tr>
                    <td>1</td>
                    <td>Préstamo Personal</td>
                    <td>Préstamo para gastos personales</td>
                    <td>5.00%</td>
                    <td>12</td>
                    <td>60</td>
                    <td>5000.00</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="edit_producto_prestamo11.html">Editar</a>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Préstamo Hipotecario</td>
                    <td>Préstamo para compra de vivienda</td>
                    <td>3.50%</td>
                    <td>60</td>
                    <td>360</td>
                    <td>100000.00</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="edit_producto_prestamo11.html">Editar</a>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
                <!-- Fin de la carga dinámica -->
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies (jQuery, Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script para el filtro de búsqueda -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var searchText = this.value.toLowerCase();
            var rows = document.getElementById('productTable').getElementsByTagName('tr');
            
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                var match = false;
                
                for (var j = 0; j < cells.length; j++) {
                    if (cells[j].innerText.toLowerCase().indexOf(searchText) > -1) {
                        match = true;
                        break;
                    }
                }
                
                if (match) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        });
    </script>
</body>
<?php

include "../shared/footer.php";
?>