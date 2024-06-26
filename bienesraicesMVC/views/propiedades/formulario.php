<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="titulo propiedad" value="<?php echo s($propiedad->titulo);  ?>"> <!-- se agregan eso para guardar el valor del value en el input gracias al value y php-->

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="precio propiedad" value="<?php echo s($propiedad->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

    <?php if ($propiedad->imagen) : ?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" alt="imagen-pequeña" class="imagen-small">
    <?php endif; ?>

    <label for="descripcion">Descripcion</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>

</fieldset>

<fieldset>
    <legend>Informacion Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" placeholder="Ej:3" min="1" max="9" name="propiedad[habitaciones]" value="<?php echo s($propiedad->habitaciones); ?>">

    <label for="wc">Baños:</label>
    <input type="number" id="wc" placeholder="Ej:3" min="1" max="9" name="propiedad[wc]" value="<?php echo s($propiedad->wc); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" placeholder="Ej:3" min="1" max="9" name="propiedad[estacionamiento]" value="<?php echo s($propiedad->estacionamiento); ?>">

</fieldset>

<fieldset>

    <legend>Vendedor</legend>
    <label for="vendedor">Vendedor</label>
    <select name="propiedad[vendedores_id]" id="vendedor">
        <option selected value="">--Seleccione--</option>
        <?php foreach ($vendedores as $vendedor) { ?>
            <option 
            <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : ''; ?>
            value="<?php echo s($vendedor->id) ?>"><?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?>
            </option> <!--value es lo que vamos almacenar en la base de datos-->
        <?php } ?>
    </select>



</fieldset>