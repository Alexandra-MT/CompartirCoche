<?php include 'headerAuth.php'; ?>

<main class="contenedor contenido-principal">
    <h2>Crear una nueva cuenta</h2>
    <div class="contenido-auth">
        <?php include_once __DIR__."/../templates/alertas.php" ?>
        <form class="formulario-auth" action="/crear-cuenta" method="POST">
            <div class="campo-auth">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo s($usuario->nombre); ?>">
            </div>
            <div class="campo-auth">
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido" value="<?php echo s($usuario->apellido); ?>">
            </div>
            <div class="campo-auth">
                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" placeholder="Tu Teléfono" value="<?php echo s($usuario->telefono); ?>">
            </div>
            <div class="campo-auth">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Tu Email" value="<?php echo s($usuario->email); ?>">
            </div>
            <div class="campo-auth">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Tu Contraseña">
            </div>
            <div class="campo-auth">
                <label for="password2">Repetir Contraseña</label>
                <input type="password" id="password2" name="password2" placeholder="Repite tu Contraseña">
            </div>
            <input type="submit" class="boton boton-primario-block" value="Crear Cuenta">
        </form>
        <div class="acciones">
            <a href="/login">¿Ya tienes una cuenta? Iniciar Sesión</a>
            <a href="/olvide">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</main>
    