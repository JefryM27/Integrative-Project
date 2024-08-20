<?php
require_once '../db_connection.php';
require_once '../classes/FacturaPorPagar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $numero_factura = $_POST['numero_factura'];
    $fecha_factura = $_POST['fecha_factura'];
    $monto = $_POST['monto'];
    $estado = $_POST['estado'];
    $proveedor_id = $_POST['proveedor_id'];
    $moneda = $_POST['moneda'];
    $descripcion = $_POST['descripcion'];

    $factura = new FacturaPorPagar($numero_factura, $fecha_factura, $monto, $estado, $proveedor_id, $moneda, $descripcion, $id);

    if ($factura->save()) {
        echo json_encode([
            "status" => "success",
            "message" => "Factura registrada correctamente",
            "data" => [
                "id" => $factura->getId(),
                "numero_factura" => $numero_factura,
                "monto" => $monto,
                "estado" => $estado
            ]
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar la factura"]);
    }
}
