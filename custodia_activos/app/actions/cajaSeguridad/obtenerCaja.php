<?php

header('Content-Type: application/json');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/utils/database.php');

$sql = "SELECT id, nombre, localizacion, numeroCaja, capacidad, disponibilidad FROM cajas";
$result = $conn->query($sql);

$cajas = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cajas[] = $row;
    }
}

echo json_encode($cajas);

$conn->close();
?>