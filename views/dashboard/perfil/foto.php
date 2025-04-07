<?php include_once __DIR__.'/../headerDash.php'; ?>

<div class="contenedor-pf">
    <?php include_once __DIR__.'/../../templates/alertas.php'; ?>
    <form class="formulario-perfil fotos" method="POST" enctype="multipart/form-data">
        <div class="header-perfil">
            <div class="imagen-perfil">
            <?php if(!$usuario->foto){?>
                <img src="/build/img/perfil/avatar.png" class="imagen-small">
            <?php }else{ ?>
                <img src="/build/img/perfil/<?php echo $usuario->foto;?>" class="imagen-small">
            <?php } ?>
            </div>
            <div class="nombre">
                <h3><?php echo $usuario->nombre." ".$usuario->apellido; ?></h3>
            </div>
        </div>
        <div class="foto">
            <label for="foto">Selecciona una foto de perfil</label>
            <input type="file" id="foto" name="foto" class="boton boton-verde-block" accept="image/jpeg, image/png">
            <input type="submit" value="Actualizar" class="boton boton-verde-block">
        </div>
    </form>
    <form method="POST" action="/foto-eliminar">
        <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
        <input type="submit" value="Eliminar" class="boton boton-rojo eliminar">
    </form>
</div>