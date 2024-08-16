<?php
class RegistroFactura
{
    private $idRegistroFactura;
    private $numeroFactura;
    private $usuario;
    private $departamento;
    private $monto;
    private $fecha;
    private $idCajaChica;

    // Getters
    public function getIdRegistroFactura()
    {
        return $this->idRegistroFactura;
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

    public function getIdCajaChica()
    {
        return $this->idCajaChica;
    }

    // Setters
    public function setIdRegistroFactura($idRegistroFactura)
    {
        $this->idRegistroFactura = $idRegistroFactura;
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

    public function setIdCajaChica($idCajaChica)
    {
        $this->idCajaChica = $idCajaChica;
    }

    // Constructor
    public function __construct($idRegistroFactura = null, $numeroFactura = null, $usuario = null, $departamento = null, $monto = null, $fecha = null, $idCajaChica = null)
    {
        $this->idRegistroFactura = $idRegistroFactura;
        $this->numeroFactura = $numeroFactura;
        $this->usuario = $usuario;
        $this->departamento = $departamento;
        $this->monto = $monto;
        $this->fecha = $fecha;
        $this->idCajaChica = $idCajaChica;
    }
}
