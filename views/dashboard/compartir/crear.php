<?php include_once __DIR__.'/../headerDash.php'; ?>
    <div class="contenedor-sm">
        <form class="formulario-compartir" action="/compartir-crear" method="POST">
        <?php include_once __DIR__.'/../../templates/alertas.php' ?>
        <?php include_once 'formularioUsuario.php' ?>
        <input type="submit" class="boton boton-naranja" value="Crear">
        </form>
    </div>

</div><!--contenido-->

