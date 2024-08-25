<?php
include "../shared/header.php";
?>
<br>
<body>
<link rel="stylesheet" href="../public/css/agregar_producto_prestamo.css">

    <div class="container">
        <h2 class="text-center">Agregar Producto de Préstamo</h2>
        <form id="productoForm">
            <!-- Sección: Información del Producto -->
            <div class="form-group">
                <label for="tipoProducto">Tipo de Producto:</label>
                <input type="text" class="form-control" id="tipoProducto" name="tipoProducto" placeholder="Ingrese el tipo de producto" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingrese una descripción del producto" required></textarea>
            </div>
            
            <!-- Sección: Términos del Préstamo -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="tasaInteres">Tasa de Interés (%):</label>
                    <input type="number" step="0.01" class="form-control" id="tasaInteres" name="tasaInteres" placeholder="Ej: 5.25" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="plazoMinimo">Plazo Mínimo (Meses):</label>
                    <input type="number" class="form-control" id="plazoMinimo" name="plazoMinimo" placeholder="Ej: 12" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="plazoMaximo">Plazo Máximo (Meses):</label>
                    <input type="number" class="form-control" id="plazoMaximo" name="plazoMaximo" placeholder="Ej: 60" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="montoMinimo">Monto Mínimo:</label>
                    <input type="number" step="0.01" class="form-control" id="montoMinimo" name="montoMinimo" placeholder="Ej: 1000.00" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="montoMaximo">Monto Máximo:</label>
                    <input type="number" step="0.01" class="form-control" id="montoMaximo" name="montoMaximo" placeholder="Ej: 50000.00" required>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="d-flex justify-content-between">
                <a href="menu.php" class="btn btn-danger"><i class="bi bi-arrow-left"></i> Cancelar</a>
                <button type="submit" class="btn btn-primary">Agregar Producto</button>
            </div>
        </form>
    </div>
    <br>
</body>
<?php
include "../shared/footer.php";
?>
