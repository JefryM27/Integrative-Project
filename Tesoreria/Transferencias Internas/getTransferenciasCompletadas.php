<?php
include '../utils/db.php';

$conn = get_mysql_connection();

// Consulta para obtener el número de transferencias completadas por día de la semana
$query = "
    SELECT 
        DAYNAME(fecha_hora) as dia, 
        COUNT(*) as total
    FROM 
        transferenciasinternas
    WHERE 
        estado = 'Completada'
    GROUP BY 
        dia
    ORDER BY 
        FIELD(dia, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')
";

$result = $conn->query($query);

$transferencias = [];
while ($row = $result->fetch_assoc()) {
    $transferencias[] = $row;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($transferencias);
?>
