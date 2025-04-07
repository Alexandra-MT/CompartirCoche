<?php include_once __DIR__.'/../headerDash.php'; ?>

<div class="contenedor-pf">
    <?php include_once __DIR__.'/../../templates/alertas.php'; ?>
    <form class="formulario-perfil" method="POST">
        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo s($usuario->nombre); ?>">
        </div>
        <div class="campo">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido" value="<?php echo s($usuario->apellido); ?>">
        </div>
        <div class="campo">
            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" placeholder="Tu Ubicación" value="<?php echo s($usuario->ubicacion); ?>">
        </div>
        <div class="campo">
            <label for="genero">Género:</label>
            <select name="genero" id="genero">
                <option value="" selected disabled>--Selecciona--</option>
                <option value="Mujer">Mujer</option>
                <option value="Hombre">Hombre</option>
            </select>
        </div>
        <div class="campo">
            <label for="fechaNacimiento">Fecha de nacimiento:</label>
            <input type="date" name="fechaNacimiento" id="fechaNacimiento" value="<?php echo s($usuario->fechaNacimiento); ?>">
        </div>
        <div class="campo">
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" placeholder="Tu Teléfono" value="<?php echo s($usuario->telefono); ?>">
        </div>
        <div class="campo">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Tu Email" value="<?php echo s($usuario->email); ?>">
        </div>
        <div class="acciones">
            <input type="submit" value="Actualizar" class="boton boton-verde">
            <a href="/perfil" class="boton boton-rojo">Volver</a>
        </div>
    </form>
</div>