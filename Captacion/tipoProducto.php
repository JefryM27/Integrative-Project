<?php

class TipoProducto {
    private $tipo_producto_id;
    private $nombre;
    private $descripcion;

    public function __construct($tipo_producto_id, $nombre, $descripcion) {
        $this->tipo_producto_id = $tipo_producto_id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    // Getters
    public function getTipoProductoId() {
        return $this->tipo_producto_id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    // Setters
    public function setTipoProductoId($tipo_producto_id) {
        $this->tipo_producto_id = $tipo_producto_id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    // Método para crear un nuevo tipo de producto
    public function metodoCrear($tipo_producto_id, $nombre, $descripcion) {
        $this->tipo_producto_id = $tipo_producto_id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    // Método para editar un tipo de producto existente
    public function metodoEditar($tipo_producto_id, $nombre, $descripcion) {
        $this->tipo_producto_id = $tipo_producto_id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    // Método para eliminar un tipo de producto
    public function metodoEliminar() {
        $this->tipo_producto_id = null;
        $this->nombre = null;
        $this->descripcion = null;
    }
}
?>
