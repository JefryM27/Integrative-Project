<?php
require '../utils/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fechaGasto = $_POST['fecha-gasto'];
    $montoGasto = $_POST['monto'];
    $descripcionGasto = $_POST['descripcion'];
    $departamentoGasto = $_POST['departamento'];
    $user_id = $_SESSION['user_id'];

    $queryCajaChica = "SELECT id, saldoActual FROM CajaChica WHERE user_id = ? ORDER BY id DESC LIMIT 1";
    $stmtCajaChica = $mysqli->prepare($queryCajaChica);
    $stmtCajaChica->bind_param('i', $user_id);
    $stmtCajaChica->execute();
    $stmtCajaChica->bind_result($cajaChica_id, $saldoActual);
    $stmtCajaChica->fetch();
    $stmtCajaChica->close();

    if ($cajaChica_id !== null) {
        // Verificar si el monto a gastar es menor o igual al saldo disponible
        if ($montoGasto <= $saldoActual) {
            // Actualizar el saldo actual en la tabla CajaChica
            $nuevoSaldo = $saldoActual - $montoGasto;
            $queryActualizarSaldo = "UPDATE CajaChica SET saldoActual = ? WHERE id = ?";
            $stmtActualizarSaldo = $mysqli->prepare($queryActualizarSaldo);
            $stmtActualizarSaldo->bind_param('di', $nuevoSaldo, $cajaChica_id);

            if ($stmtActualizarSaldo->execute()) {
                // Insertar el gasto en la tabla CajaChica (añadir un nuevo registro con el gasto)
                $queryInsertGasto = "INSERT INTO CajaChica (fecha, monto, descripcion, departamento, saldoActual, user_id) VALUES (?, ?, ?, ?, ?, ?)";
                $stmtInsertGasto = $mysqli->prepare($queryInsertGasto);
                $stmtInsertGasto->bind_param('sdssdi', $fechaGasto, $montoGasto, $descripcionGasto, $departamentoGasto, $nuevoSaldo, $user_id);

                if ($stmtInsertGasto->execute()) {
                    header("Location: ../pages/cajaChica.php");
                    exit;
                } else {
                    echo "Error al insertar el gasto: " . $stmtInsertGasto->error;
                }
            } else {
                echo "Error al actualizar el saldo: " . $stmtActualizarSaldo->error;
            }
        } else {
            echo "Error: El monto a gastar excede el saldo disponible.";
        }
    } else {
        echo "Error: No se encontró el ID de CajaChica.";
    }
}
?>
