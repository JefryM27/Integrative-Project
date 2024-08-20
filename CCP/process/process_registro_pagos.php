<?php
require_once '../db_connection.php';
require_once '../classes/Pago.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $monto_pagado = $_POST['monto_pagado'];
    $fecha_pago = $_POST['fecha_pago'];
    $metodo_pago = $_POST['metodo_pago'];
    $factura_id = $_POST['factura_id'];
    $proveedor_id = $_POST['proveedor_id'];
    $moneda = $_POST['moneda'];

    $pago = new Pago($monto_pagado, $fecha_pago, $metodo_pago, $factura_id, $proveedor_id, $moneda);

    if ($pago->save()) {
        echo json_encode([
            "status" => "success",
            "message" => "Pago registrado correctamente"
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar el pago"]);
    }
}
