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

    public function getTipoProductoId() {
        return $this->tipo_producto_id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setTipoProductoId($tipo_producto_id) {
        $this->tipo_producto_id = $tipo_producto_id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
}



?>