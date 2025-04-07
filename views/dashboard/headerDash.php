<header class="header-auth">
    <div class="barra-mobile">
        <div class="logo">
            <a href="/dashboard">
                <img src="/build/img/logo.webp" alt="Logo CompartirCoche">
            </a>
        </div>
        <div class="usuario-mobile">
            <nav class="menu-perfilm">
                <div class="imagen-perfil">
                    <?php if(!$usuario->foto){?>
                    <img src="/build/img/perfil/avatar.png" class="imagen-small">
                    <?php }else{ ?>
                    <img src="/build/img/perfil/<?php echo $usuario->foto;?>" class="imagen-small">
                    <?php } ?>
                </div>
                <div class="desplegar-menu">
                    <img src="build/img/perfil/desplegar_menu.svg" alt="deplegar menu">
                </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="barra">
        <div class="logo">
            <a href="/dashboard">
                <img src="/build/img/logo.webp" alt="Logo CompartirCoche">
            </a>
        </div>
        <div class="usuario">
            <p>Hola <span><?php echo $_SESSION['nombre']; ?></span></p>
            <nav class="menu-perfil">
                <div class="imagen-perfil">
                    <?php if(!$usuario->foto){?>
                    <img src="/build/img/perfil/avatar.png" class="imagen-small">
                    <?php }else{ ?>
                    <img src="/build/img/perfil/<?php echo $usuario->foto;?>" class="imagen-small">
                    <?php } ?>
                </div>
                <div class="desplegar-menu">
                    <img src="build/img/perfil/desplegar_menu.svg" alt="deplegar menu">
                </div>
                </div>
            </nav>
        </div>
        <!--<a href="/logout" class="boton boton-rojo">Cerrar Sesión</a>-->
    </div> 
    <div class="menu-usuario">
        <ul>
            <li><a href="/dashboard">Tus viajes</a></li>
            <li><a href="/buscar">Buscar</a></li>
            <li><a href="/compartir-crear">Compartir</a></li>
            <li><a href="/perfil">Perfil</a></li>
            <li><a href="/logout">Cerrar Sesión</a></li>
        </ul>
    </div>
</header>
<div class="contenedor contenido-dashboard">
    <h2 class="nombre-pagina"><?php echo $titulo; ?></h2>

<?php $script = '<script src="build/js/perfil.js"></script>'; ?>