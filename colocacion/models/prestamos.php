<?php

include_once '../utils/database.php';

function getAllLoans() {
    $conn = getDbConnection();

    $sql = "SELECT id, solicitud_id, monto_aprobado, fecha_aprobacion, interes_aprobado, plazo_aprobado, fecha_desembolso, estado_prestamo FROM prestamos WHERE estado_prestamo = 'Activo'";

    $result = $conn->query($sql);

    if (!$result) {
        die("Error en la consulta SQL: " . $conn->error);
    }

    $prestamos = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $prestamos[] = $row;
        }
    }

    $conn->close();
    return $prestamos;
}
