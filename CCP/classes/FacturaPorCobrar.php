<?php
require_once '../db_connection.php';

class FacturaPorCobrar
{
    private $id;
    private $numero_factura;
    private $fecha_factura;
    private $monto;
    private $estado;
    private $cliente_id;
    private $moneda;
    private $descripcion;

    public function __construct($numero_factura, $fecha_factura, $monto, $estado, $cliente_id, $moneda, $descripcion, $id = null)
    {
        $this->id = $id;
        $this->numero_factura = $numero_factura;
        $this->fecha_factura = $fecha_factura;
        $this->monto = $monto;
        $this->estado = $estado;
        $this->cliente_id = $cliente_id;
        $this->moneda = $moneda;
        $this->descripcion = $descripcion;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNumeroFactura()
    {
        return $this->numero_factura;
    }

    public function getFechaFactura()
    {
        return $this->fecha_factura;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getClienteId()
    {
        return $this->cliente_id;
    }

    public function getMoneda()
    {
        return $this->moneda;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function save()
    {
        $conn = Database::getConnection();
        if ($this->id) {
            $sql = "UPDATE facturas_por_cobrar SET numero_factura = :numero_factura, fecha_factura = :fecha_factura, monto = :monto, estado = :estado, cliente_id = :cliente_id, moneda = :moneda, descripcion = :descripcion WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $this->id);
        } else {
            $sql = "INSERT INTO facturas_por_cobrar (numero_factura, fecha_factura, monto, estado, cliente_id, moneda, descripcion) VALUES (:numero_factura, :fecha_factura, :monto, :estado, :cliente_id, :moneda, :descripcion)";
            $stmt = $conn->prepare($sql);
        }

        $stmt->bindParam(':numero_factura', $this->numero_factura);
        $stmt->bindParam(':fecha_factura', $this->fecha_factura);
        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':cliente_id', $this->cliente_id);
        $stmt->bindParam(':moneda', $this->moneda);
        $stmt->bindParam(':descripcion', $this->descripcion);

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
        $sql = "DELETE FROM facturas_por_cobrar WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public static function getById($id)
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM facturas_por_cobrar WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return [
                'id' => $result['id'],
                'numero_factura' => $result['numero_factura'],
                'fecha_factura' => $result['fecha_factura'],
                'monto' => $result['monto'],
                'estado' => $result['estado'],
                'cliente_id' => $result['cliente_id'],
                'moneda' => $result['moneda'],
                'descripcion' => $result['descripcion']
            ];
        }
        return null;
    }
}
