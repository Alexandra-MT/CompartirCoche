<?php include_once __DIR__.'/../header.php'; ?>

<main class="contenedor contenido-principal">
    <h2>Busca un viaje</h2>
    <?php include_once __DIR__.'/buscaViaje.php'; ?>
    <section class="sobre-nosotros">
        <div class="texto-nosotros">
            <h3>Sobre Nosotros</h3>
            <p>Somos una Asociación que tiene como misión mejorar el bienestar de la sociedad al compartir actividades, recursos, habilidades y conocimientos. Para nosotros la sociedad no tiene fronteras por lo que esperamos que nuestras acciones tengan eco en todo el universo.</p>
        </div>
        <div class="imagen-nosotros">
            <img src="/build/img/foto_nosotros.jpg" alt="Sección Seguridad">
        </div>
    </section>
    <section class="conoce-objetivos">
        <h2>Nuestros objetivos</h2>
        <div class="objetivos">
            <div class="contenedor-objetivos">
                <div class="objetivo">
                    <p><span>Ayudando al medio ambiente.</span> Al viajar más pasajeros, hay menos vehículos circulando.<p>
                </div>
                <div class="objetivo">
                    <p><span>Reduciendo el tiempo de desplazamiento y aumentando la seguridad.</span> Al haber menos coches, el tráfico es más fluido.</p>
                </div>
                <div class="objetivo">
                    <p><span>Establecer nuevos contactos,</span> y porque no, nuevos amigos.</p>
                </div>
            </div>
            <div class="contenedor-objetivos">
                <div class="objetivo">
                    <p><span>Entretenimiento durante el desplazamiento</span> gracias a las conversaciones entre viajeros.</p>
                </div>
                <div class="objetivo">
                    <p><span>Evitando gastos de desplazamientos.</span> Los pasajeros contribuyen a los gastos que tiene el conductor que ofrece el viaje.</p>
                </div>
                <div class="objetivo">
                    <p><span>Facilitando una red de usuarios, una comunidad.</span> Humanizando la sociedad.</p>
                </div>
            </div>
        </div>   
    </section>
</main>

<?php $script .= '<script src="build/js/mobile.js"></script>'; ?>
<?php include_once __DIR__.'/../footer.php'; ?>