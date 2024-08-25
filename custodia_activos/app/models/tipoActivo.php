<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');

function obtenerTipoActivos() {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM tipoactivo";
    $result = $conn->query($query);

    $tipoActivos = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tipoActivos[] = $row;
        }
    }
    return $tipoActivos;
}

function obtenerTipoActivoPorId($id) {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM tipoactivo WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $tipoActivo = $result->fetch_assoc();
        return $tipoActivo;
    } else {
        return null;
    }
}

function crearTipoActivo($descripcion, $nombre_activo, $clasificacion) {
    $conn = get_mysql_connection();
    $query = "INSERT INTO tipoactivo (descripcion, nombre_activo, clasificacion) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $descripcion, $nombre_activo, $clasificacion);
    $result = $stmt->execute();

    if ($result) {
        $id = $conn->insert_id;
        return $id;
    } else {
        return false;
    }
}

function actualizarTipoActivo($id, $descripcion, $nombre_activo, $clasificacion) {
    $conn = get_mysql_connection();
    $query = "UPDATE tipoactivo SET descripcion=?, nombre_activo=?, clasificacion=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $descripcion, $nombre_activo, $clasificacion, $id);
    $result = $stmt->execute();

    return $result;
}

function eliminarTipoActivo($id) {
    $conn = get_mysql_connection();
    $query = "DELETE FROM tipoactivo WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    return $result;
}
function buscarTipoActivoPorNombre($conn, $nombre_activo) {
    $query = "SELECT * FROM tipoactivo WHERE nombre_activo LIKE ?";
    $stmt = $conn->prepare($query);
    $searchTerm = "%$nombre_activo%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $tipoActivos = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tipoActivos[] = $row;
        }
    }
    return $tipoActivos;
}
?>
