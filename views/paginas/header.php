<header class="header">
    <div class="barra-mobile">
        <div class="logo">
            <a href="/">
                <img src="/build/img/logo.webp" alt="Logo CompartirCoche">
            </a>
        </div>
        <div class="menu">
            <img src="build/img/mobile/menu.svg" alt="imagen-menu">
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
    <div class="contenido-header">
        <div class="texto-header">
            <h1><?php echo $textoHeader ? $textoHeader : ''; ?></h1>
            <a href="/login" class="boton-primario">Comienza ahora</a>
        </div>
    </div>
</header>
<?php 
$script = '<script src="build/js/mobile.js"></script>'; ?>
