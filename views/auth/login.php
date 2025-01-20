<?php include_once 'headerAuth.php'; ?>

<main class="contenedor contenido-principal">
    <h2>Iniciar Sesión</h2>
    <div class="contenido-login">
        <form class="formulario-auth" action="/" method="POST">
            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Tu Email">
            </div>
            <div class="campo">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Tu password">
            </div>
            <div class="campo boton-busqueda">
                <input type="submit" value="Iniciar Sesión">
            </div>
        </form>
    </div>
    <div class="acciones">
        <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
        <a href="/olvide">¿Olvidaste tu password?</a>
    </div>