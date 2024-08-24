<?php
require '../utils/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

$query = "SELECT fecha, descripcion, monto FROM CajaChica WHERE user_id = ?";

$params = [$user_id];
$types = 'i';

if ($fecha) {
    $query .= " AND fecha = ?";
    $params[] = $fecha;
    $types .= 's';
}

if ($descripcion) {
    $query .= " AND descripcion LIKE ?";
    $params[] = "%$descripcion%";
    $types .= 's';
}

$query .= " LIMIT 18446744073709551615 OFFSET 1";

$stmt = $mysqli->prepare($query);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$gastos = [];
while ($row = $result->fetch_assoc()) {
    $gastos[] = $row;
}

echo json_encode($gastos);
$stmt->close();
