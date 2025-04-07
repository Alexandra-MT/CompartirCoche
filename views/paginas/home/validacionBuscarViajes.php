<div class="buscar-viajes">
    <?php if(count($buscarViaje) === 0){ ?>
            <?php if($mostrar){ ?>
                <div class="alerta info">Lo sentimos, no hay viajes disponibles para está selección.</div>
            <?php }else{ ?>
                <p class="no-viajes"></p> 
            <?php } ?>  
     <?php }else{ ?>
        <?php foreach($buscarViaje as $viaje){ ?>
            <div class="viajes">
                <div class="descripcion-viaje">
                    <div class="datos-viaje">
                        <p class="titulo-viaje"><span><?php echo $viaje->origen; ?></span> <img class="flecha" src="/build/img/arrow-right-solid.svg" alt="flecha"> <span><?php echo $viaje->destino; ?></span></p>
                        <div class="hora-viaje">
                            <img class="reloj" src="/build/img/clock-regular.svg" alt="hora">
                            <p><span><?php echo date('H:i',strtotime($viaje->hora)); ?>h</p>
                        </div>
                    </div>
                    <div class="precio">
                        <p>Precio: <span><?php echo $viaje->precio * $viajes->plazas; ?>€</span></p>
                    </div>
                </div>
                <div class="descripcion-viaje">
                    <div class="conductor">
                        <img src="build/img/perfil/<?php echo $viaje->foto ? $viaje->foto : '/avatar.png'; ?>" alt="foto conductor">
                        <p><span><?php echo $viaje->usuario; ?></span></p>
                    </div>
                    <div class="info-extra">
                        <p>Accepta mascota: <span><?php echo $viaje->mascota ==='0' ? 'No' : 'Si'; ?></span></p>
                        <p>Reserva automática: <span><?php echo $viaje->automatico === '1' ? 'Si' : 'No'; ?></span></p>
                    </div>
                </div>  
            </div>
                   
            <?php }
        }?>
</div><!--contenido-->
