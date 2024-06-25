<?php

namespace Model;

class ActiveRecord
{

    //BASE DE DATOS
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = "";

    //visibilidad de los atributos
    
    public $imagen;
    public $titulo;
    public $precio;
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $descripcion;
    public $estacionamiento;
    public $wc;
    public $habitaciones;


    //ERRORES
    protected static $errores = [];

    //Definir la conexion a la base de datos
    public static function setDB($dataBase)
    {
        self::$db = $dataBase; //no hace falta static porque ya lo cambiamos en app.php para que todas se conecten del padre osea activerecord
    }

    
    public function guardar()
    {
        if (!is_null($this->id)) {
            //actualizar
            $this->actualizar();
        } else {
            //crear nuevo registro
            $this->crear();
        }
    }

    public function crear()
    {
        //SANITIZAR LA ENTRADA DE DATOS
        $atributos = $this->sanitizarDatos();

        //forma clasica basica
        //INSERTAR EN LA BASE DE DATOS
        // $query = "INSERT INTO propiedades ( titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id ) 
        // VALUES ( '$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion', 
        // '$this->habitaciones','$this->wc', '$this->estacionamiento', '$this->creado', '$this->vendedores_id' )";

        //otra forma mas compacta
        // $query = "INSERT INTO propiedades ( ";
        // $query .= join(', ', array_keys($atributos));
        // $query .= " ) VALUES (' ";
        // $query .= join("' , '", array_values($atributos));
        // $query .= " ') ";

        $columnas = join(', ', array_keys($atributos)); //join creara un arreglo y toma primero que separa a cada elemento y luego el valor del array aqui key
        $fila = join("', '", array_values($atributos)); //join creara un arreglo y toma primero que separa a cada elemento y luego el valor del array aqui values

        //*  Consulta para insertar datos
        // $query = "INSERT INTO " . static::$tabla($columnas) VALUES ('$fila')";
        $query = "INSERT INTO " . static::$tabla . " ($columnas) VALUES ('$fila')";


        $resultado = self::$db->query($query);

        //Mensaje de Exito
        if ($resultado) {
            //REDIRECCIONAR AL USUARIO para evitar que duplique datos en la db
            header('Location: /admin?registrado=1');
        }
    }

    public function actualizar()
    {

        //SANITIZAR LA ENTRADA DE DATOS
        $atributos = $this->sanitizarDatos();

        $valores = [];

        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        if ($resultado) {
            //REDIRECCIONAR AL USUARIO para evitar que duplique datos en la db
            header('Location: /admin?registrado=2');
        }
    }

    //ELIMINAR el registro
    public function eliminar()
    {

        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }

    //Identificar y unir los atributos de la DB
    public function atributos()
    {
        $atributos = [];

        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue; //ignora el id

            $atributos[$columna] = $this->$columna; //se esta mapeando
        }

        return $atributos;
    }

    public function sanitizarDatos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];


        foreach ($atributos as $key => $value) { //arreglo asociativo para llamar la llave y su valor
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    //SUBIDA DE IMAGEN
    public function setImagen($imagen)
    {

        //Eimina la imagen previa si esta actualizando
        if (!is_null($this->id)) { //iseet revisa que exista y que tenga un valor
            $this->borrarImagen();
        }

        //Asignar al atributo imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //ELIMINAR ARCHIVO
    public function borrarImagen()
    {
        //Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    //VALIDACION.
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }

    //Lista todas las propiedades
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Obtiene determinado numero de registros
    public static function get($cantidad)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //BUSCA una propiedad por su id
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado); //este metodo devuelve el primer elemento del array
    }

    public static function consultarSQL($query)
    {
        //consultar la base de datos
        $resultado = self::$db->query($query);

        //iterar la base de datos
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        //liberar la memoria
        $resultado->free();

        //retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new static; //crear objetos de la clase en la cual se esta heredando, por eso el static

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) { //va a ir mapeando de arreglos a objetos
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {

        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
