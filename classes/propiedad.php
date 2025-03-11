<?php
namespace App;

class Propiedad {
    //DB
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'cantidad_habitaciones', 'cantidad_wc', 'cantidad_parqueos', 'fecha_creacion', 'vendedores_id'];

    //Errores
    public static $errores = [];

    //Atributos
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $cantidad_habitaciones;
    public $cantidad_wc;
    public $cantidad_parqueos;
    public $vendedores_id;
    public $fecha_creacion;
    
    public function __construct(array $args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? 0;
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->cantidad_habitaciones = $args['habitaciones'] ?? 0;
        $this->cantidad_wc = $args['wc'] ?? 0;
        $this->cantidad_parqueos = $args['parqueos'] ?? 0;
        $this->vendedores_id = $args['vendedor_id'] ?? 0;
        $this->fecha_creacion = date('Y-m-d');
    }

    public static function setDB($database) {
        self::$db = $database;
    }

    public function setImagen(string $nombreImagen) {
        $this->imagen = $nombreImagen;
    }

    public function guardar() {
        //Sanitizar los datos
        $atributos = $this->sanitizarDatos();
        $stringColumnas = join(", ", array_keys($atributos));
        $stringValores = join("', '", array_values($atributos));

        //Query
        $query = "INSERT INTO PROPIEDADES(" . $stringColumnas . ") VALUES ('" . $stringValores . "')";
        $resultado = false;
        try {
            $resultado = self::$db->query($query);
        } catch (\Throwable $th) {
            echo 'No se pudo insertar la propiedad: ' . $th->getMessage();
        }
        return $resultado;
    }

    public function getAtributos() {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos() {
        $atributos = $this->getAtributos();
        $sanitizados = [];

        foreach ($atributos as $columna => $valor) {
            $sanitizados[$columna] = self::$db->escape_string($valor);
        }

        return $sanitizados;
    }

    public static function getErrores() {
        return self::$errores;
    }

    public function validar() {
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