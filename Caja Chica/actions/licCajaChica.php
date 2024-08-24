<?php
require '../utils/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit;
}

function liquidarCajaChica($saldoActual, $totalGastos, $fechaLiquidacion, $user_id, $mysqli)
{
    $queryInsertLiquidacion = "INSERT INTO LiquidarCajaChica (saldoActual, totalGastos, fechaLiquidacion, user_id) VALUES (?, ?, ?, ?)";
    $stmtInsertLiquidacion = $mysqli->prepare($queryInsertLiquidacion);
    $stmtInsertLiquidacion->bind_param('ddsi', $saldoActual, $totalGastos, $fechaLiquidacion, $user_id);

    if ($stmtInsertLiquidacion->execute()) {
        $nuevoSaldo = $saldoActual - $totalGastos;
        $queryActualizarSaldo = "UPDATE CajaChica SET saldoActual = ? WHERE user_id = ? ORDER BY id DESC LIMIT 1";
        $stmtActualizarSaldo = $mysqli->prepare($queryActualizarSaldo);
        $stmtActualizarSaldo->bind_param('di', $nuevoSaldo, $user_id);

        if ($stmtActualizarSaldo->execute()) {
            return true;
        } else {
            return "Error al actualizar el saldo: " . $stmtActualizarSaldo->error;
        }
    } else {
        return "Error al registrar la liquidación: " . $stmtInsertLiquidacion->error;
    }
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $saldoActual = $_POST['saldo-actual'];
    $totalGastos = $_POST['total-gastos'];
    $fechaLiquidacion = $_POST['fecha-liquidacion'];
    $user_id = $_SESSION['user_id'];

    $resultado = liquidarCajaChica($saldoActual, $totalGastos, $fechaLiquidacion, $user_id, $mysqli);

    if ($resultado === true) {
        header("Location: ../pages/cajaChica.php");
        exit;
    } else {
        echo $resultado;
    }
}
