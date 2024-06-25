<?php

if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>

    <header class=" header <?php echo $inicio ? 'inicio' : ''; ?>"> <!-- la variable inicio esta declarada en el index, si esta como true agrega la foto, caso contrario al no estar en las demas no lo agrega -->
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="../../index.php">
                    <img src="/build/img/logo.svg" alt="logotipo bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono-menu-responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="dark-mode">
                    <nav class="navegacion">
                        <a href="../../nosotros.php">Nosotros</a>
                        <a href="../../anuncios.php">Anuncios</a>
                        <a href="../../blog.php">Blog</a>
                        <a href="../../contacto.php">Contacto</a>
                        <?php if (!$auth) : ?>
                            <a href="/login.php">Login</a>
                        <?php endif; ?>

                        <?php if ($auth) : ?>
                            <a href="/admin">Administrar</a>
                            <a href="/cerrar-sesion.php">Cerrar Sesión</a>
                        <?php endif; ?>

                    </nav>
                </div>

            </div> <!--Cierre de la barra-->

            <?php if ($inicio) { ?>
                <h1>Venta de casas y departamentos exclusivos de lujo</h1>
            <?php } ?>
        </div>
    </header>

    <script src="/build/js/bundle.min.js"></script>
    <!-- <script src="../../build/js/bundle.min.js"></script> -->
    <!-- <script src="build/js/bundle.min.js"></script> -->