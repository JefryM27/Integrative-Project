<?php
require_once '../db_connection.php';

class Interes
{
    private $id;
    private $credito_id;
    private $monto_interes;
    private $fecha_cobro;
    private $estado;

    public function __construct($credito_id, $monto_interes, $fecha_cobro, $estado, $id = null)
    {
        $this->id = $id;
        $this->credito_id = $credito_id;
        $this->monto_interes = $monto_interes;
        $this->fecha_cobro = $fecha_cobro;
        $this->estado = $estado;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreditoId()
    {
        return $this->credito_id;
    }

    public function getMontoInteres()
    {
        return $this->monto_interes;
    }

    public function getFechaCobro()
    {
        return $this->fecha_cobro;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function save()
    {
        $conn = Database::getConnection();
        if ($this->id) {
            $sql = "UPDATE gestion_intereses SET credito_id = :credito_id, monto_interes = :monto_interes, fecha_cobro = :fecha_cobro, estado = :estado WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $this->id);
        } else {
            $sql = "INSERT INTO gestion_intereses (credito_id, monto_interes, fecha_cobro, estado) VALUES (:credito_id, :monto_interes, :fecha_cobro, :estado)";
            $stmt = $conn->prepare($sql);
        }
        $stmt->bindParam(':credito_id', $this->credito_id);
        $stmt->bindParam(':monto_interes', $this->monto_interes);
        $stmt->bindParam(':fecha_cobro', $this->fecha_cobro);
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
        $sql = "DELETE FROM gestion_intereses WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public static function getById($id)
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM gestion_intereses WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return [
                'id' => $result['id'],
                'credito_id' => $result['credito_id'],
                'monto_interes' => $result['monto_interes'],
                'fecha_cobro' => $result['fecha_cobro'],
                'estado' => $result['estado']
            ];
        }
        return null;
    }
}
