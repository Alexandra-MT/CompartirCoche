<?php include_once __DIR__.'/headerDash.php'; ?>
    <main class="contenedor-sm">
    <?php if($resultado){  // ?? o isset para evitar errores en /admin
        $mensaje = mostrarNotificacion( intval( $resultado) );
        if($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>
        <?php } ?>
    <?php } ?>

    <div>
        <?php if(count($viajes) === 0){ ?>
            <p class="no-viajes">No hay viajes aún.</p>
        <?php }else{ ?>
        <?php foreach($viajes as $viaje){ ?>
            <div class="viajes">
                <p class="titulo-viaje text-center"><span><?php echo $viaje->origen; ?></span> <img class="flecha" src="/build/img/arrow-right-solid.svg" alt="flecha"> <span><?php echo $viaje->destino; ?></span></p>
                <p>Dirección de recogida de los pasajeros: <span><?php echo $viaje->direccionRecogida; ?></span></p>
                <p>Fecha y hora del viaje: el <span><?php echo date("d/m/Y", strtotime($viaje->fecha)); ?></span> a las <span><?php echo date("H:i", strtotime($viaje->hora)); ?></span> horas.</p>
                <p>Número de plazas disponibles: <span><?php echo $viaje->plazas; ?></span> y el precio por plaza es de <span><?php echo $viaje->precio; ?>€.</span></p>
                <p>Reserva automática: <span><?php echo $viaje->automatico == 1 ? 'Si' : 'No'; ?></span></p>
                <p>Se aceptan mascotas: <span><?php echo $viaje->mascota == 1 ? 'Si' : 'No'; ?></span></p>
                <p>Más información sobre el viaje: <span><?php echo empty($viaje->informacion) ? 'No se proporciona información adicional.' : $viaje->informacion; ?></span></p>
                <div class="acciones">
                    <a href="/compartir-actualizar?id=<?php echo $viaje->id; ?>" class="boton boton-verde">Actualizar</a>
                    <form method="POST" action="/compartir-cancelar">
                        <input type="hidden" name="id" value="<?php echo $viaje->id; ?>">
                        <input type="submit" class="boton boton-rojo-block" value="Cancelar">
                    </form>
                </div> 
            </div> 
            <?php } ?>
        <?php } ?>
        </div>
    </main>
</div><!--contenido-->
