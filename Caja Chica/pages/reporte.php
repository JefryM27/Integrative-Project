<?php
require '../shared/header.php';
require '../utils/db.php';
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit;
}

// Consulta para obtener los datos de la tabla RegistroFactura
$query = "SELECT numeroFactura, encargado, departamento, monto, fecha FROM RegistroFactura";
$result = $mysqli->query($query);

?>

<body>
    <header>
        <h1>Reportes de Gastos</h1>
    </header>
    <main>
        <section class="reportes">
            <h2>Reportes de Gastos</h2>
            <table id="reportes-table">
                <thead>
                    <tr>
                        <th>Número de Factura</th>
                        <th>Encargado</th>
                        <th>Departamento</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Generar Reporte</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Iterar sobre los resultados y mostrarlos en la tabla
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['numeroFactura']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['encargado']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['departamento']) . "</td>";
                            echo "<td>" . number_format($row['monto'], 2) . "</td>";
                            echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";
                            echo "<td><a href='../actions/generarReporte.php?id=" . urlencode($row['numeroFactura']) . "'>Generar Reporte</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No se encontraron facturas.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <section>
            <button onclick="location.href='cajaChica.php'">Volver</button>
        </section>
    </main>
</body>

</html>
