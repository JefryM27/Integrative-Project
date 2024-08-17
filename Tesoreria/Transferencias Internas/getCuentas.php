<?php
include '../utils/db.php';

$moneda = $_GET['moneda'];

$conn = get_mysql_connection();
$query = $conn->prepare("SELECT id, numero_cuenta FROM cuentasbancofk WHERE moneda = ?");
$query->bind_param("s", $moneda);
$query->execute();
$result = $query->get_result();

$cuentas = [];
while ($row = $result->fetch_assoc()) {
    $cuentas[] = $row;
}

$query->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($cuentas);
?>
