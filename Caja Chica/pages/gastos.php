<?php
require '../shared/header.php';
?>

<body>
    <header>
        <h1>Lista de Gastos</h1>
    </header>
    <main>
        <h4>Buscar por:</h4>
        <form id="gasto-form">
            <label for="fecha-ingreso">Fecha:</label>
            <input type="date" id="fecha-ingreso" name="fecha-ingreso">
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion">
            <button type="submit">Buscar</button>
        </form>
        <section class="gastos-lista">
            <h2>Gastos Registrados</h2>
            <table id="tabla-gastos">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </section>
    </main>

</body>
</html>
