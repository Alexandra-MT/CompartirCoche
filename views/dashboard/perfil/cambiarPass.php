<?php include_once __DIR__.'/../headerDash.php'; ?>

<div class="contenedor-pf">
    <?php include_once __DIR__.'/../../templates/alertas.php'; ?>
    <form class="formulario-perfil" method="POST" action="/perfil-pass">
        <div class="campo">
            <label for="password_actual">Contraseña Actual</label>
            <input type="password" id="password_actual" name="password_actual" placeholder="Tu Contraseña Actual">
        </div>
        <div class="campo">
            <label for="password_nuevo">Nueva Contraseña</label>
            <input type="password" id="password_nuevo" name="password_nuevo" placeholder="Tu Nueva Contraseña">
        </div>
        <div class="campo">
            <label for="password_nuevor">Repetir Contraseña</label>
            <input type="password" id="password_nuevor" name="password_nuevor" placeholder="Repite Tu Nueva Contraseña">
        </div>
        <div class="acciones">
            <input type="submit" value="Actualizar" class="boton boton-verde">
            <a href="/perfil" class="boton boton-rojo">Volver</a>
        </div>
    </form>
</div>
