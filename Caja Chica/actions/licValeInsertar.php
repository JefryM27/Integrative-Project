<?php
require '../utils/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroVale = $_POST['numero-vale'];
    $montoGastado = $_POST['monto-gastado'];
    $detalleGastos = $_POST['detalle-gastos'];
    $fechaLiquidacion = $_POST['fecha-liquidacion'];

    // Preparar la consulta SQL para insertar los datos
    $query = "INSERT INTO liquidarvale (numeroVale, montoGastado, detalleGastos, fechaLiquidacion, usuario, cajaChica_id)
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);

    // Asignar valores a los parámetros
    $stmt->bind_param('sdsdsi', $numeroVale, $montoGastado, $detalleGastos, $fechaLiquidacion, $user_id, $user_id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Vale liquidado exitosamente.";
    } else {
        echo "Error al liquidar el vale: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
