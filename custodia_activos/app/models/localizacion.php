<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
function obtenerLocalizaciones() {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM localizacion";
    $result = $conn->query($query);

    $localizaciones = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $localizaciones[] = $row;
        }
    }
    return $localizaciones;
}
function obtenerLocalizacionPorId($id) {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM localizacion WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $localizacion = $result->fetch_assoc();
        return $localizacion;
    } else {
        return null;
    }
}

function crearLocalizacion($numero_expediente, $sucursal, $archivo, $id_boveda) {
    $conn = get_mysql_connection();
    $query = "INSERT INTO localizacion (numero_expediente, sucursal, archivo, id_boveda) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $numero_expediente, $sucursal, $archivo, $id_boveda);
    $result = $stmt->execute();

    if ($result) {
        $id = $conn->insert_id;
        return $id;
    } else {
        return false;
    }
}

function actualizarLocalizacion($id, $numero_expediente, $sucursal, $archivo, $id_boveda) {
    $conn = get_mysql_connection();
    $query = "UPDATE localizacion SET numero_expediente=?, sucursal=?, archivo=?, id_boveda=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssii", $numero_expediente, $sucursal, $archivo, $id_boveda, $id);
    $result = $stmt->execute();

    return $result;
}

function eliminarLocalizacion($id) {
    $conn = get_mysql_connection();
    $query = "DELETE FROM localizacion WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    return $result;
}
function buscarPorNumeroExpediente($numero_expediente) {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM localizacion WHERE numero_expediente=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $numero_expediente);
    $stmt->execute();
    $result = $stmt->get_result();

    $localizaciones = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $localizaciones[] = $row;
        }
    }
    return $localizaciones;
}
?>
