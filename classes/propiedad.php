<?php
namespace App;

class Propiedad {
    //DB
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'cantidad_habitaciones', 'cantidad_wc', 'cantidad_parqueos', 'fecha_creacion', 'vendedores_id'];

    //Errores
    public static $errores = [];

    //Atributos
    private $id;
    private $titulo;
    private $precio;
    private $imagen;
    private $descripcion;
    private $cantidad_habitaciones;
    private $cantidad_wc;
    private $cantidad_parqueos;
    private $vendedores_id;
    private $fecha_creacion;
    
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
        $this->vendedores_id = $args['vendedor_id'] ?? "1";
        $this->fecha_creacion = date('Y-m-d');
    }

    // Getters y Setters
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

    public function getVendedoresId() {
        return $this->vendedores_id;
    }

    public function setVendedoresId($vendedores_id) {
        $this->vendedores_id = $vendedores_id;
    }

    public function getFechaCreacion() {
        return $this->fecha_creacion;
    }

    public function setFechaCreacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    public static function setDB($database) {
        self::$db = $database;
    }

    public function guardar() {
        $resultado = false;
        if(!$this->id) {
            $resultado = $this->crear();
        } else {
            $resultado = $this->actualizar();
        }
        return $resultado;
    }

    public function crear() {
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

    public function actualizar() {
        $atributos = $this->sanitizarDatos();
        $valores = [];

        foreach($atributos as $atributo=>$valor) {
            $valores[] = "{$atributo}='{$valor}'";
        }

        $id = self::$db->escape_string($this->id);
        $query = "UPDATE PROPIEDADES SET " . join(", ", $valores) . " WHERE id = '{$id}'";
        
        $resultado = false;
        try {
            $resultado = self::$db->query($query);
        } catch (\Throwable $th) {
            echo 'No se pudo actualizar la propiedad: ' . $th->getMessage();
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

    public static function all() {
        $query = "SELECT * FROM PROPIEDADES";
        $arrayPropiedades = self::consultarTabla($query);
        return $arrayPropiedades;
    }

    public static function find($id) {
        $query = "SELECT * FROM PROPIEDADES WHERE id = {$id}";
        $resultado = self::consultarTabla($query);
        return array_shift($resultado);
    }

    public static function consultarTabla($query) {
        $resultado = self::$db->query($query);
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }
        return $array;
    }

    public static function crearObjeto(array $registro) {
        $objeto = new self($registro);
        return $objeto;
    }

    //Sincronizar
    public function sincronizar(array $args = []) {
        foreach($args as $atributo=>$valor) {
            if (property_exists($this, $atributo)) {
                $this->$atributo = $valor;
            }
        }
    }


}