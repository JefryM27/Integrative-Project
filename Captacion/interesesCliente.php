<?php

class InteresesCliente {
    private $interes_cliente_id;
    private $cliente_id;
    private $producto_id;
    private $fecha_interes;
    private $comentario;

    public function __construct($interes_cliente_id, $cliente_id, $producto_id, $fecha_interes, $comentario) {
        $this->interes_cliente_id = $interes_cliente_id;
        $this->cliente_id = $cliente_id;
        $this->producto_id = $producto_id;
        $this->fecha_interes = $fecha_interes;
        $this->comentario = $comentario;
    }

    // Getters
    public function getInteresClienteId() {
        return $this->interes_cliente_id;
    }

    public function getClienteId() {
        return $this->cliente_id;
    }

    public function getProductoId() {
        return $this->producto_id;
    }

    public function getFechaInteres() {
        return $this->fecha_interes;
    }

    public function getComentario() {
        return $this->comentario;
    }

    // Setters
    public function setInteresClienteId($interes_cliente_id) {
        $this->interes_cliente_id = $interes_cliente_id;
    }

    public function setClienteId($cliente_id) {
        $this->cliente_id = $cliente_id;
    }

    public function setProductoId($producto_id) {
        $this->producto_id = $producto_id;
    }

    public function setFechaInteres($fecha_interes) {
        $this->fecha_interes = $fecha_interes;
    }

    public function setComentario($comentario) {
        $this->comentario = $comentario;
    }
}
?>
