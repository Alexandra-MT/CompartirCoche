<?php include_once 'headerAuth.php'; ?>

<main class="contenedor contenido-principal">
    <h2>Reestablecer Password</h2>
    <p class="subtitulo-auth">Introduce a continuación tu nuevo password</p>
    <div class="contenido-auth">
        <form class="formulario-auth" action="/reestablecer" method="POST">
            <div class="campo-auth">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Tu password">
            </div>
            <div class="campo-auth">
                <label for="password2">Repetir Password</label>
                <input type="password" id="password2" name="password2" placeholder="Repite tu password">
            </div>
            <input type="submit" class="boton boton-primario-block" value="Guardar Password">
        </form>
    </div>
</main>
    