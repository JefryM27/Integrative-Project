<?php
include_once '../utils/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $solicitud_id = $_POST['solicitud_id'];
    $decision = $_POST['decision'];
    $monto_aprobado = $_POST['monto_aprobado'] ?? null;
    $interes_aprobado = $_POST['interes_aprobado'] ?? null;
    $plazo_aprobado = $_POST['plazo_aprobado'] ?? null;
    $fecha_desembolso = $_POST['fecha_desembolso'] ?? null;
    $evaluacion_riesgo_prestamo = $_POST['evaluacion_riesgo_prestamo'] ?? null;
    $calificacion_cliente = $_POST['calificacion_cliente'] ?? null;

    $conn = getDbConnection();

    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare("UPDATE solicitudes SET estado_solicitud=?, estado_solicitud_fecha_modificacion=NOW() WHERE id=?");
        $stmt->bind_param("si", $decision, $solicitud_id);
        $stmt->execute();

        if ($decision === 'Aprobado') {
            $stmt = $conn->prepare("INSERT INTO prestamos (solicitud_id, monto_aprobado, decision, fecha_aprobacion, interes_aprobado, plazo_aprobado, fecha_desembolso, evaluacion_riesgo_prestamo, calificacion_cliente, estado_prestamo, estado_solicitud_fecha_modificacion) 
                        VALUES (?, ?, 'Aprobado', NOW(), ?, ?, ?, ?, ?, 'Activo', NOW())");
            $stmt->bind_param("idddssi", $solicitud_id, $monto_aprobado, $interes_aprobado, $plazo_aprobado, $fecha_desembolso, $evaluacion_riesgo_prestamo, $calificacion_cliente);

            $stmt->execute();
        }

        $conn->commit();

        header("Location: ../pages/vista_prestamos.php");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error al procesar la decisión: " . $e->getMessage();
    } finally {
        $stmt->close();
        $conn->close();
    }
}
