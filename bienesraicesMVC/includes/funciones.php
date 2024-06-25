<?php

define('TEMPLATES_URL', __DIR__ . '/templates');  /*dir es una super global para poder traer la ruta completa para poder visualizar en este caso el header*/
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplates(string $nombre, bool $inicio = false)
{

    include TEMPLATES_URL . "/$nombre.php";
}

function estaAutenticado()
{
    if (!isset($_SESSION)) {
        session_start();
    }

    $auth = $_SESSION['login'];

    if ($auth) {
        return true;
    } else {
        return false;
    }

    // session_start();

    // if(!$_SESSION['login']){
    //     header('Location: /');
    // }

    // return true;

}

function debuguear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Escapa / sanitizar el html
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

//validar tipo de contenido
function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

//Muestra los mensajes
function mostrarNotificacion($codigo)
{
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}

function validarORedireccionar(string $url)
{
    //validar que la url sea valida por el id
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: $url");
    }

    return $id;
}
