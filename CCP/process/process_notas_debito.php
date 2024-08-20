<?php
require_once '../db_connection.php';
require_once '../classes/NotaDebito.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha_emision = $_POST['fecha_emision'];
    $monto = $_POST['monto'];
    $proveedor_id = $_POST['proveedor_id'];
    $descripcion = $_POST['descripcion'];

    $notaDebito = new NotaDebito($fecha_emision, $monto, $proveedor_id, $descripcion);

    if ($notaDebito->save()) {
        echo json_encode([
            "status" => "success",
            "message" => "Nota de Débito registrada correctamente"
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar la Nota de Débito"]);
    }
}
