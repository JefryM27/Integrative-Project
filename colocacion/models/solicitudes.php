<?php
include_once '../utils/database.php';

function getAllSolicitudes() {
    $conn = getDbConnection();

    $sql = "SELECT 
                s.id AS solicitud_id,
                c.numero_documento AS cedula,
                CONCAT(c.nombre, ' ', c.apellido) AS nombre,
                p.tipo_producto AS tipo_prestamo,
                s.monto_prestamo AS monto_prestamo,
                s.salario_solicitante AS salario_solicitante
            FROM 
                solicitudes s
            LEFT JOIN 
                clientes c ON s.cliente_id = c.cliente_id
            LEFT JOIN 
                productos_prestamo p ON s.tipo_prestamo_id = p.id";

    $result = $conn->query($sql);

    if (!$result) {
        die("Error en la consulta SQL: " . $conn->error);
    }

    $solicitudes = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $solicitudes[] = $row;
        }
    } else {
        echo "No se encontraron resultados.";
    }

    $conn->close();

    return $solicitudes;
}

function getSolicitudesEnRevision() {
    $conn = getDbConnection();

    $sql = "SELECT 
                s.id AS solicitud_id, 
                c.numero_documento AS cedula, 
                CONCAT(c.nombre, ' ', c.apellido) AS nombre, 
                p.tipo_producto AS tipo_prestamo, 
                s.monto_prestamo, 
                s.salario_solicitante, 
                s.estado_solicitud 
            FROM 
                solicitudes s 
            LEFT JOIN 
                clientes c ON s.cliente_id = c.cliente_id 
            LEFT JOIN 
                productos_prestamo p ON s.tipo_prestamo_id = p.id 
            WHERE 
                s.estado_solicitud = 'Revisión'";

    $result = $conn->query($sql);

    if (!$result) {
        die("Error en la consulta SQL: " . $conn->error);
    }

    $solicitudes = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $solicitudes[] = $row;
        }
    } else {
        echo "No se encontraron solicitudes en revisión.";
    }

    $conn->close();
    return $solicitudes;
}
function aprobarSolicitud($solicitud_id, $monto_aprobado, $interes_aprobado, $plazo_aprobado, $fecha_desembolso) {
    $conn = getDbConnection();

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("UPDATE solicitudes SET estado_solicitud='Aprobado', estado_solicitud_fecha_modificacion=NOW() WHERE id=?");
        $stmt->bind_param("i", $solicitud_id);
        $stmt->execute();
        
        $stmt = $conn->prepare("INSERT INTO prestamos (solicitud_id, monto_aprobado, decision, fecha_aprobacion, interes_aprobado, plazo_aprobado, fecha_desembolso, estado_prestamo, estado_solicitud_fecha_modificacion) 
                                VALUES (?, ?, 'Aprobado', NOW(), ?, ?, ?, 'Activo', NOW())");
        $stmt->bind_param("iddds", $solicitud_id, $monto_aprobado, $interes_aprobado, $plazo_aprobado, $fecha_desembolso);
        $stmt->execute();

        $conn->commit();

        echo "Solicitud aprobada y préstamo registrado correctamente.";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error al aprobar la solicitud: " . $e->getMessage();
    }

    $stmt->close();
    $conn->close();
}
?>