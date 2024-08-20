<?php
require_once '../db_connection.php';

class Cobro
{
    private $id;
    private $monto_cobrado;
    private $fecha_cobro;
    private $metodo_cobro;
    private $factura_id;
    private $cliente_id;
    private $moneda;

    public function __construct($monto_cobrado, $fecha_cobro, $metodo_cobro, $factura_id, $cliente_id, $moneda, $id = null)
    {
        $this->id = $id;
        $this->monto_cobrado = $monto_cobrado;
        $this->fecha_cobro = $fecha_cobro;
        $this->metodo_cobro = $metodo_cobro;
        $this->factura_id = $factura_id;
        $this->cliente_id = $cliente_id;
        $this->moneda = $moneda;
    }

    public function getId()
    {
        return $this->id;
    }

    public function save()
    {
        $conn = Database::getConnection();

        if ($this->id) {
            $sql = "UPDATE cobros SET monto_cobrado = :monto_cobrado, fecha_cobro = :fecha_cobro, metodo_cobro = :metodo_cobro, factura_id = :factura_id, cliente_id = :cliente_id, moneda = :moneda WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $this->id);
        } else {
            $sql = "INSERT INTO cobros (monto_cobrado, fecha_cobro, metodo_cobro, factura_id, cliente_id, moneda) VALUES (:monto_cobrado, :fecha_cobro, :metodo_cobro, :factura_id, :cliente_id, :moneda)";
            $stmt = $conn->prepare($sql);
        }

        $stmt->bindParam(':monto_cobrado', $this->monto_cobrado);
        $stmt->bindParam(':fecha_cobro', $this->fecha_cobro);
        $stmt->bindParam(':metodo_cobro', $this->metodo_cobro);
        $stmt->bindParam(':factura_id', $this->factura_id);
        $stmt->bindParam(':cliente_id', $this->cliente_id);
        $stmt->bindParam(':moneda', $this->moneda);

        if ($stmt->execute()) {
            if (!$this->id) {
                $this->id = $conn->lastInsertId();
            }
            return true;
        }
        return false;
    }
}
