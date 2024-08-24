<?php
require '../shared/header.php';
require '../utils/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$queryCajaChica = "SELECT saldoActual FROM CajaChica WHERE user_id = ? ORDER BY id DESC LIMIT 1";
$stmtCajaChica = $mysqli->prepare($queryCajaChica);
$stmtCajaChica->bind_param('i', $user_id);
$stmtCajaChica->execute();
$stmtCajaChica->bind_result($saldoActual);
$stmtCajaChica->fetch();
$stmtCajaChica->close();
?>

<body>
    <header>
        <h1>Gestión de Caja Chica</h1>
    </header>

    <main>
        <section class="balance">
            <h2>Saldo Actual</h2>
            <p id="saldo">₡<?php echo number_format($saldoActual, 2); ?></p>
        </section>
        <section class="registro">
            <h2>Registro de Gastos</h2>
            <form id="gasto-form" action="../actions/agregarGasto.php" method="POST">
                <label for="fecha-gasto">Fecha:</label>
                <input type="date" id="fecha-gasto" name="fecha-gasto" required>
                <label for="monto">Monto:</label>
                <input type="number" id="monto" name="monto" required>
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" required>
                <label for="departamento">Departamento:</label>
                <input type="text" id="departamento" name="departamento" required>
                <button type="submit">Agregar Gasto</button>
            </form>
        </section>
    </main>

</body>

</html>