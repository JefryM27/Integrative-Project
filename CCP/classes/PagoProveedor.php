<?php
require_once '../db_connection.php';

class PagoProveedor
{
    private $id;
    private $proveedor_id;
    private $monto;
    private $fecha_pago;
    private $metodo_pago;
    private $moneda;
    private $concepto;

    public function __construct($proveedor_id, $monto, $fecha_pago, $metodo_pago, $moneda, $concepto, $id = null)
    {
        $this->proveedor_id = $proveedor_id;
        $this->monto = $monto;
        $this->fecha_pago = $fecha_pago;
        $this->metodo_pago = $metodo_pago;
        $this->moneda = $moneda;
        $this->concepto = $concepto;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getProveedorId()
    {
        return $this->proveedor_id;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function getFechaPago()
    {
        return $this->fecha_pago;
    }

    public function getMetodoPago()
    {
        return $this->metodo_pago;
    }

    public function getMoneda()
    {
        return $this->moneda;
    }

    public function getConcepto()
    {
        return $this->concepto;
    }

    public function save()
    {
        $conn = Database::getConnection();
        if ($this->id) {
            $sql = "UPDATE pagos_proveedores SET proveedor_id = :proveedor_id, monto = :monto, fecha_pago = :fecha_pago, metodo_pago = :metodo_pago, moneda = :moneda, concepto = :concepto WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $this->id);
        } else {
            $sql = "INSERT INTO pagos_proveedores (proveedor_id, monto, fecha_pago, metodo_pago, moneda, concepto) VALUES (:proveedor_id, :monto, :fecha_pago, :metodo_pago, :moneda, :concepto)";
            $stmt = $conn->prepare($sql);
        }
        $stmt->bindParam(':proveedor_id', $this->proveedor_id);
        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':fecha_pago', $this->fecha_pago);
        $stmt->bindParam(':metodo_pago', $this->metodo_pago);
        $stmt->bindParam(':moneda', $this->moneda);
        $stmt->bindParam(':concepto', $this->concepto);

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
        $sql = "DELETE FROM pagos_proveedores WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public static function getById($id)
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM pagos_proveedores WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new PagoProveedor($result['proveedor_id'], $result['monto'], $result['fecha_pago'], $result['metodo_pago'], $result['moneda'], $result['concepto'], $result['id']);
        }
        return null;
    }
}
