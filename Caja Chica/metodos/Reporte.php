<?php
class Reporte
{
    private $idReporte;
    private $numeroFactura;
    private $usuario;
    private $departamento;
    private $monto;
    private $fecha;
    private $idRegistroFactura;

    // Getters
    public function getIdReporte()
    {
        return $this->idReporte;
    }

    public function getNumeroFactura()
    {
        return $this->numeroFactura;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getIdRegistroFactura()
    {
        return $this->idRegistroFactura;
    }

    // Setters
    public function setIdReporte($idReporte)
    {
        $this->idReporte = $idReporte;
    }

    public function setNumeroFactura($numeroFactura)
    {
        $this->numeroFactura = $numeroFactura;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    }

    public function setMonto($monto)
    {
        $this->monto = $monto;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function setIdRegistroFactura($idRegistroFactura)
    {
        $this->idRegistroFactura = $idRegistroFactura;
    }

    // Constructor
    public function __construct($idReporte = null, $numeroFactura = null, $usuario = null, $departamento = null, $monto = null, $fecha = null, $idRegistroFactura = null)
    {
        $this->idReporte = $idReporte;
        $this->numeroFactura = $numeroFactura;
        $this->usuario = $usuario;
        $this->departamento = $departamento;
        $this->monto = $monto;
        $this->fecha = $fecha;
        $this->idRegistroFactura = $idRegistroFactura;
    }
}
