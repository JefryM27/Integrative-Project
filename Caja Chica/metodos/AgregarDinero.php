<?php
class AgregarDinero
{
    private $idAgregarDinero;
    private $fecha;
    private $monto;
    private $usuario;
    private $idCajaChica;

    // Getters
    public function getIdAgregarDinero()
    {
        return $this->idAgregarDinero;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getIdCajaChica()
    {
        return $this->idCajaChica;
    }

    // Setters
    public function setIdAgregarDinero($idAgregarDinero)
    {
        $this->idAgregarDinero = $idAgregarDinero;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function setMonto($monto)
    {
        $this->monto = $monto;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function setIdCajaChica($idCajaChica)
    {
        $this->idCajaChica = $idCajaChica;
    }

    // Constructor
    public function __construct($idAgregarDinero = null, $fecha = null, $monto = null, $usuario = null, $idCajaChica = null)
    {
        $this->idAgregarDinero = $idAgregarDinero;
        $this->fecha = $fecha;
        $this->monto = $monto;
        $this->usuario = $usuario;
        $this->idCajaChica = $idCajaChica;
    }
}
