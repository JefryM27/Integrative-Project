<?php
class CajaChica
{
    private $idCajaChica;
    private $saldoActual;
    private $descripcion;
    private $monto;
    private $departamento;
    private $usuario;

    // Getters
    public function getIdCajaChica()
    {
        return $this->idCajaChica;
    }

    public function getSaldoActual()
    {
        return $this->saldoActual;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    // Setters
    public function setIdCajaChica($idCajaChica)
    {
        $this->idCajaChica = $idCajaChica;
    }

    public function setSaldoActual($saldoActual)
    {
        $this->saldoActual = $saldoActual;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setMonto($monto)
    {
        $this->monto = $monto;
    }

    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    // Constructor
    public function __construct($idCajaChica = null, $saldoActual = null, $descripcion = null, $monto = null, $departamento = null, $usuario = null)
    {
        $this->idCajaChica = $idCajaChica;
        $this->saldoActual = $saldoActual;
        $this->descripcion = $descripcion;
        $this->monto = $monto;
        $this->departamento = $departamento;
        $this->usuario = $usuario;
    }
}
