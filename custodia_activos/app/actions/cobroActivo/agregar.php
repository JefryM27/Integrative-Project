<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/cobroactivo.php');

// Validar que se están recibiendo todos los parámetros requeridos para insertar un cobro de activo
if (isset($_POST['id_tarifa'], $_POST['fecha'], $_POST['id_activo'], $_POST['id_cliente'])) {
    $id_tarifa = $_POST['id_tarifa'];
    $fecha = $_POST['fecha'];
    $id_activo = $_POST['id_activo'];
    $id_cliente = $_POST['id_cliente'];

    $id = crearCobroActivo($conn, $id_tarifa, $fecha, $id_activo,$id_cliente);
    if ($id) {
        header("Location: /pages/cobroActivos.html?success=true");
    } else {
        header("Location: /pages/cobroActivos.html?error=true");
    }
} else {
    header("Location: /pages/cobroActivos.html?error=true");
}
?>
