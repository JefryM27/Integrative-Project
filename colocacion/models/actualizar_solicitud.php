<?php
include '../utils/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $solicitud_id = $_POST['solicitud_id'];
    $numero_de_cuenta = $_POST['numero_de_cuenta'];
    $monto_prestamo = $_POST['monto_prestamo'];
    $plazo_prestamo_deseado = $_POST['plazo_prestamo_deseado'];
    $salario_solicitante = $_POST['salario_solicitante'];
    $tipo_moneda = $_POST['tipo_moneda'];
    
    $conn = getDbConnection();

    try {
        $conn->begin_transaction();

    
        $stmt = $conn->prepare("UPDATE solicitudes SET numero_de_cuenta=?, monto_prestamo=?, plazo_prestamo_deseado=?, salario_solicitante=?, tipo_moneda=?, estado_solicitud='Revisión' WHERE id=?");
        $stmt->bind_param("sidddi", $numero_de_cuenta, $monto_prestamo, $plazo_prestamo_deseado, $salario_solicitante, $tipo_moneda, $solicitud_id);

        if (!$stmt->execute()) {
            throw new Exception("Error al actualizar la solicitud: " . $stmt->error);
        }

        $conn->commit();

        echo "Solicitud actualizada correctamente.";
        header("Location: ../pages/vista_solicitudes_prestamos.php");
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    } finally {
        $conn->close();
    }
} else {
    echo "Solicitud no válida.";
}
?>
