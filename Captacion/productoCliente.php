<?php

class ProductoCliente {
    private $producto_cliente_id;
    private $cliente_id;
    private $producto_id;
    private $caso_id;
    private $fecha_adquisicion;
    private $monto;
    private $plazo;
    private $tasa_interes;
    private $estado;

    public function __construct($producto_cliente_id, $cliente_id, $producto_id, $caso_id, $fecha_adquisicion, $monto, $plazo, $tasa_interes, $estado) {
        $this->producto_cliente_id = $producto_cliente_id;
        $this->cliente_id = $cliente_id;
        $this->producto_id = $producto_id;
        $this->caso_id = $caso_id;
        $this->fecha_adquisicion = $fecha_adquisicion;
        $this->monto = $monto;
        $this->plazo = $plazo;
        $this->tasa_interes = $tasa_interes;
        $this->estado = $estado;
    }

    public function getProductoClienteId() {
        return $this->producto_cliente_id;
    }

    public function getClienteId() {
        return $this->cliente_id;
    }

    public function getProductoId() {
        return $this->producto_id;
    }

    public function getCasoId() {
        return $this->caso_id;
    }

    public function getFechaAdquisicion() {
        return $this->fecha_adquisicion;
    }

    public function getMonto() {
        return $this->monto;
    }

    public function getPlazo() {
        return $this->plazo;
    }

    public function getTasaInteres() {
        return $this->tasa_interes;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setProductoClienteId($producto_cliente_id) {
        $this->producto_cliente_id = $producto_cliente_id;
    }

    public function setClienteId($cliente_id) {
        $this->cliente_id = $cliente_id;
    }

    public function setProductoId($producto_id) {
        $this->producto_id = $producto_id;
    }

    public function setCasoId($caso_id) {
        $this->caso_id = $caso_id;
    }

    public function setFechaAdquisicion($fecha_adquisicion) {
        $this->fecha_adquisicion = $fecha_adquisicion;
    }

    public function setMonto($monto) {
        $this->monto = $monto;
    }

    public function setPlazo($plazo) {
        $this->plazo = $plazo;
    }

    public function setTasaInteres($tasa_interes) {
        $this->tasa_interes = $tasa_interes;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
}


?>