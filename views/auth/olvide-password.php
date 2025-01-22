<?php include_once 'headerAuth.php'; ?>

<main class="contenedor contenido-principal">
    <h2>Olvide Password</h2>
    <p class="subtitulo-auth">Reestablece tu password escribiendo tu email a continuación</p>
    <div class="contenido-auth">
        <form class="formulario-auth" action="/olvide" method="POST">
            <div class="campo-auth">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Tu Email">
            </div>
            <input type="submit" class="boton boton-primario-block" value="Enviar Intrucciones">
        </form>
    </div>
</main>
    