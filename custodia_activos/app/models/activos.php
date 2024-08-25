<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');

function obtenerActivos() {
    $conn = get_mysql_connection();
    $query = "SELECT * FROM activo";
    $result = $conn->query($query);

    $activos = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $activos[] = $row;
        }
    }
    return $activos;
}

function obtenerClientes() {
    $conn = get_mysql_connection();
    
    $query = "SELECT cliente_id, nombre, apellido FROM clientes";

    $result = $conn->query($query);
    $clientes = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $clientes[] = $row;
        }
    }
    return $clientes;
}
function obtenerTiposActivos() {
    $conn = get_mysql_connection();
    
    $query = "SELECT id, descripcion, nombre_activo, clasificacion FROM tipoactivo";

    $result = $conn->query($query);
    $tipos = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tipos[] = $row;
        }
    }
    return $tipos;
}

function obtenerLocalizaciones() {
    $conn = get_mysql_connection();
    
    $query = "SELECT id, numero_expediente, sucursal FROM localizacion";

    $result = $conn->query($query);
    $localizaciones = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $localizaciones[] = $row;
        }
    }
    return $localizaciones;
}

function obtenerActivoPorId($id) {
    $conn = get_mysql_connection();
    $stmt = $conn->prepare("SELECT * FROM Activo WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}
function crearActivo($nombre_activo, $id_tipoactivo, $numero_serie, $valor, $id_localizacion, $estado, $id_cliente) {
    $conn = get_mysql_connection();

    $query = "INSERT INTO activo (nombre_activo, id_tipoactivo, numero_serie, valor, id_localizacion, estado, id_cliente) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("sssssss", $nombre_activo, $id_tipoactivo, $numero_serie, $valor, $id_localizacion, $estado, $id_cliente);
    
    if ($stmt->execute()) {
        $stmt->close();
        return $conn->insert_id; // Retorna el ID del nuevo activo
    } else {
        die("Error en la ejecución de la consulta: " . $stmt->error);
    }
}
function actualizarActivo($id_activo, $nombre_activo, $id_tipoactivo, $numero_serie, $valor, $id_localizacion, $fecha_adquisicion, $estado, $id_cliente) {
    $conn = get_mysql_connection();
    $query = "UPDATE activo SET nombre_activo = ?, id_tipoactivo = ?, numero_serie = ?, valor = ?, id_localizacion = ?, fecha_adquisicion = ?, estado = ?, id_cliente = ? WHERE id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        error_log("Error en la preparación de la consulta: " . $conn->error);
        return false;
    }

    $stmt->bind_param("sisddissi", $nombre_activo, $id_tipoactivo, $numero_serie, $valor, $id_localizacion, $fecha_adquisicion, $estado, $id_cliente, $id_activo);

    $result = $stmt->execute();

    if (!$result) {
        error_log("Error en la ejecución de la consulta: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
    return $result;
}

function eliminarActivo($conn, $id) {
    $query = "DELETE FROM activo WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    return $result;
}

function cambiarEstado($conn, $id, $nuevo_estado) {
    $query = "UPDATE activo SET estado=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $nuevo_estado, $id);
    $result = $stmt->execute();

    return $result;
}

// Método para listar activos por estado
function listarActivosPorEstado($conn, $estado) {
    $query = "SELECT * FROM activo WHERE estado=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $estado);
    $stmt->execute();
    $result = $stmt->get_result();

    $activos = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $activos[] = $row;
        }
    }
    return $activos;
}
