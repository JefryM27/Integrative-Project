<?php
class LiquidarVale
{
    private $idLiquidarVale;
    private $numeroVale;
    private $montoGastado;
    private $detalleGastos;
    private $fechaLiquidacion;
    private $usuario;
    private $idCajaChica;

    // Getters
    public function getIdLiquidarVale()
    {
        return $this->idLiquidarVale;
    }

    public function getNumeroVale()
    {
        return $this->numeroVale;
    }

    public function getMontoGastado()
    {
        return $this->montoGastado;
    }

    public function getDetalleGastos()
    {
        return $this->detalleGastos;
    }

    public function getFechaLiquidacion()
    {
        return $this->fechaLiquidacion;
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
    public function setIdLiquidarVale($idLiquidarVale)
    {
        $this->idLiquidarVale = $idLiquidarVale;
    }

    public function setNumeroVale($numeroVale)
    {
        $this->numeroVale = $numeroVale;
    }

    public function setMontoGastado($montoGastado)
    {
        $this->montoGastado = $montoGastado;
    }

    public function setDetalleGastos($detalleGastos)
    {
        $this->detalleGastos = $detalleGastos;
    }

    public function setFechaLiquidacion($fechaLiquidacion)
    {
        $this->fechaLiquidacion = $fechaLiquidacion;
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
    public function __construct($idLiquidarVale = null, $numeroVale = null, $montoGastado = null, $detalleGastos = null, $fechaLiquidacion = null, $usuario = null, $idCajaChica = null)
    {
        $this->idLiquidarVale = $idLiquidarVale;
        $this->numeroVale = $numeroVale;
        $this->montoGastado = $montoGastado;
        $this->detalleGastos = $detalleGastos;
        $this->fechaLiquidacion = $fechaLiquidacion;
        $this->usuario = $usuario;
        $this->idCajaChica = $idCajaChica;
    }
}
