<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/valoracionActivo.php');

// Validar que se están recibiendo todos los parámetros requeridos para insertar una valoración de activo
if (isset($_POST['id_activo'], $_POST['id_tipoactivo'], $_POST['valor'], $_POST['fecha'], $_POST['observaciones'], $_POST['id_usuario'])) {
    $id_activo = $_POST['id_activo'];
    $id_tipoactivo = $_POST['id_tipoactivo'];
    $valor = $_POST['valor'];
    $fecha = $_POST['fecha'];
    $observaciones = $_POST['observaciones'];
    $id_usuario = $_POST['id_usuario'];

    $id = crearValoracionActivo($conn, $id_activo, $id_tipoactivo, $valor, $fecha, $observaciones, $id_usuario);
    if ($id) {
        header("Location: /pages/valorActivo.html?success=true");
    } else {
        header("Location: /pages/valorActivo.html?error=true");
    }
} else {
    header("Location: /pages/valorActivo.html?error=true");
}
?>
