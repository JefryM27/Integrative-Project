<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/tarifaTipoActivo.php');

// Validar que se están recibiendo todos los parámetros requeridos para insertar una tarifa tipo activo
if (isset($_POST['id_tipoactivo'], $_POST['monto'], $_POST['moneda'])) {
    $id_tipoactivo = $_POST['id_tipoactivo'];
    $monto = $_POST['monto'];
    $moneda = $_POST['moneda'];

    $id = crearTarifaTipoActivo($conn, $id_tipoactivo, $monto, $moneda);
    if ($id) {
        header("Location: /pages/tarifaActivo.html?success=true");
    } else {
        header("Location: /pages/tarifaActivo.html?error=true");
    }
} else {
    header("Location: /pages/tarifaActivo.html?error=true");
}
?>
