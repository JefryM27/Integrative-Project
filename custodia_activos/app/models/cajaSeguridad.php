<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');

function obtenertCajaSeguridades() {
    $conn = get_mysql_connection();
    $sql = "SELECT CajaSeguridad.*, Localizacion.sucursal 
            FROM CajaSeguridad 
            JOIN Localizacion ON CajaSeguridad.id_localizacion = Localizacion.id";
    $result = mysqli_query($conn, $sql);
    
    $cajas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $cajas[] = $row;
    }
    return $cajas;
}

function obtenerCajaSeguridadPorId($id) {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM cajaseguridad WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $cajaSeguridad = $result->fetch_assoc();
        return $cajaSeguridad;
    } else {
        return null;
    }
}

function crearCajaSeguridad($nombre_caja, $id_localizacion, $numero_caja, $capacidad, $disponibilidad) {
    $conn = get_mysql_connection();
    $query = "INSERT INTO cajaseguridad (nombre_caja, id_localizacion, numero_caja, capacidad, disponibilidad) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("siiii", $nombre_caja, $id_localizacion, $numero_caja, $capacidad, $disponibilidad);
    $result = $stmt->execute();

    if ($result) {
        $id = $conn->insert_id;
        return $id;
    } else {
        return false;
    }
}

function actualizarCajaSeguridad($id, $nombre_caja, $id_localizacion, $numero_caja, $capacidad, $disponibilidad) {
    $conn = get_mysql_connection();
    $query = "UPDATE cajaseguridad SET nombre_caja=?, id_localizacion=?, numero_caja=?, capacidad=?, disponibilidad=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("siiiii", $nombre_caja, $id_localizacion, $numero_caja, $capacidad, $disponibilidad, $id);
    $result = $stmt->execute();

    return $result;
}

function eliminarCajaSeguridad($id) {
    $conn = get_mysql_connection();
    $query = "DELETE FROM cajaseguridad WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    return $result;
}

// Cambiar disponibilidad de una caja de seguridad
function cambiarDisponibilidad($conn, $id, $disponibilidad) {
    $query = "UPDATE cajaseguridad SET disponibilidad=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $disponibilidad, $id);
    $result = $stmt->execute();

    return $result;
}

// Listar cajas de seguridad disponibles
function listarCajasDisponibles() {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM cajaseguridad WHERE disponibilidad=1";
    $result = $conn->query($query);

    $cajaDisponibles = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cajaDisponibles[] = $row;
        }
    }
    return $cajaDisponibles;
}
?>
