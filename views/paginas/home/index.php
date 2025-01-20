<?php include_once __DIR__.'/../header.php'; ?>

<main class="contenedor contenido-principal">
    <h2>Busca un viaje</h2>
    <div class="contenido-viaje">
        <form class="formulario-viaje" action="/viajes" method="POST">
            <div class="campo">
                <label for="desde">Desde:</label>
                <input type="text" class="desde" id="desde" name="desde" placeholder="¿Desde donde viajas?" value="">
            </div>
            <div class="campo">
                <label for="hacia">Hacia:</label>
                <input type="text" class="hacia" id="hacia" name="hacia" placeholder="¿A donde viajas?" value="">
            </div>
            <div class="campo">
                <label for="fecha">Fecha:</label>
                <input type="date" class="fecha" id="fecha" name="fecha">
            </div>
            <div class="campo">
                <label for="personas">Personas:</label>
                <select name="personas" id="personas" >
                    <option selected disabled value="">¿Cuántos?</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <div class="campo boton-busqueda">
                <input type="submit" value="Buscar">
            </div>
        </form>
    </div>
    <section class="conoce">
        <h2>Nuestro objetivo es aumentar el bienestar</h2>
        <div class="objetivos">
            <div class="contenedor-objetivos">
                <p>Ayudando al medio ambiente 🌳👍: al viajar más pasajeros, hay menos vehículos circulando.<p>
                <p>Reduciendo el tiempo de desplazamiento y aumentando la seguridad. Al haber menos coches, el tráfico es más fluido.</p>
                <p>Establecer nuevos contactos.</p>
            </div>
            <div class="contenedor-objetivos">
                <p>Entretenimiento durante el desplazamiento gracias a las conversaciones entre viajeros.</p>
                <p>Evitando gastos de desplazamientos. Los pasajeros contribuyen a los gastos que tiene el conductor que ofrece el viaje.</p>
                <p>Facilitando una red de usuarios, una comunidad. Humanizando la sociedad.</p>
            </div>
        </div>   
    </section>
</main>


<?php include_once __DIR__.'/../footer.php'; ?>