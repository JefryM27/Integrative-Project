<?php
require '../utils/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $numeroFactura = $_POST['numero-factura'];
    $encargado = $_POST['encargado'];
    $departamento = $_POST['departamento'];
    $monto = $_POST['monto-factura'];
    $fecha = $_POST['fecha-factura'];
    $user_id = $_SESSION['user_id'];

    // Obtener el ID de CajaChica para el usuario actual
    $queryCajaChicaId = "SELECT id FROM CajaChica WHERE user_id = ?";
    $stmtCajaChicaId = $mysqli->prepare($queryCajaChicaId);
    $stmtCajaChicaId->bind_param('i', $user_id);
    $stmtCajaChicaId->execute();
    $stmtCajaChicaId->bind_result($cajaChica_id);
    $stmtCajaChicaId->fetch();
    $stmtCajaChicaId->close();

    // Verificar si se obtuvo un ID de CajaChica
    if ($cajaChica_id) {
        $queryInsertFactura = "INSERT INTO RegistroFactura (numeroFactura, encargado, departamento, monto, fecha, cajaChica_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtInsertFactura = $mysqli->prepare($queryInsertFactura);
        $stmtInsertFactura->bind_param('sssdis', $numeroFactura, $encargado, $departamento, $monto, $fecha, $cajaChica_id);

        if ($stmtInsertFactura->execute()) {
            header("Location: ../pages/registroFactura.php?success=1");
            exit;
        } else {
            echo "Error al insertar la factura: " . $stmtInsertFactura->error;
        }
    } else {
        echo "Error: No se encontró el ID de CajaChica.";
    }
}
