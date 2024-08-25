<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/activos.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $activo = obtenerActivoPorId($id);
    
    if ($activo) {
        echo json_encode($activo);
    } else {
        echo json_encode(['error' => 'Activo no encontrado']);
    }
} else {
    echo json_encode(['error' => 'ID no proporcionado']);
}
?>