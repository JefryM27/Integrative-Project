<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/cajaseguridad.php');

// Validar que se están recibiendo todos los parámetros requeridos para insertar una caja de seguridad
if (isset($_POST['name'], $_POST['location'], $_POST['boxNumber'], $_POST['capacity'], $_POST['availability'])) {
    $nombre_caja = $_POST['name'];
    $id_localizacion = $_POST['location'];
    $numero_caja = $_POST['boxNumber'];
    $capacidad = $_POST['capacity'];
    $disponibilidad = $_POST['availability'];

    $id = crearCajaSeguridad($nombre_caja, $id_localizacion, $numero_caja, $capacidad, $disponibilidad);
    if ($id) {
        header("Location: /pages/cajasSeguridad.php?success=true");
    } else {
        header("Location: /pages/cajasSeguridad.php?error=true");
    }
} else {
    header("Location: /pages/cajasSeguridad.php?error=true");
}
?>