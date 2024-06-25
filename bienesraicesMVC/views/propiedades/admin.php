<main class="contenedor seccion">
    <h1>Administrar de Bienes Raices</h1>

    <?php
    if ($registrado) {
        $mensaje = mostrarNotificacion(intval($registrado));
        if ($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje); ?> </p>
        <?php } ?>
    <?php } ?>


    <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="boton boton-amarillo-block">Nuevo/a Vendedor</a>

    <h2>Propiedades</h2>

    <table class="propiedades">

        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!--MOSTRAR RESULTADOS-->
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td> <?php echo $propiedad->id; ?></td>
                    <td> <?php echo $propiedad->titulo; ?></td>
                    <td> <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="" class="imagen-tabla"></td>
                    <td> <?php echo $propiedad->precio; ?> </td>
                    <td>
                        <form method="POST" action="/propiedades/eliminar">

                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar">

                        </form>

                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-verde-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

        <table class="propiedades">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>

                </tr>
            </thead>

            <tbody> <!--MOSTRAR RESULTADOS-->
                <?php foreach ($vendedores as $vendedor) : ?>
                    <tr>
                        <td> <?php echo $vendedor->id; ?></td>
                        <td> <?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                        <td> <?php echo $vendedor->telefono; ?> </td>
                        <td>
                            <form method="POST" action="/vendedores/eliminar">

                                <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                                <input type="hidden" name="tipo" value="vendedor">
                                <input type="submit" class="boton-rojo-block w-100" value="Eliminar">

                            </form>

                            <a href="vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-verde-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
</main>