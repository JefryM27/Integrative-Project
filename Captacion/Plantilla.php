<?php

class Plantilla {
    private $plantilla_id;
    private $nombre;
    private $descripcion;
    private $contenido;

    public function __construct($plantilla_id, $nombre, $descripcion, $contenido) {
        $this->plantilla_id = $plantilla_id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->contenido = $contenido;
    }

    public function getPlantillaId() {
        return $this->plantilla_id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getContenido() {
        return $this->contenido;
    }

    public function setPlantillaId($plantilla_id) {
        $this->plantilla_id = $plantilla_id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setContenido($contenido) {
        $this->contenido = $contenido;
    }
}


?>