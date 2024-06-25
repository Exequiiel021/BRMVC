<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

class PropiedadController
{

    public static function index(Router $router)
    { //con el static no se necesita instanciar

        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();

        //Muestra mensaje condicional
        $registrado = $_GET['registrado'] ?? null; //para que no muestre nada el get y con esto queda perfecto, si hay un valor pasara al if para mostrar "anuncio creado"

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'registrado' => $registrado,
            'vendedores' => $vendedores
        ]);
    }

    public static function create(Router $router)
    {

        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        // ARREGLO CON MENSAJE DE ERRORES
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crea una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);
            

            // Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Setear la imagen

            // Realiza un resize a la imagen con intervention version 3.4

            if ($_FILES['propiedad']['tmp_name']['imagen']) { //['propiedad']['tmp_name']['imagen']
                $manager = new Image(Driver::class);
                $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen']);
                $image->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            //Validar
            $errores = $propiedad->validar();

            if (empty($errores)) {
                // Crear Carpeta para subir imagenes

                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                // Guarda en la base de datod
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    // Metodo POST para actualizar
    public static function update(Router $router){
        
        $id = validarORedireccionar('/admin');

        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Asignar los atributos
        
            $args = $_POST['propiedad'];
        
            $propiedad->sincronizar($args);
        
            //Validacion
            $errores = $propiedad->validar();
        
            //Subida de archivos
            // Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen']);
                $image->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
        
        
            if (empty($errores)) { //empty verifica que no este vacio el arreglo, si esta vacio pasa la validacion para ejecutar el query
        
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    //Almacenar imagen
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
        
                $propiedad->guardar();
            }
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
        
            if ($id) {
        
                $tipo = $_POST['tipo'];
        
                if (validarTipoContenido($tipo)) {
                    //Obtener los datos de la propiedad
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}
