<?php include_once 'headerAuth.php'; ?>

<main class="contenedor contenido-principal">
    <h2>Iniciar Sesión</h2>
    <div class="contenido-auth">
    <?php include_once __DIR__."/../templates/alertas.php" ?>
        <form class="formulario-auth" action="/login" method="POST">
            <div class="campo-auth">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Tu Email" autocomplete="off">
            </div>
            <div class="campo-auth">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Tu Contraseña">
            </div>
            <input type="submit" class="boton boton-primario-block" value="Iniciar Sesión">
        </form>
        <div class="acciones">
            <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
            <a href="/olvide">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</main>
    