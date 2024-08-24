<?php
require '../shared/header.php';
?>

<body>

    <header>
        <h1>Agregar Dinero</h1>
    </header>
    <main>
        <section class="agregar-dinero">
            <h2>Agregar Dinero</h2>
            <form id="dinero-form" action="../actions/agregardineroAction.php" method="POST">
                <label for="fecha-ingreso">Fecha:</label>
                <input type="date" id="fecha-ingreso" name="fecha-ingreso" required>

                <label for="monto-ingreso">Monto:</label>
                <input type="number" id="monto-ingreso" name="monto-ingreso" required>

                <button type="submit">Agregar Dinero</button>
            </form>

        </section>
    </main>
    <script src="agregarDinero.js"></script>
</body>

</html>