<?php

namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){

        $this->rutasGET[$url] = $fn;

    }

    public function post($url, $fn){

        $this->rutasPOST[$url] = $fn;

    }

    public function comprobarRutas(){

        session_start();
        $auth = $_SESSION['login'] ?? NULL;

        //Arreglo de rutas protegidas...
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        // $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $urlActual = explode('?',$urlActual)[0];
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else{
            $urlActual = explode('?',$urlActual)[0];
            $fn = $this->rutasPOST[$urlActual] ?? NULL;
        }

        //Proteger las rutas
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if ($fn) {
            //La URL existe y hay una funcion asociada
            call_user_func($fn, $this);
        } else {
            echo "Pagina no encontrada";
        }
    }
    //Muestra una vista
    public function render($view, $datos= [] ){

        foreach($datos as $key => $value){
            $$key = $value; //variable de variable, va a generar variables de acuerdo a las key que se le pase
        }

        ob_start(); // inicia el almacenamiento de esta vista en memoria

        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); //. Esta línea recupera el contenido almacenado en el búfer de salida y lo asigna a la variable $contenido, luego limpiar memoria o buffer con ob_get_clean
        include_once __DIR__ . "/views/layout.php";


    }

    
}