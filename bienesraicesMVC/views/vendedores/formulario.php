<fieldset>
    <legend>Informacion General</legend>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre vendedor/a" value="<?php echo s($vendedor->nombre);  ?>"> <!-- se agregan eso para guardar el valor del value en el input gracias al value y php-->

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido vendedor/a" value="<?php echo s($vendedor->apellido);  ?>">
</fieldset>

<fieldset>
    <legend>Informacion Extra</legend>
    <label for="telefono">Telefono:</label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Teléfono vendedor/a" value="<?php echo s($vendedor->telefono);  ?>">
</fieldset>