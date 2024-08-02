<?php

class Movimientos {
    private $movimiento_id;
    private $interes_cliente_id;
    private $cliente_id;
    private $producto_id;
    private $monto;
    private $dia;
    private $comentario;

    public function __construct($movimiento_id, $interes_cliente_id, $cliente_id, $producto_id, $monto, $dia, $comentario) {
        $this->movimiento_id = $movimiento_id;
        $this->interes_cliente_id = $interes_cliente_id;
        $this->cliente_id = $cliente_id;
        $this->producto_id = $producto_id;
        $this->monto = $monto;
        $this->dia = $dia;
        $this->comentario = $comentario;
    }

    // Getters
    public function getMovimientoId() {
        return $this->movimiento_id;
    }

    public function getInteresClienteId() {
        return $this->interes_cliente_id;
    }

    public function getClienteId() {
        return $this->cliente_id;
    }

    public function getProductoId() {
        return $this->producto_id;
    }

    public function getMonto() {
        return $this->monto;
    }

    public function getDia() {
        return $this->dia;
    }

    public function getComentario() {
        return $this->comentario;
    }

    // Setters
    public function setMovimientoId($movimiento_id) {
        $this->movimiento_id = $movimiento_id;
    }

    public function setInteresClienteId($interes_cliente_id) {
        $this->interes_cliente_id = $interes_cliente_id;
    }

    public function setClienteId($cliente_id) {
        $this->cliente_id = $cliente_id;
    }

    public function setProductoId($producto_id) {
        $this->producto_id = $producto_id;
    }

    public function setMonto($monto) {
        $this->monto = $monto;
    }

    public function setDia($dia) {
        $this->dia = $dia;
    }

    public function setComentario($comentario) {
        $this->comentario = $comentario;
    }

    public function metodoMostrar() {}
    public function metodoCrear() {}
    public function metodoEliminar() {}
    public function metodoEditar() {}
    public function metodoCalcularInteres() {}
}
?>
