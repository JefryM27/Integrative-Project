<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/localizacion.php');

// Validar que se están recibiendo todos los parámetros requeridos para insertar una localización
if (isset($_POST['numero_expediente'], $_POST['sucursal'], $_POST['archivo'], $_POST['id_boveda'])) {
    $numero_expediente = $_POST['numero_expediente'];
    $sucursal = $_POST['sucursal'];
    $archivo = $_POST['archivo'];
    $id_boveda = $_POST['id_boveda'];

    $id = crearLocalizacion($conn, $numero_expediente, $sucursal, $archivo, $id_boveda);
    if ($id) {
        header("Location: /pages/localizacion.html?success=true");
    } else {
        header("Location: /pages/localizacion.html?error=true");
    }
} else {
    header("Location: /pages/localizacion.html?error=true");
}
?>
