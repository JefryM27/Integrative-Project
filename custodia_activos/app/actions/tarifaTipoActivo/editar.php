<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/tarifatipoactivo.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $id_tipoactivo = $_POST['id_tipoactivo'];
    $monto = $_POST['monto'];
    $moneda = $_POST['moneda'];

    // Actualizar tarifa tipo activo en la base de datos
    if (actualizarTarifaTipoActivo($conn, $id, $id_tipoactivo, $monto, $moneda)) {
        // Redirigir a la página de gestión de tarifas tipo activo con mensaje de éxito
        header("Location: /pages/tarifaActivo.html?success=true");
        exit();
    } else {
        echo "Error al actualizar la tarifa tipo activo.";
    }
}

// Obtener ID de la tarifa tipo activo desde la URL
$id = $_GET['id'];

// Obtener datos de la tarifa tipo activo desde la base de datos
$tarifatipoactivo = obtenerTarifaTipoActivoPorId($conn, $id);

if (!$tarifatipoactivo) {
    echo "Tarifa tipo activo no encontrada.";
    exit();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
