<?php
require '../utils/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha-ingreso'];
    $monto = $_POST['monto-ingreso'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO AgregarDinero (fecha, monto, usuario, cajaChica_id) 
              VALUES (?, ?, ?, (SELECT id FROM CajaChica WHERE user_id = ?))";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('sdsi', $fecha, $monto, $_SESSION['usuario'], $user_id);

    if ($stmt->execute()) {
        // Actualizar el saldo actual en la tabla CajaChica
        $updateSaldo = "UPDATE CajaChica SET saldoActual = saldoActual + ? WHERE user_id = ?";
        $stmtUpdate = $mysqli->prepare($updateSaldo);
        $stmtUpdate->bind_param('di', $monto, $user_id);
        $stmtUpdate->execute();

        header("Location: ../pages/cajaChica.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
