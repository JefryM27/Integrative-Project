<?php
require_once '../db_connection.php';
require_once '../classes/PagoProveedor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $proveedor_id = $_POST['proveedor_id'];
    $monto = $_POST['monto'];
    $fecha_pago = $_POST['fecha_pago'];
    $metodo_pago = $_POST['metodo_pago'];
    $moneda = $_POST['moneda'];
    $concepto = $_POST['concepto'];
    $id = $_POST['id'] ?? null;

    $pagoProveedor = new PagoProveedor($proveedor_id, $monto, $fecha_pago, $metodo_pago, $moneda, $concepto, $id);

    if ($pagoProveedor->save()) {
        echo json_encode([
            "status" => "success",
            "message" => "Pago registrado correctamente",
            "data" => [
                "id" => $pagoProveedor->getId(),
                "proveedor_id" => $proveedor_id,
                "monto" => $monto,
                "fecha_pago" => $fecha_pago,
                "metodo_pago" => $metodo_pago,
                "moneda" => $moneda,
                "concepto" => $concepto
            ]
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar el pago"]);
    }
}
