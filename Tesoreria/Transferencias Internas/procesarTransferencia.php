<?php
include '../utils/database.php';

$conn = get_mysql_connection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cuentaOrigenId = $_POST['cuentaOrigen']; // ID de la cuenta de origen
    $cuentaDestino = $_POST['cuentaDestino'];
    $divisaTransaccion = $_POST['divisaTransaccion'];
    $monto = $_POST['monto'];
    $descripcion = $_POST['descripcion'];
    $organizacion = $_POST['organizacion'];

    $conn->begin_transaction();

    try {
        // Restar el monto de la cuenta de origen
        $restarSaldo = $conn->prepare("UPDATE cuentasbanco SET saldo = saldo - ? WHERE id = ?");
        $restarSaldo->bind_param("di", $monto, $cuentaOrigenId);
        $restarSaldo->execute();

        // Insertar la transferencia
        $stmt = $conn->prepare("INSERT INTO transferenciasinternas (id_cuenta, cuenta_destino, moneda, monto, fecha_hora, descripcion, estado, id_organizacion) VALUES (?, ?, ?, ?, NOW(), ?, 'Completada', ?)");
        $stmt->bind_param("issdss", $cuentaOrigenId, $cuentaDestino, $divisaTransaccion, $monto, $descripcion, $organizacion);

        if ($stmt->execute()) {
            // Confirmar la transacción
            $conn->commit();
            echo "<script>alert('Transferencia realizada exitosamente'); window.location.href = 'transferencias.php';</script>";
        } else {
            throw new Exception("Error en la ejecución de la inserción");
        }
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conn->rollback();
        echo "<script>alert('Error al realizar la transferencia: " . $e->getMessage() . "'); window.location.href = 'transferencias.php';</script>";
    }

    // Cerrar las declaraciones y la conexión
    if (isset($stmt)) {
        $stmt->close();
    }
    if (isset($restarSaldo)) {
        $restarSaldo->close();
    }
    $conn->close();
}
?>
