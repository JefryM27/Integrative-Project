<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');

function obtenerAuditorias() {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM auditoria";
    $result = $conn->query($query);

    $auditorias = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $auditorias[] = $row;
        }
    }
    return $auditorias;
}

function obtenerAuditoriaPorId($id) {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM auditoria WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $auditoria = $result->fetch_assoc();
        return $auditoria;
    } else {
        return null;
    }
}

function crearAuditoria($fecha, $resultado, $id_activo) {
    $conn = get_mysql_connection();
    $query = "INSERT INTO auditoria (fecha, resultado, id_activo) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $fecha, $resultado, $id_activo);
    $result = $stmt->execute();

    if ($result) {
        $id = $conn->insert_id;
        return $id;
    } else {
        return false;
    }
}

function actualizarAuditoria($id, $fecha, $resultado, $id_activo) {
    $conn = get_mysql_connection();
    $query = "UPDATE auditoria SET fecha=?, resultado=?, id_activo=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssii", $fecha, $resultado, $id_activo, $id);
    $result = $stmt->execute();

    return $result;
}

function eliminarAuditoria($id) {
    $conn = get_mysql_connection();
    $query = "DELETE FROM auditoria WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    return $result;
}

function listarPorFecha($conn, $fecha) {
    $query = "SELECT * FROM auditoria WHERE fecha=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $fecha);
    $stmt->execute();
    $result = $stmt->get_result();

    $auditorias = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $auditorias[] = $row;
        }
    }
    return $auditorias;
}

function imprimir($conn,$id) {
    $query = "SELECT * FROM auditoria WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}
?>
