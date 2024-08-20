<?php
require_once '../db_connection.php';

class CreditoInterno
{
    private $id;
    private $monto;
    private $plazo;
    private $tasa_interes;
    private $fecha_solicitud;
    private $cliente_id;
    private $estado;

    public function __construct($monto, $plazo, $tasa_interes, $fecha_solicitud, $cliente_id, $estado, $id = null)
    {
        $this->monto = $monto;
        $this->plazo = $plazo;
        $this->tasa_interes = $tasa_interes;
        $this->fecha_solicitud = $fecha_solicitud;
        $this->cliente_id = $cliente_id;
        $this->estado = $estado;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function getPlazo()
    {
        return $this->plazo;
    }

    public function getTasaInteres()
    {
        return $this->tasa_interes;
    }

    public function getFechaSolicitud()
    {
        return $this->fecha_solicitud;
    }

    public function getClienteId()
    {
        return $this->cliente_id;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function save()
    {
        $conn = Database::getConnection();
        if ($this->id) {
            $sql = "UPDATE creditos_internos SET monto = :monto, plazo = :plazo, tasa_interes = :tasa_interes, fecha_solicitud = :fecha_solicitud, cliente_id = :cliente_id, estado = :estado WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $this->id);
        } else {
            $sql = "INSERT INTO creditos_internos (monto, plazo, tasa_interes, fecha_solicitud, cliente_id, estado) VALUES (:monto, :plazo, :tasa_interes, :fecha_solicitud, :cliente_id, :estado)";
            $stmt = $conn->prepare($sql);
        }
        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':plazo', $this->plazo);
        $stmt->bindParam(':tasa_interes', $this->tasa_interes);
        $stmt->bindParam(':fecha_solicitud', $this->fecha_solicitud);
        $stmt->bindParam(':cliente_id', $this->cliente_id);
        $stmt->bindParam(':estado', $this->estado);

        if ($stmt->execute()) {
            if (!$this->id) {
                $this->id = $conn->lastInsertId();
            }
            return true;
        }
        return false;
    }

    public function delete()
    {
        $conn = Database::getConnection();
        $sql = "DELETE FROM creditos_internos WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public static function getById($id)
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM creditos_internos WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new CreditoInterno($result['monto'], $result['plazo'], $result['tasa_interes'], $result['fecha_solicitud'], $result['cliente_id'], $result['estado'], $result['id']);
        }
        return null;
    }
}
