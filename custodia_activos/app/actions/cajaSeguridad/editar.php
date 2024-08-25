<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/cajaseguridad.php');

// Verificar que el ID esté presente en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $cajaseguridad = obtenerCajaSeguridadPorId($id);

    if (!$cajaseguridad) {
        echo "Caja de seguridad no encontrada.";
        exit();
    }
} else {
    echo "ID de caja de seguridad no proporcionado.";
    exit();
}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre_caja = $_POST['name'];
    $id_localizacion = $_POST['location'];
    $numero_caja = $_POST['boxNumber'];
    $capacidad = $_POST['capacity'];
    $disponibilidad = $_POST['availability'];

    // Actualizar caja de seguridad en la base de datos
    if (actualizarCajaSeguridad($id, $nombre_caja, $id_localizacion, $numero_caja, $capacidad, $disponibilidad)) {
        header("Location: /pages/cajasSeguridad.php?success=true");
        exit();
    } else {
        echo "Error al actualizar la caja de seguridad.";
    }
}
?>