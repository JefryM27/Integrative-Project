<?php

class Producto {
    private $producto_id;
    private $nombre;
    private $tipo_producto_id;
    private $tasa_interes;
    private $saldo_minimo;
    private $requisitos;
    private $beneficios;

    public function __construct($producto_id, $nombre, $tipo_producto_id, $tasa_interes, $saldo_minimo, $requisitos, $beneficios) {
        $this->producto_id = $producto_id;
        $this->nombre = $nombre;
        $this->tipo_producto_id = $tipo_producto_id;
        $this->tasa_interes = $tasa_interes;
        $this->saldo_minimo = $saldo_minimo;
        $this->requisitos = $requisitos;
        $this->beneficios = $beneficios;
    }

    public function getProductoId() {
        return $this->producto_id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTipoProductoId() {
        return $this->tipo_producto_id;
    }

    public function getTasaInteres() {
        return $this->tasa_interes;
    }

    public function getSaldoMinimo() {
        return $this->saldo_minimo;
    }

    public function getRequisitos() {
        return $this->requisitos;
    }

    public function getBeneficios() {
        return $this->beneficios;
    }

    public function setProductoId($producto_id) {
        $this->producto_id = $producto_id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setTipoProductoId($tipo_producto_id) {
        $this->tipo_producto_id = $tipo_producto_id;
    }

    public function setTasaInteres($tasa_interes) {
        $this->tasa_interes = $tasa_interes;
    }

    public function setSaldoMinimo($saldo_minimo) {
        $this->saldo_minimo = $saldo_minimo;
    }

    public function setRequisitos($requisitos) {
        $this->requisitos = $requisitos;
    }

    public function setBeneficios($beneficios) {
        $this->beneficios = $beneficios;
    }
}


?>