<?php include_once 'headerAuth.php'; ?>

<main class="contenedor contenido-principal">
    <h2>Restablecer Contraseña</h2>
    <p class="subtitulo-auth">Introduce a continuación tu nueva contraseña</p>
    <div class="contenido-auth">
    <?php include_once __DIR__."/../templates/alertas.php" ?>
    <?php if($mostrar) { ?>
        <form class="formulario-auth" method="POST">
            <div class="campo-auth">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Tu Contraseña">
            </div>
            <div class="campo-auth">
                <label for="password2">Repetir Contraseña</label>
                <input type="password" id="password2" name="password2" placeholder="Repite tu Contraseña">
            </div>
            <input type="submit" class="boton boton-primario-block" value="Restablecer">
        </form>
    <?php } ?>
    </div>
</main>
    