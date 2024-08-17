<?php
include '../utils/database.php';

$conn = get_mysql_connection();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $stmt = $conn->prepare("SELECT * FROM boveda WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $boveda = $result->fetch_assoc();
        echo json_encode($boveda);
    } else {
        echo json_encode(['error' => 'Bóveda no encontrada']);
    }

    $stmt->close();
}

$conn->close();
?>