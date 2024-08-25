<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');

function obtenerCobroActivos() {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM cobroactivo";
    $result = $conn->query($query);

    $cobroActivos = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cobroActivos[] = $row;
        }
    }
    return $cobroActivos;
}

function obtenerCobroActivoPorId($id) {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM cobroactivo WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $cobroActivo = $result->fetch_assoc();
        return $cobroActivo;
    } else {
        return null;
    }
}

function crearCobroActivo($id_tarifa, $fecha, $id_activo, $id_cliente) {
    $conn = get_mysql_connection();
    $query = "INSERT INTO cobroactivo (id_tarifa, fecha, id_activo, id_cliente) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issi", $id_tarifa, $fecha, $id_activo, $id_cliente);
    $result = $stmt->execute();

    if ($result) {
        $id = $conn->insert_id;
        return $id;
    } else {
        return false;
    }
}

function actualizarCobroActivo($id, $id_tarifa, $fecha, $id_activo, $id_cliente) {
    $conn = get_mysql_connection();
    $query = "UPDATE cobroactivo SET id_tarifa=?, fecha=?, id_activo=?, id_cliente=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isiii", $id_tarifa, $fecha, $id_activo, $id_cliente, $id);
    $result = $stmt->execute();

    return $result;
}

function eliminarCobroActivo($id) {
    $conn = get_mysql_connection();
    $query = "DELETE FROM cobroactivo WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    return $result;
}

// Listar cobros de activos por fecha
function listarCobroPorFecha($fecha) {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM cobroactivo WHERE fecha=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $fecha);
    $stmt->execute();
    $result = $stmt->get_result();

    $cobrosPorFecha = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cobrosPorFecha[] = $row;
        }
    }
    return $cobrosPorFecha;
}
?>
