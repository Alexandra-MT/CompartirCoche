<?php include_once 'headerAuth.php'; ?>

<main class="contenedor contenido-principal">
    <h2>Olvide Contraseña</h2>
    <p class="subtitulo-auth">Restablece tu contraseña escribiendo tu email a continuación</p>
    <div class="contenido-auth">
    <?php include_once __DIR__."/../templates/alertas.php" ?>
    <?php if($mostrar) { ?>
        <form class="formulario-auth" action="/olvide" method="POST">
            <div class="campo-auth">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Tu Email">
            </div>
            <input type="submit" class="boton boton-primario-block" value="Enviar Intrucciones">
        </form>
        <?php } ?>
        <div class="acciones">
            <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
            <a href="/login">¿Ya tienes una cuenta? Iniciar Sesión</a>
        </div>
    </div>
</main>
    