<?php
require_once '../db_connection.php';
require_once '../classes/Reporte.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fecha_generacion = $_POST['fecha_generacion'];
    $tipo_reporte = $_POST['tipo_reporte'];
    $cliente_id = $_POST['cliente_id'];

    $reporte = new Reporte($nombre, $descripcion, $fecha_generacion, $tipo_reporte, $cliente_id);

    if ($reporte->save()) {
        echo json_encode([
            "status" => "success",
            "message" => "Reporte generado correctamente"
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al generar el reporte"]);
    }
}
