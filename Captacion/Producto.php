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
    public function getProductoId() { return $this->producto_id; }
    public function getNombre() { return $this->nombre; }
    public function getTipoProductoId() { return $this->tipo_producto_id; }
    public function getTasaInteres() { return $this->tasa_interes; }
    public function getSaldoInicial() { return $this->saldo_inicial; }
    public function getRequisitos() { return $this->requisitos; }
    public function getBeneficios() { return $this->beneficios; }

    // Setters
    public function setProductoId($producto_id) { $this->producto_id = $producto_id; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setTipoProductoId($tipo_producto_id) { $this->tipo_producto_id = $tipo_producto_id; }
    public function setTasaInteres($tasa_interes) { $this->tasa_interes = $tasa_interes; }
    public function setSaldoInicial($saldo_inicial) { $this->saldo_inicial = $saldo_inicial; }
    public function setRequisitos($requisitos) { $this->requisitos = $requisitos; }
    public function setBeneficios($beneficios) { $this->beneficios = $beneficios; }

    // Método para validar los detalles del producto
    public function metodoValidar() {
        if (empty($this->nombre) || empty($this->tipo_producto_id) || $this->tasa_interes <= 0 || $this->saldo_inicial < 0) {
            return false;  // Devuelve falso si la validación falla
        }
        return true;  // Devuelve verdadero si todos los campos son válidos
    }

    // Método para mostrar los detalles del producto
    public function metodoMostrarProducto() {
        return "Producto ID: " . $this->producto_id . "\n" .
               "Nombre: " . $this->nombre . "\n" .
               "Tipo Producto ID: " . $this->tipo_producto_id . "\n" .
               "Tasa de Interés: " . $this->tasa_interes . "%\n" .
               "Saldo Inicial: $" . $this->saldo_inicial . "\n" .
               "Requisitos: " . $this->requisitos . "\n" .
               "Beneficios: " . $this->beneficios;
    }

    // Método para crear un nuevo producto
    public function metodoCrear($producto_id, $nombre, $tipo_producto_id, $tasa_interes, $saldo_inicial, $requisitos, $beneficios) {
        $this->producto_id = $producto_id;
        $this->nombre = $nombre;
        $this->tipo_producto_id = $tipo_producto_id;
        $this->tasa_interes = $tasa_interes;
        $this->saldo_inicial = $saldo_inicial;
        $this->requisitos = $requisitos;
        $this->beneficios = $beneficios;
    }

    // Método para eliminar un producto
    public function metodoEliminar() {
        $this->producto_id = null;
        $this->nombre = null;
        $this->tipo_producto_id = null;
        $this->tasa_interes = null;
        $this->saldo_inicial = null;
        $this->requisitos = null;
        $this->beneficios = null;
    }

    // Método para editar los detalles de un producto existente
    public function metodoEditar($producto_id, $nombre, $tipo_producto_id, $tasa_interes, $saldo_inicial, $requisitos, $beneficios) {
        $this->producto_id = $producto_id;
        $this->nombre = $nombre;
        $this->tipo_producto_id = $tipo_producto_id;
        $this->tasa_interes = $tasa_interes;
        $this->saldo_inicial = $saldo_inicial;
        $this->requisitos = $requisitos;
        $this->beneficios = $beneficios;
    }
}

?>
