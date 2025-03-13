<?php
namespace App;

class Propiedad extends ActiveRecord{
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'cantidad_habitaciones', 'cantidad_wc', 'cantidad_parqueos', 'fecha_creacion', 'vendedores_id'];

    protected static $tabla = 'PROPIEDADES';

    protected $id;
    protected $titulo;
    protected $precio;
    protected $imagen;
    protected $descripcion;
    protected $cantidad_habitaciones;
    protected $cantidad_wc;
    protected $cantidad_parqueos;
    protected $vendedores_id;
    protected $fecha_creacion;
    
    public function __construct(array $args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->cantidad_habitaciones = $args['cantidad_habitaciones'] ?? '';
        $this->cantidad_wc = $args['cantidad_wc'] ?? '';
        $this->cantidad_parqueos = $args['cantidad_parqueos'] ?? '';
        $this->vendedores_id = $args['vendedores_id'] ?? '';
        $this->fecha_creacion = date('Y-m-d');
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function setImagen(string $nombreImagen) {
        $this->imagen = $nombreImagen;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getCantidadHabitaciones() {
        return $this->cantidad_habitaciones;
    }

    public function setCantidadHabitaciones($cantidad_habitaciones) {
        $this->cantidad_habitaciones = $cantidad_habitaciones;
    }

    public function getCantidadWc() {
        return $this->cantidad_wc;
    }

    public function setCantidadWc($cantidad_wc) {
        $this->cantidad_wc = $cantidad_wc;
    }

    public function getCantidadParqueos() {
        return $this->cantidad_parqueos;
    }

    public function setCantidadParqueos($cantidad_parqueos) {
        $this->cantidad_parqueos = $cantidad_parqueos;
    }

    public function getVendedorId() {
        return $this->vendedores_id;
    }

    public function setVendedorId($vendedores_id) {
        $this->vendedores_id = $vendedores_id;
    }

    public function getFechaCreacion() {
        return $this->fecha_creacion;
    }

    public function setFechaCreacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function validar() {
        self::$errores = [];

        if (!$this->titulo) {
            self::$errores[] = 'El título es obligatorio';
        }

        if (!$this->precio) {
            self::$errores[] = 'El precio es obligatorio';
        }

        if (strlen($this->descripcion) < 50) {
            self::$errores[] = 'La descripción es obligatoria y debe tener al menos 50 caracteres';
        }

        if (!$this->cantidad_habitaciones || !$this->cantidad_wc || !$this->cantidad_parqueos) {
            self::$errores[] = 'Las características de la propiedad son obligatorias';
        }

        if (!$this->vendedores_id) {
            self::$errores[] = 'Elige un vendedor';
        }

        if (!$this->imagen) {
            self::$errores[] = 'La imagen es obligatoria';
        }

        return self::$errores;
    }
}