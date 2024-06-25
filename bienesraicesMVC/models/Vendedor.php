<?php

namespace Model;

class Vendedor extends ActiveRecord
{

    protected static $tabla = "vendedores";
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar()
    {

        if (!$this->nombre) {
            self::$errores[] = 'EL Nombre es obligatorio';
        }

        if (!$this->apellido) {
            self::$errores[] = 'EL Apellido es obligatorio';
        }

        if (!$this->telefono) {
            self::$errores[] = 'EL teléfono es obligatorio';
        }
        //expresion regular: este caso quiere decir numeros del 0 al 9 con una extension maxima de 10 digitos
        if (!preg_match("/[0-9]{10}/", $this->telefono) or strlen($this->telefono) > 10) {
            self::$errores[] = "Formato de teléfono no válido";
        }

        return self::$errores;
    }
}
