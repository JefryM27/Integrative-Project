<?php
require '../utils/db.php';
require '../fpdf186/fpdf.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit;
}

if (isset($_GET['id'])) {
    $numeroFactura = $_GET['id'];

    // Consulta para obtener los datos de la factura
    $query = "SELECT numeroFactura, encargado, departamento, monto, fecha FROM RegistroFactura WHERE numeroFactura = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $numeroFactura);
    $stmt->execute();
    $stmt->bind_result($numeroFactura, $encargado, $departamento, $monto, $fecha);
    $stmt->fetch();
    $stmt->close();

    // Generar el PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Título
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Reporte de Factura', 0, 1, 'C');
    $pdf->Ln(10);

    // Datos de la factura
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Numero de Factura: ' . $numeroFactura, 0, 1);
    $pdf->Cell(0, 10, 'Encargado: ' . $encargado, 0, 1);
    $pdf->Cell(0, 10, 'Departamento: ' . $departamento, 0, 1);
    $pdf->Cell(0, 10, 'Monto: Colones ' . number_format($monto, 2), 0, 1);
    $pdf->Cell(0, 10, 'Fecha: ' . $fecha, 0, 1);

    // Salida del PDF
    $pdf->Output('D', 'Reporte de Factura' . $numeroFactura . '.pdf');
} else {
    echo "No se ha proporcionado un número de factura.";
}
?>
