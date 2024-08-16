<?php
class VerGastos
{
    private $idVerGastos;
    private $descripcion;
    private $usuario;
    private $fecha;
    private $idCajaChica;

    // Getters
    public function getIdVerGastos()
    {
        return $this->idVerGastos;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getUsuario()
    {
        return $this->usuario;
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
    public function setIdVerGastos($idVerGastos)
    {
        $this->idVerGastos = $idVerGastos;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
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
    public function __construct($idVerGastos = null, $descripcion = null, $usuario = null, $fecha = null, $idCajaChica = null)
    {
        $this->idVerGastos = $idVerGastos;
        $this->descripcion = $descripcion;
        $this->usuario = $usuario;
        $this->fecha = $fecha;
        $this->idCajaChica = $idCajaChica;
    }
}
