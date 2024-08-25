<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');

function obtenerRiesgos() {
    $conn = get_mysql_connection();

    $query = "SELECT * FROM riesgo";
    $result = $conn->query($query);

    $riesgos = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $riesgos[] = $row;
        }
    }
    return $riesgos;
}

function obtenerRiesgoPorId($id) {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM riesgo WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $riesgo = $result->fetch_assoc();
        return $riesgo;
    } else {
        return null;
    }
}

function crearRiesgo($descripcion, $nivel, $id_activo, $tipo_riesgo) {
    $conn = get_mysql_connection();

    $query = "INSERT INTO riesgo (descripcion, nivel, id_activo, tipo_riesgo) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssis", $descripcion, $nivel, $id_activo, $tipo_riesgo);
    $result = $stmt->execute();

    if ($result) {
        $id = $conn->insert_id;
        return $id;
    } else {
        return false;
    }
}

function actualizarRiesgo($id, $descripcion, $nivel, $id_activo, $tipo_riesgo) {
    $conn = get_mysql_connection();

    $query = "UPDATE riesgo SET descripcion=?, nivel=?, id_activo=?, tipo_riesgo=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssisi", $descripcion, $nivel, $id_activo, $tipo_riesgo, $id);
    $result = $stmt->execute();

    return $result;
}

function eliminarRiesgo($id) {
    $conn = get_mysql_connection();
    $query = "DELETE FROM riesgo WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    return $result;
}

function listarRiesgoPorNivel($nivel) {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM riesgo WHERE nivel=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nivel);
    $stmt->execute();
    $result = $stmt->get_result();

    $riesgos = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $riesgos[] = $row;
        }
    }
    return $riesgos;
}
?>
