<?php 
include_once '../utils/database.php';

function getSolicitudById($id) {
    $conn = getDbConnection();

    $sql = "SELECT * FROM solicitudes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error en la preparación de la declaración: ' . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}
function getArchivosAdjuntosBySolicitudId($solicitud_id) {
    $conn = getDbConnection();

    $sql = "SELECT tipo_archivo, nombre_archivo, contenido_archivo FROM archivos_adjuntos WHERE solicitud_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error en la preparación de la declaración: ' . $conn->error);
    }

    $stmt->bind_param("i", $solicitud_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $archivos = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $archivos[] = $row;
        }
    }

    $stmt->close();
    $conn->close();

    return $archivos;
}

