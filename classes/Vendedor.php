<?php
namespace App;

class Vendedor extends ActiveRecord{
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    protected static $tabla = 'VENDEDORES';

    protected $id;
    protected $nombre;
    protected $apellido;
    protected $telefono;
    
    public function __construct(array $args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function getApellido() {
        return $this->apellido;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }
    
    public function getTelefono() {
        return $this->telefono;
    }
    
    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function validar() {
        self::$errores = [];
    
        if (!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio";
        }
    
        if (!$this->apellido) {
            self::$errores[] = "El apellido es obligatorio";
        }
    
        if (!$this->telefono) {
            self::$errores[] = "El teléfono es obligatorio";
        } else if (!preg_match('/^09\d{8}$/', $this->telefono)) {
            self::$errores[] = "Formato Inválido de Teléfono";
        }
    
        return self::$errores;
    }
}