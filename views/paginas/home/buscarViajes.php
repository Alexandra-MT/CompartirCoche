<header class="header-auth">
    <div class="barra-mobile">
        <div class="logo-mobile">
            <a href="/">
                <img src="/build/img/logo.webp" alt="Logo CompartirCoche">
            </a>
        </div>
    </div>
    <div class="barra">
        <div class="logo">
            <a href="/">
                <img src="/build/img/logo.webp" alt="Logo CompartirCoche">
            </a>
        </div>
        <nav class="nav-principal">
            <a href="/login">Comparte tu coche</a>
            <a href="/buscar-viajes">Busca un viaje</a>
            <a href="/login">Iniciar Sesión</a>
            <a href="/crear-cuenta">Crear cuenta</a>   
        </nav>
    </div>
</header>

<div class="contenedor contenido-dashboard">
    <h2 class="nombre-pagina"><?php echo $titulo; ?></h2>
    <div class="contenido-viaje">
        <form class="formulario-viaje" action="/buscar-viajes" method="POST">
            <?php include_once 'formularioBuscaViaje.php'; ?>
        </form>
    </div>
    <?php include_once __DIR__.'/../../templates/alertas.php'; ?>


    <?php include_once 'validacionBuscarViajes.php'; ?>
</div>

    