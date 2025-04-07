<?php include_once __DIR__.'/../headerDash.php'; ?>

<div class="contenedor-pf">

    <?php include_once __DIR__.'/../../templates/alertas.php'; ?>

    <form class="formulario-perfil" method="POST">
    <?php if($resultado){  // ?? o isset para evitar errores en /admin
        $mensaje = mostrarNotificacion( intval( $resultado) );
        if($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>
        <?php } ?>
    <?php } ?>
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
                <a href="/perfil-foto?id=<?php echo $usuario->id; ?>">Añadir foto<img src="/build/img/perfil/pen-solid.svg" alt="foto perfil"></a>
            </div>
        </div>
        <div class="seccion-perfil">
        <h3>Información Personal</h3> <a href="/perfil-info">Modificar <img src="/build/img/perfil/pen-solid.svg" alt="modificar datos personales"></a>
        <p>Ubicación: <?php if(empty($usuario->ubicacion)){ ?>
            <a href="/perfil-info"> <img src="/build/img/perfil/pen-solid.svg" alt="modificar ubicacion">Añadir ubicación</a></p>
            <?php }else{
                echo $usuario->ubicacion;
            } ?>
        <p>Género: <?php if(empty($usuario->genero)){ ?>
            <a href="/perfil-info"> <img src="/build/img/perfil/pen-solid.svg" alt="modificar genero">Añadir género</a></p>
            <?php }else{
                echo $usuario->genero;
            } ?>
        <p>Fecha de nacimiento: <?php if(empty($usuario->fechaNacimiento)){ ?>
            <a href="/perfil-info"> <img src="/build/img/perfil/pen-solid.svg" alt="modificar fecha de nacimiento">Añadir fecha de nacimiento</a></p>
            <?php }else{
                echo date('d/M/Y', strtotime($usuario->fechaNacimiento));
            } ?>
        <p>Teléfono: +34 <?php echo $usuario->telefono; ?></p>
        <p>Email:  <?php echo $usuario->email; ?></p>
        <p>Contraseña: <a href="/perfil-pass"> <img src="/build/img/perfil/pen-solid.svg" alt="modificar contraseña">Modificar contraseña</a></p>
        </div>
        <div class="seccion-perfil">
        <h3>Información adicional</h3> <a href="/perfil-infoad">Modificar <img src="/build/img/perfil/pen-solid.svg" alt="modificar datos adicionales"></a>
        <p>Descripción personal: <a href="/perfil-infoad"> <img src="/build/img/perfil/pen-solid.svg" alt="modificar descripción personal">Añadir descripción</a></p>
        <p>Preferencia de notificación: <a href="/perfil-infoad"> <img src="/build/img/perfil/pen-solid.svg" alt="modificar preferencia de notificación">Añadir preferencias</a></p>
        <p>Idiomas: <a href="/perfil-infoad"> <img src="/build/img/perfil/pen-solid.svg" alt="modificar idiomas">Añadir idioma</a></p>
        </div>
        <div class="seccion-perfil">
        <h3>Vehículo</h3> <a href="/perfil-vehiculo">Modificar <img src="/build/img/perfil/pen-solid.svg" alt="modificar vehiculo"></a>
        <p>Tu vehículo: <?php if(empty($usuario->vehiculo)){ ?>
            <a href="/perfil-vehiculo"> <img src="/build/img/perfil/pen-solid.svg" alt="modificar vehiculo">Añadir vehículo</a></p>
            <?php }else{
                echo $usuario->vehiculo;
            } ?>
        </div>
    </div>

</div><!--contenido-->