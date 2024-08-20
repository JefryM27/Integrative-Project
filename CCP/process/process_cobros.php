<?php
require_once '../db_connection.php';
require_once '../classes/Cobro.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $monto_cobrado = $_POST['monto_cobrado'];
    $fecha_cobro = $_POST['fecha_cobro'];
    $metodo_cobro = $_POST['metodo_cobro'];
    $factura_id = $_POST['factura_id'];
    $cliente_id = $_POST['cliente_id'];
    $moneda = $_POST['moneda'];

    $cobro = new Cobro($monto_cobrado, $fecha_cobro, $metodo_cobro, $factura_id, $cliente_id, $moneda);

    if ($cobro->save()) {
        echo json_encode([
            "status" => "success",
            "message" => "Cobro registrado correctamente"
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar el cobro"]);
    }
}
