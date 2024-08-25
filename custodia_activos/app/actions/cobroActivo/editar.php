<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/cobroactivo.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $id_tarifa = $_POST['id_tarifa'];
    $fecha = $_POST['fecha'];
    $id_activo = $_POST['id_activo'];
    $id_cliente = $_POST['id_cliente'];

    // Actualizar cobro de activo en la base de datos
    if (actualizarCobroActivo($conn, $id, $id_tarifa, $fecha, $id_activo,$id_cliente)) {
        // Redirigir a la página de gestión de cobros de activo con mensaje de éxito
        header("Location: /pages/cobroActivos.html?success=true");
        exit();
    } else {
        echo "Error al actualizar el cobro de activo.";
    }
}

// Obtener ID del cobro de activo desde la URL
$id = $_GET['id'];

// Obtener datos del cobro de activo desde la base de datos
$cobroactivo = obtenerCobroActivoPorId($conn, $id);

if (!$cobroactivo) {
    echo "Cobro de activo no encontrado.";
    exit();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
