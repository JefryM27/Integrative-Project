<?php
require_once '../db_connection.php';

class Pago
{
    private $id;
    private $monto_pagado;
    private $fecha_pago;
    private $metodo_pago;
    private $factura_id;
    private $proveedor_id;
    private $moneda;

    public function __construct($monto_pagado, $fecha_pago, $metodo_pago, $factura_id, $proveedor_id, $moneda, $id = null)
    {
        $this->id = $id;
        $this->monto_pagado = $monto_pagado;
        $this->fecha_pago = $fecha_pago;
        $this->metodo_pago = $metodo_pago;
        $this->factura_id = $factura_id;
        $this->proveedor_id = $proveedor_id;
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
            $sql = "UPDATE pagos SET monto_pagado = :monto_pagado, fecha_pago = :fecha_pago, metodo_pago = :metodo_pago, factura_id = :factura_id, proveedor_id = :proveedor_id, moneda = :moneda WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $this->id);
        } else {
            $sql = "INSERT INTO pagos (monto_pagado, fecha_pago, metodo_pago, factura_id, proveedor_id, moneda) VALUES (:monto_pagado, :fecha_pago, :metodo_pago, :factura_id, :proveedor_id, :moneda)";
            $stmt = $conn->prepare($sql);
        }

        $stmt->bindParam(':monto_pagado', $this->monto_pagado);
        $stmt->bindParam(':fecha_pago', $this->fecha_pago);
        $stmt->bindParam(':metodo_pago', $this->metodo_pago);
        $stmt->bindParam(':factura_id', $this->factura_id);
        $stmt->bindParam(':proveedor_id', $this->proveedor_id);
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
