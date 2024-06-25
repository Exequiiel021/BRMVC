<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {

        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router)
    {

        $router->render('paginas/nosotros', []);
    }

    public static function propiedades(Router $router)
    {

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router)
    {

        $id = validarORedireccionar('/propiedades');

        //buscar la propiedad por su id
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router)
    {
        $router->render('paginas/blog', []);
    }

    public static function entrada(Router $router)
    {

        $router->render('paginas/entrada', []);
    }

    public static function contacto(Router $router){

        $mensaje = null;
    

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuesta = $_POST['contacto'];

            //Creamos una instancia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP (protocolo que se usa para el envio de correos)
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '6d439450c17526';
            $mail->Password = 'c191010879af0d';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configurar el contenido del mail
            $mail->setFrom('admin@bienesraices.com'); //quien lo envia
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com'); //a que email va a llegar ese correo
            $mail->Subject = 'Tienes un nuevo Mensaje'; //lo primero que el usuario va a leer

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuesta['nombre'] . ' </p>'; //esos valores que tiene respuesta vienen del name del contacto


            //Enviar de forma condicional algunos campos de email o telefono
            if ($respuesta['contacto'] === 'telefono') {
                $contenido .= '<p>Eligio ser contactado por telefono</p>';
                $contenido .= '<p>Telefono: ' . $respuesta['telefono'] . ' </p>';
                $contenido .= '<p>Fecha Contacto: ' . $respuesta['fecha'] . ' </p>';
                $contenido .= '<p>Hora Contacto: ' . $respuesta['hora'] . ' </p>';
            } else {
                //Es email agregamos elcampo de email
                $contenido .= '<p>Eligio ser contactado por email</p>';
                $contenido .= '<p>Email: ' . $respuesta['email'] . ' </p>';
            }


            $contenido .= '<p>Mensaje: ' . $respuesta['mensaje'] . ' </p>';
            $contenido .= '<p>Vende o Compra: ' . $respuesta['tipo'] . ' </p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuesta['precio'] . ' </p>';
            $contenido .= '<p>Prefiere ser Contactado por: ' . $respuesta['contacto'] . ' </p>';

            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin html';

            //Enviar el correo
            if ($mail->send()) { //nos indica si se envio el correo true o false en caso que no se haya enviado
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "Mensaje no se pudo enviar";
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
