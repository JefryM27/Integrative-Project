<?php
require '../shared/header.php';
?>

<body>
    <header>
        <h1>Liquidación de Vale</h1>
    </header>
    <main>
        <section class="liquidacion-vale">
            <h2>Liquidar Vale</h2>
            <form id="liquidacion-form" action="../actions/licValeInsertar.php" method="POST">
                <label for="numero-vale">Número de Vale:</label>
                <input type="text" id="numero-vale" name="numero-vale" required>

                <label for="monto-gastado">Monto Gastado:</label>
                <input type="number" id="monto-gastado" name="monto-gastado" required>

                <label for="detalle-gastos">Detalle de Gastos:</label>
                <textarea id="detalle-gastos" name="detalle-gastos" required></textarea>

                <label for="fecha-liquidacion">Fecha de Liquidación:</label>
                <input type="date" id="fecha-liquidacion" name="fecha-liquidacion" required>

                <button type="submit">Liquidar Vale</button>
            </form>
        </section>
        <section>
            <button onclick="location.href='cajaChica.html'">Volver</button>
        </section>
    </main>
</body>

</html>
