<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');

function obtenerValoracionActivos() {
    $conn = get_mysql_connection();
    $sql = "SELECT v.id, v.valor, v.observaciones, v.fecha, 
                   a.nombre_activo, 
                   t.descripcion AS descripcion_tipo, 
                   u.nombre_usuario AS nombre_perito
            FROM valoracionactivo v
            JOIN activo a ON v.id_activo = a.id
            JOIN tipoactivo t ON v.id_tipoactivo = t.id
            JOIN usuarios u ON v.id_usuario = u.usuario_id";
    
    $result = $conn->query($sql);
    $conn->close();

    return $result->fetch_all(MYSQLI_ASSOC);
}
function obtenerUsuarios() {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM usuarios";
    $result = $conn->query($query);

    $usuario = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $usuario[] = $row;
        }
    }
    return $usuario;
}

function obtenerValoracionActivoById($id) {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM valoracionactivo WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $valoracionActivo = $result->fetch_assoc();
        return $valoracionActivo;
    } else {
        return null;
    }
}

function crearValoracionActivo($id_activo, $id_tipoactivo, $valor, $fecha, $observaciones, $id_usuario) {
    $conn = get_mysql_connection();
    $query = "INSERT INTO valoracionactivo (id_activo, id_tipoactivo, valor, fecha, observaciones, id_usuario) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iidssi", $id_activo, $id_tipoactivo, $valor, $fecha, $observaciones, $id_usuario);
    $result = $stmt->execute();

    if ($result) {
        $id = $conn->insert_id;
        return $id;
    } else {
        return false;
    }
}

function actualizarValoracionActivo($id, $id_activo, $id_tipoactivo, $valor, $fecha, $observaciones, $id_usuario) {
    $conn = get_mysql_connection();
    $query = "UPDATE valoracionactivo SET id_activo=?, id_tipoactivo=?, valor=?, fecha=?, observaciones=?, id_usuario=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iidssii", $id_activo, $id_tipoactivo, $valor, $fecha, $observaciones, $id_usuario, $id);
    $result = $stmt->execute();

    return $result;
}

function eliminarValoracionActivo($id) {
    $conn = get_mysql_connection();
    $query = "DELETE FROM valoracionactivo WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    return $result;
}
function listarValoracionesPorActivo($id_activo) {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM valoracionactivo WHERE id_activo=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_activo);
    $stmt->execute();
    $result = $stmt->get_result();

    $valoracionActivos = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $valoracionActivos[] = $row;
        }
    }
    return $valoracionActivos;
}
?>
