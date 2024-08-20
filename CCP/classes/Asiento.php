<?php
require_once '../db_connection.php';

class Asiento
{
    private $id;
    private $descripcion;
    private $fecha;
    private $monto;
    private $cuenta_debe;
    private $cuenta_haber;
    private $estado;
    private $tipo;

    public function __construct($descripcion, $fecha, $monto, $cuenta_debe, $cuenta_haber, $estado, $tipo, $id = null)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->fecha = $fecha;
        $this->monto = $monto;
        $this->cuenta_debe = $cuenta_debe;
        $this->cuenta_haber = $cuenta_haber;
        $this->estado = $estado;
        $this->tipo = $tipo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function getCuentaDebe()
    {
        return $this->cuenta_debe;
    }

    public function getCuentaHaber()
    {
        return $this->cuenta_haber;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function save()
    {
        $conn = Database::getConnection();
        $sql = "INSERT INTO asientos (descripcion, fecha, monto, cuenta_debe, cuenta_haber, estado, tipo) VALUES (:descripcion, :fecha, :monto, :cuenta_debe, :cuenta_haber, :estado, :tipo)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':monto', $this->monto);
        $stmt->bindParam(':cuenta_debe', $this->cuenta_debe);
        $stmt->bindParam(':cuenta_haber', $this->cuenta_haber);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':tipo', $this->tipo);

        if ($stmt->execute()) {
            $this->id = $conn->lastInsertId();
            return true;
        }
        return false;
    }
}
