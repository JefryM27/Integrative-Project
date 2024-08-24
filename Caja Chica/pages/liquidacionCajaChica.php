<?php
require '../shared/header.php';
?>

<body>

    <header>
        <h1>Liquidación de Caja Chica</h1>
    </header>
    <main>
        <section class="liquidacion-caja-chica">
            <h2>Liquidar Caja Chica</h2>
            <form id="liquidacion-form" action="../actions/licCajaChica.php" method="POST">
                <label for="saldo-actual">Saldo Actual:</label>
                <input type="number" id="saldo-actual" name="saldo-actual" required>

                <label for="total-gastos">Total de Gastos:</label>
                <input type="number" id="total-gastos" name="total-gastos" required>

                <label for="fecha-liquidacion">Fecha de Liquidación:</label>
                <input type="date" id="fecha-liquidacion" name="fecha-liquidacion" required>

                <button type="submit">Liquidar Caja Chica</button>
            </form>

        </section>
        <section>
            <button onclick="location.href='cajaChica.php'">Volver</button>
        </section>
    </main>
</body>

</html>