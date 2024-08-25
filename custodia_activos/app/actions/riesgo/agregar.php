<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/riesgo.php');

// Validar que se están recibiendo todos los parámetros requeridos para insertar un riesgo
if (isset($_POST['descripcion'], $_POST['nivel'], $_POST['id_activo'], $_POST['tipo_riesgo'])) {
    $descripcion = $_POST['descripcion'];
    $nivel = $_POST['nivel'];
    $id_activo = $_POST['id_activo'];
    $tipo_riesgo = $_POST['tipo_riesgo'];

    $id = crearRiesgo($conn, $descripcion, $nivel, $id_activo, $tipo_riesgo);
    if ($id) {
        header("Location: /pages/gestionRiesgo.html?success=true");
    } else {
        header("Location: /pages/gestionRiesgo.html?error=true");
    }
} else {
    header("Location: /pages/gestionRiesgo.html?error=true");
}
?>
