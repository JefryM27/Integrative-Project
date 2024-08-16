<?php
class AsientosContables
{
    private $idAsientoContable;
    private $fecha;
    private $cuenta;
    private $denominacion;
    private $debe;
    private $haber;
    private $idCajaChica;

    // Getters
    public function getIdAsientoContable()
    {
        return $this->idAsientoContable;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getCuenta()
    {
        return $this->cuenta;
    }

    public function getDenominacion()
    {
        return $this->denominacion;
    }

    public function getDebe()
    {
        return $this->debe;
    }

    public function getHaber()
    {
        return $this->haber;
    }

    public function getIdCajaChica()
    {
        return $this->idCajaChica;
    }

    // Setters
    public function setIdAsientoContable($idAsientoContable)
    {
        $this->idAsientoContable = $idAsientoContable;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function setCuenta($cuenta)
    {
        $this->cuenta = $cuenta;
    }

    public function setDenominacion($denominacion)
    {
        $this->denominacion = $denominacion;
    }

    public function setDebe($debe)
    {
        $this->debe = $debe;
    }

    public function setHaber($haber)
    {
        $this->haber = $haber;
    }

    public function setIdCajaChica($idCajaChica)
    {
        $this->idCajaChica = $idCajaChica;
    }

    // Constructor
    public function __construct($idAsientoContable = null, $fecha = null, $cuenta = null, $denominacion = null, $debe = null, $haber = null, $idCajaChica = null)
    {
        $this->idAsientoContable = $idAsientoContable;
        $this->fecha = $fecha;
        $this->cuenta = $cuenta;
        $this->denominacion = $denominacion;
        $this->debe = $debe;
        $this->haber = $haber;
        $this->idCajaChica = $idCajaChica;
    }
}
