<?php
include '../utils/database.php'; 

$conn = getDbConnection(); 

try {
    $conn->begin_transaction(); 


    $stmt = $conn->prepare("INSERT INTO solicitudes (numero_de_cuenta, cliente_id, monto_Prestamo, plazo_prestamo_deseado, salario_Solicitante, tipo_moneda, estado_solicitud, fecha_solicitud) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    if (!$stmt) {
        throw new Exception("Error en la preparación de la declaración de solicitud: " . $conn->error);
    }

    $stmt->bind_param("sidddss", $numero_de_cuenta, $cliente_id, $monto_prestamo, $plazo_prestamo_deseado, $salario_solicitante, $tipo_moneda, $estado_solicitud);


    $numero_de_cuenta = $_POST['numero_de_cuenta'];
    $cliente_id = $_POST['id_cliente']; 
    $monto_prestamo = $_POST['monto_prestamo'];
    $plazo_prestamo_deseado = $_POST['plazo_prestamo_deseado'];
    $salario_solicitante = $_POST['salario_solicitante'];
    $tipo_moneda = $_POST['tipo_moneda'];
    $estado_solicitud = 'Pendiente'; 

  
    if ($stmt->execute()) {
        $solicitud_id = $conn->insert_id;

  
        $archivos = [
            'cedulaFile' => 'Cédula',
            'planoFile' => 'Plano',
            'estudioCasaFile' => 'Estudio de la Casa',
            'salarioDesglozadoFile' => 'Salario Desglosado',
            'comprobanteMatricula' => 'Comprobante de Matrícula'
        ];

 
        $archivo_stmt = $conn->prepare("INSERT INTO archivos_adjuntos (solicitud_id, tipo_archivo, nombre_archivo, contenido_archivo) VALUES (?, ?, ?, ?)");
        if (!$archivo_stmt) {
            throw new Exception("Error en la preparación de la declaración de archivos: " . $conn->error);
        }

        foreach ($archivos as $input_name => $tipo_archivo) {
            if (isset($_FILES[$input_name]) && $_FILES[$input_name]['error'] === UPLOAD_ERR_OK) {
                $file_tmp_path = $_FILES[$input_name]['tmp_name'];
                $file_name = basename($_FILES[$input_name]['name']);
                $file_content = file_get_contents($file_tmp_path); 

                $archivo_stmt->bind_param("isss", $solicitud_id, $tipo_archivo, $file_name, $file_content);
                $archivo_stmt->execute();
            }
        }

        $conn->commit();
        echo "Solicitud y archivos adjuntos registrados correctamente.";
        header("Location: ../pages/menu_clientes.php");
    } else {
        throw new Exception("Error al registrar la solicitud.");
    }
} catch (Exception $e) {
    $conn->rollback(); 
    echo "Error: " . $e->getMessage();
} finally {
    $conn->close();
}
