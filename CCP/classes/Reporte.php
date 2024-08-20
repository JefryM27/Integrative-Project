<?php
require_once '../db_connection.php';

class Reporte
{
    private $id;
    private $nombre;
    private $descripcion;
    private $fecha_generacion;
    private $tipo_reporte;
    private $cliente_id;

    public function __construct($nombre, $descripcion, $fecha_generacion, $tipo_reporte, $cliente_id, $id = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->fecha_generacion = $fecha_generacion;
        $this->tipo_reporte = $tipo_reporte;
        $this->cliente_id = $cliente_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function save()
    {
        $conn = Database::getConnection();

        if ($this->id) {
            $sql = "UPDATE reportes SET nombre = :nombre, descripcion = :descripcion, fecha_generacion = :fecha_generacion, tipo_reporte = :tipo_reporte, cliente_id = :cliente_id WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $this->id);
        } else {
            $sql = "INSERT INTO reportes (nombre, descripcion, fecha_generacion, tipo_reporte, cliente_id) VALUES (:nombre, :descripcion, :fecha_generacion, :tipo_reporte, :cliente_id)";
            $stmt = $conn->prepare($sql);
        }

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':fecha_generacion', $this->fecha_generacion);
        $stmt->bindParam(':tipo_reporte', $this->tipo_reporte);
        $stmt->bindParam(':cliente_id', $this->cliente_id);

        if ($stmt->execute()) {
            if (!$this->id) {
                $this->id = $conn->lastInsertId();
            }
            return true;
        }
        return false;
    }
}
