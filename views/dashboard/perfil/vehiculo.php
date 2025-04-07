<?php include_once __DIR__.'/../headerDash.php'; ?>

<div class="contenedor-pf">
    <?php include_once __DIR__.'/../../templates/alertas.php'; ?>
    <form class="formulario-perfil" method="POST" action="/perfil-vehiculo">
        <div class="campo">
            <label for="vehiculo">Vehículo:</label>
            <input type="text" id="vehiculo" name="vehiculo" placeholder="Tu Vehículo">
        </div>
        <div class="acciones">
            <input type="submit" value="Actualizar" class="boton boton-verde">
            <a href="/perfil" class="boton boton-rojo">Volver</a>
        </div>
    </form>
</div>
