<?php

namespace Model;

class Propiedad extends ActiveRecord{

    protected static $tabla = "propiedades"; 
    protected static $columnasDB = [
        'id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc',
        'estacionamiento', 'creado', 'vendedores_id'
    ];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }

    public function validar()
    {

        if (!$this->titulo) {
            self::$errores[] = 'Debes añadir un titulo';
        }

        if (!$this->precio) {
            self::$errores[] = 'El precio es obligatorio';
        }

        if (!$this->descripcion) {
            self::$errores[] = 'Debes añadir una descripcion';
        }

        if (!$this->habitaciones) {
            self::$errores[] = 'Por favor ponga el numero de habitaciones';
        }

        if (!$this->wc) {
            self::$errores[] = 'Por favor coloque el numero de baños';
        }

        if (!$this->estacionamiento) {
            self::$errores[] = 'Por favor ponga el numero de estacionamiento';
        }

        if (!$this->vendedores_id) {
            self::$errores[] = 'Coloque el vendedor';
        }

        if (!$this->imagen) {
            self::$errores[] = 'Por favor ingrese una foto de la propiedad, es obligatoria';
        }

        return self::$errores;
    }
}
