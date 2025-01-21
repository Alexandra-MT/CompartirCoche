<?php include 'headerAuth.php'; ?>

<main class="contenedor contenido-principal">
    <h2>Crear una nueva cuenta</h2>
    <div class="contenido-auth">
        <form class="formulario-auth" action="/crear-cuenta" method="POST">
            <div class="campo-auth">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre">
            </div>
            <div class="campo-auth">
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido">
            </div>
            <div class="campo-auth">
                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" placeholder="Tu Teléfono">
            </div>
            <div class="campo-auth">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Tu Email">
            </div>
            <div class="campo-auth">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Tu password">
            </div>
            <input type="submit" class="boton boton-primario-block" value="Crear Cuenta">
        </form>
        <div class="acciones">
            <a href="/login">¿Ya tienes una cuenta?</a>
            <a href="/olvide">¿Olvidaste tu password?</a>
        </div>
    </div>
</main>
    