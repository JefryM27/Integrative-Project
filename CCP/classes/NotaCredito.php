<?php
require_once '../db_connection.php';

class NotaCredito
{
    private $id;
    private $fecha_emision;
    private $monto;
    private $proveedor_id;
    private $descripcion;

    public function __construct($fecha_emision, $monto, $proveedor_id, $descripcion, $id = null)
    {
        $this->id = $id;
        $this->fecha_emision = $fecha_emision;
        $this->monto = $monto;
        $this->proveedor_id = $proveedor_id;
        $this->descripcion = $descripcion;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFechaEmision()
    {
        return $this->fecha_emision;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function getProveedorId()
    {
        return $this->proveedor_id;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function save()
    {
        $conn = Database::getConnection();
        $sql = "INSERT INTO notas_credito (fecha_emision, monto, proveedor_id, descripcion) VALUES (:fecha_emision, :monto, :proveedor_id, :descripcion)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':fecha_emision', $this->fecha_emision);
        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':proveedor_id', $this->proveedor_id);
        $stmt->bindParam(':descripcion', $this->descripcion);

        if ($stmt->execute()) {
            $this->id = $conn->lastInsertId();
            return true;
        }
        return false;
    }
}
