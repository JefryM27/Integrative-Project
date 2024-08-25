<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');

function obtenerDocumentos() {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM documento";
    $result = $conn->query($query);

    $documentos = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $documentos[] = $row;
        }
    }
    return $documentos;
}

function obtenerDocumentoPorId($id) {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM documento WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $documento = $result->fetch_assoc();
        return $documento;
    } else {
        return null;
    }
}

function crearDocumento($descripcion, $fecha, $id_tipoactivo, $id_localizacion) {
    $conn = get_mysql_connection();
    $query = "INSERT INTO documento (descripcion, fecha, id_tipoactivo, id_localizacion) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssii", $descripcion, $fecha, $id_tipoactivo, $id_localizacion);
    $result = $stmt->execute();

    if ($result) {
        $id = $conn->insert_id;
        return $id;
    } else {
        return false;
    }
}

function actualizarDocumento($id, $descripcion, $fecha, $id_tipoactivo, $id_localizacion) {
    $conn = get_mysql_connection();
    $query = "UPDATE documento SET descripcion=?, fecha=?, id_tipoactivo=?, id_localizacion=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssiii", $descripcion, $fecha, $id_tipoactivo, $id_localizacion, $id);
    $result = $stmt->execute();

    return $result;
}

function eliminarDocumento($id) {
    $conn = get_mysql_connection();
    $query = "DELETE FROM documento WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    return $result;
}

function listarDocumentosPorFecha($fecha) {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM documento WHERE fecha=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $fecha);
    $stmt->execute();
    $result = $stmt->get_result();

    $documentosPorFecha = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $documentosPorFecha[] = $row;
        }
    }
    return $documentosPorFecha;
}
?>