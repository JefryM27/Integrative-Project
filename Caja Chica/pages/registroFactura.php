<?php
require '../shared/header.php';
?>

<body>
    <header>
        <h1>Registro de Factura</h1>
    </header>
    <main>
        <section class="registro-factura">
            <h2>Registrar Nueva Factura</h2>
            <form method="post" action="../actions/insertarFactura.php">
                <label for="fecha-factura">Fecha:</label>
                <input type="date" id="fecha-factura" name="fecha-factura" required>

                <label for="numero-factura">Número de Factura:</label>
                <input type="text" id="numero-factura" name="numero-factura" required>

                <label for="encargado">Encargado:</label>
                <input type="text" id="encargado" name="encargado" required>

                <label for="departamento">Departamento:</label>
                <input type="text" id="departamento" name="departamento" required>

                <label for="monto-factura">Monto:</label>
                <input type="number" step="0.01" id="monto-factura" name="monto-factura" required>

                <button type="submit">Registrar Factura</button>

            </form>
        </section>
        <section>
            <button onclick="location.href='cajaChica.php'">Volver</button>
        </section>
    </main>
</body>

</html>