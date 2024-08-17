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
    public function getProductoClienteId() { return $this->producto_cliente_id; }
    public function getClienteId() { return $this->cliente_id; }
    public function getCasoId() { return $this->caso_id; }
    public function getProductoId() { return $this->producto_id; }
    public function getFechaAdquisicion() { return $this->fecha_adquisicion; }
    public function getSaldo() { return $this->saldo; }
    public function getPlazo() { return $this->plazo; }
    public function getIdAsientoContable() { return $this->id_asientoContable; }
    public function getInteresesClienteId() { return $this->intereses_cliente_id; }
    public function getEstado() { return $this->estado; }

    // Setters
    public function setProductoClienteId($producto_cliente_id) { $this->producto_cliente_id = $producto_cliente_id; }
    public function setClienteId($cliente_id) { $this->cliente_id = $cliente_id; }
    public function setCasoId($caso_id) { $this->caso_id = $caso_id; }
    public function setProductoId($producto_id) { $this->producto_id = $producto_id; }
    public function setFechaAdquisicion($fecha_adquisicion) { $this->fecha_adquisicion = $fecha_adquisicion; }
    public function setSaldo($saldo) { $this->saldo = $saldo; }
    public function setPlazo($plazo) { $this->plazo = $plazo; }
    public function setIdAsientoContable($id_asientoContable) { $this->id_asientoContable = $id_asientoContable; }
    public function setInteresesClienteId($intereses_cliente_id) { $this->intereses_cliente_id = $intereses_cliente_id; }
    public function setEstado($estado) { $this->estado = $estado; }

    // Método para confirmar los detalles de la adquisición del producto por parte del cliente
    public function metodoConfirmacion() {
        return "Confirmación de Producto Cliente:\n" .
               "Producto Cliente ID: " . $this->producto_cliente_id . "\n" .
               "Cliente ID: " . $this->cliente_id . "\n" .
               "Caso ID: " . $this->caso_id . "\n" .
               "Producto ID: " . $this->producto_id . "\n" .
               "Fecha de Adquisición: " . $this->fecha_adquisicion . "\n" .
               "Saldo: $" . $this->saldo . "\n" .
               "Plazo: " . $this->plazo . " días\n" .
               "ID Asiento Contable: " . $this->id_asientoContable . "\n" .
               "Intereses Cliente ID: " . $this->intereses_cliente_id . "\n" .
               "Estado: " . $this->estado;
    }

    // Método para mostrar los detalles del producto cliente
    public function metodoMostrar() {
        return "Producto Cliente ID: " . $this->producto_cliente_id . "\n" .
               "Cliente ID: " . $this->cliente_id . "\n" .
               "Caso ID: " . $this->caso_id . "\n" .
               "Producto ID: " . $this->producto_id . "\n" .
               "Fecha de Adquisición: " . $this->fecha_adquisicion . "\n" .
               "Saldo: $" . $this->saldo . "\n" .
               "Plazo: " . $this->plazo . " días\n" .
               "ID Asiento Contable: " . $this->id_asientoContable . "\n" .
               "Intereses Cliente ID: " . $this->intereses_cliente_id . "\n" .
               "Estado: " . $this->estado;
    }

    // Método para crear un nuevo registro de producto cliente
    public function metodoCrear($producto_cliente_id, $cliente_id, $caso_id, $producto_id, $fecha_adquisicion, $saldo, $plazo, $id_asientoContable, $intereses_cliente_id, $estado) {
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

    // Método para eliminar un registro de producto cliente
    public function metodoEliminar() {
        $this->producto_cliente_id = null;
        $this->cliente_id = null;
        $this->caso_id = null;
        $this->producto_id = null;
        $this->fecha_adquisicion = null;
        $this->saldo = null;
        $this->plazo = null;
        $this->id_asientoContable = null;
        $this->intereses_cliente_id = null;
        $this->estado = null;
    }

    // Método para editar los detalles de un producto cliente existente
    public function metodoEditar($producto_cliente_id, $cliente_id, $caso_id, $producto_id, $fecha_adquisicion, $saldo, $plazo, $id_asientoContable, $intereses_cliente_id, $estado) {
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
}
?>
