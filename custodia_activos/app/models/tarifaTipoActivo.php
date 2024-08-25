<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');

function obtenerTarifaTipoActivos() {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM tarifatipoactivo";
    $result = $conn->query($query);

    $tarifaTipoActivos = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tarifaTipoActivos[] = $row;
        }
    }
    return $tarifaTipoActivos;
}

function obtenerTarifaTipoActivoPorId($id) {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM tarifatipoactivo WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $tarifaTipoActivo = $result->fetch_assoc();
        return $tarifaTipoActivo;
    } else {
        return null;
    }
}

function crearTarifaTipoActivo($id_tipoactivo, $monto, $moneda) {
    $conn = get_mysql_connection();
    $query = "INSERT INTO tarifatipoactivo (id_tipoactivo, monto, moneda) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ids", $id_tipoactivo, $monto, $moneda);
    $result = $stmt->execute();

    if ($result) {
        $id = $conn->insert_id;
        return $id;
    } else {
        return false;
    }
}

function actualizarTarifaTipoActivo($id, $id_tipoactivo, $monto, $moneda) {
    $conn = get_mysql_connection();
    $query = "UPDATE tarifatipoactivo SET id_tipoactivo=?, monto=?, moneda=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("idsi", $id_tipoactivo, $monto, $moneda, $id);
    $result = $stmt->execute();

    return $result;
}

function eliminarTarifaTipoActivo($id) {
    $conn = get_mysql_connection();
    $query = "DELETE FROM tarifatipoactivo WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    return $result;
}
function obtenerTarifasPorTipoActivo($id_tipoactivo) {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM tarifatipoactivo WHERE id_tipoactivo=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_tipoactivo);
    $stmt->execute();
    $result = $stmt->get_result();

    $tarifas = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tarifas[] = $row;
        }
    }
    return $tarifas;
}
?>
