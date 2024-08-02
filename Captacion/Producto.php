<?php

class Producto {
    private $producto_id;
    private $nombre;
    private $tipo_producto_id;
    private $tasa_interes;
    private $saldo_inicial;
    private $requisitos;
    private $beneficios;

    public function __construct($producto_id, $nombre, $tipo_producto_id, $tasa_interes, $saldo_inicial, $requisitos, $beneficios) {
        $this->producto_id = $producto_id;
        $this->nombre = $nombre;
        $this->tipo_producto_id = $tipo_producto_id;
        $this->tasa_interes = $tasa_interes;
        $this->saldo_inicial = $saldo_inicial;
        $this->requisitos = $requisitos;
        $this->beneficios = $beneficios;
    }

    // Getters
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

    public function getSaldoInicial() {
        return $this->saldo_inicial;
    }

    public function getRequisitos() {
        return $this->requisitos;
    }

    public function getBeneficios() {
        return $this->beneficios;
    }

    // Setters
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

    public function setSaldoInicial($saldo_inicial) {
        $this->saldo_inicial = $saldo_inicial;
    }

    public function setRequisitos($requisitos) {
        $this->requisitos = $requisitos;
    }

    public function setBeneficios($beneficios) {
        $this->beneficios = $beneficios;
    }

    public function metodoValidar() {}
    public function metodoMostrarProducto() {}
    public function metodoCrear() {}
    public function metodoEliminar() {}
    public function metodoEditar() {}
}
?>
