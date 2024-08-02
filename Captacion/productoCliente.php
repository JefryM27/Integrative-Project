<?php

class ProductoCliente {
    private $producto_cliente_id;
    private $cliente_id;
    private $caso_id;
    private $producto_id;
    private $fecha_adquisicion;
    private $saldo;
    private $plazo;
    private $id_asientoContable;
    private $intereses_cliente_id;
    private $estado;

    public function __construct($producto_cliente_id, $cliente_id, $caso_id, $producto_id, $fecha_adquisicion, $saldo, $plazo, $id_asientoContable, $intereses_cliente_id, $estado) {
        $this->producto_cliente_id = $producto_cliente_id;
        $this->cliente_id = $cliente_id;
        $this->caso_id = $caso_id;
        $this->producto_id = $producto_id;
        $this->fecha_adquisicion = $fecha_adquisicion;
        $this->saldo = $saldo;
        $this->plazo = $plazo;
        $this->id_asientoContable = $id_asientoContable;
        $this->intereses_cliente_id = $intereses_cliente_id;
        $this->estado = $estado;
    }

    // Getters
    public function getProductoClienteId() {
        return $this->producto_cliente_id;
    }

    public function getClienteId() {
        return $this->cliente_id;
    }

    public function getCasoId() {
        return $this->caso_id;
    }

    public function getProductoId() {
        return $this->producto_id;
    }

    public function getFechaAdquisicion() {
        return $this->fecha_adquisicion;
    }

    public function getSaldo() {
        return $this->saldo;
    }

    public function getPlazo() {
        return $this->plazo;
    }

    public function getIdAsientoContable() {
        return $this->id_asientoContable;
    }

    public function getInteresesClienteId() {
        return $this->intereses_cliente_id;
    }

    public function getEstado() {
        return $this->estado;
    }

    // Setters
    public function setProductoClienteId($producto_cliente_id) {
        $this->producto_cliente_id = $producto_cliente_id;
    }

    public function setClienteId($cliente_id) {
        $this->cliente_id = $cliente_id;
    }

    public function setCasoId($caso_id) {
        $this->caso_id = $caso_id;
    }

    public function setProductoId($producto_id) {
        $this->producto_id = $producto_id;
    }

    public function setFechaAdquisicion($fecha_adquisicion) {
        $this->fecha_adquisicion = $fecha_adquisicion;
    }

    public function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    public function setPlazo($plazo) {
        $this->plazo = $plazo;
    }

    public function setIdAsientoContable($id_asientoContable) {
        $this->id_asientoContable = $id_asientoContable;
    }

    public function setInteresesClienteId($intereses_cliente_id) {
        $this->intereses_cliente_id = $intereses_cliente_id;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function metodoConfirmacion() {}
    public function metodoMostrar() {}
    public function metodoCrear() {}
    public function metodoEliminar() {}
    public function metodoEditar() {}
}
?>
