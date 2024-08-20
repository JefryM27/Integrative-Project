<?php
require_once '../db_connection.php';
require_once '../classes/Proveedor.php';
require_once '../classes/Interes.php';
require_once '../classes/CreditoInterno.php';
require_once '../classes/PagoProveedor.php';
require_once '../classes/FacturaPorPagar.php';
require_once '../classes/FacturaPorCobrar.php'; // Agregar esta línea

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['entity']) && isset($_GET['id'])) {
    $entity = $_GET['entity'];
    $id = $_GET['id'];

    switch ($entity) {
        case 'proveedor':
            $data = Proveedor::getById($id);
            break;
        case 'interes':
            $data = Interes::getById($id);
            break;
        case 'credito_interno':
            $data = CreditoInterno::getById($id);
            break;
        case 'pago_proveedor':
            $data = PagoProveedor::getById($id);
            break;
        case 'factura_por_pagar':
            $data = FacturaPorPagar::getById($id);
            break;
        case 'factura_por_cobrar': // Agregar este caso
            $data = FacturaPorCobrar::getById($id);
            break;
        default:
            echo json_encode(["status" => "error", "message" => "Entidad no válida"]);
            exit;
    }

    if ($data) {
        $factura = new FacturaPorCobrar( // Modificar si es necesario para manejar otras entidades también
            $data['numero_factura'],
            $data['fecha_factura'],
            $data['monto'],
            $data['estado'],
            $data['cliente_id'],
            $data['moneda'],
            $data['descripcion'],
            $id
        );

        if ($factura->delete()) {
            echo json_encode(["status" => "success", "message" => ucfirst($entity) . " eliminado correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al eliminar el " . $entity]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => ucfirst($entity) . " no encontrado"]);
    }
}
