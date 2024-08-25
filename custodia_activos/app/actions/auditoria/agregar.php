<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/auditoria.php');

// Validar que se están recibiendo todos los parámetros requeridos para insertar una auditoría
if (isset($_POST['fecha'], $_POST['resultado'], $_POST['id_activo'])) {
    $fecha = $_POST['fecha'];
    $resultado = $_POST['resultado'];
    $id_activo = $_POST['id_activo'];

    $id = crearAuditoria($conn, $fecha, $resultado, $id_activo);
    if ($id) {
        header("Location: /pages/auditorias.html?success=true");
    } else {
        header("Location: /pages/auditorias.html?error=true");
    }
} else {
    header("Location: /pages/auditorias.html?error=true");
}
?>
