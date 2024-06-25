<main class="contenedor seccion">
    <h1>Actualizar Vendedor/a</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    <form class="formulario" method="POST"> <!-- Importante el enctype para poder traer los detalles de la foto-->

        <?php include 'formulario.php'; ?> <!-- traigo el template de todo el formulario-->

        <input type="submit" value="Guardar Cambios" class="boton boton-verde">

    </form>

</main>