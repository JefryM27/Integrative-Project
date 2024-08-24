<?php
require '../shared/header.php';
require '../utils/db.php';
?>

<body>
    <header>
        <h1>Asientos Contables</h1>
    </header>

    <main>
        <?php
        $sql = "SELECT * FROM AsientosContables ORDER BY fecha DESC";
        $result = $mysqli->query($sql);

        if ($result) {
            $asientos = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();

            // Agrupando los asientos por fecha
            $asientosAgrupados = [];
            foreach ($asientos as $asiento) {
                $fecha = $asiento['fecha'];
                if (!isset($asientosAgrupados[$fecha])) {
                    $asientosAgrupados[$fecha] = [];
                }
                $asientosAgrupados[$fecha][] = $asiento;
            }

            // Mostrando las tablas por fecha
            foreach ($asientosAgrupados as $fecha => $asientos) {
                echo '<section>';
                echo '<h2>Asientos del ' . htmlspecialchars($fecha) . '</h2>';
                echo '<table>';
                echo '<tr>';
                echo '<th>Fecha</th>';
                echo '<th>Cuenta</th>';
                echo '<th>Denominación</th>';
                echo '<th>Debe</th>';
                echo '<th>Haber</th>';
                echo '</tr>';

                foreach ($asientos as $asiento) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($asiento['fecha']) . '</td>';
                    echo '<td>' . htmlspecialchars($asiento['cuenta']) . '</td>';
                    echo '<td>' . htmlspecialchars($asiento['denominacion']) . '</td>';
                    echo '<td>' . htmlspecialchars($asiento['debe']) . '</td>';
                    echo '<td>' . htmlspecialchars($asiento['haber']) . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
                echo '</section>';
            }
        } else {
            echo "Error en la consulta: " . $mysqli->error;
        }
        ?>

        <div class="button-container">
            <button id="createBtn">Crear</button>

    </main>

    <!-- Modal de creación de asiento -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Crear Asiento</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <form action="../actions/crearAsiento.php" method="post">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" required>

                    <label for="cuenta">Cuenta</label>
                    <input type="text" id="cuenta" name="cuenta" placeholder="Ingrese la cuenta" required>

                    <label for="denominacion">Denominación</label>
                    <input type="text" id="denominacion" name="denominacion" placeholder="Ingrese la denominación" required>

                    <label for="debe">Debe</label>
                    <input type="text" id="debe" name="debe" placeholder="Ingrese el debe" required>

                    <label for="haber">Haber</label>
                    <input type="text" id="haber" name="haber" placeholder="Ingrese el haber" required>

                    <div class="modal-footer">
                        <button type="submit">Crear</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="../js/asientos.js"></script>
</body>

</html>