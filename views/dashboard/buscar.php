<?php include_once __DIR__.'/headerDash.php'; ?>

<div class="contenido-viaje">
        <form class="formulario-viaje" action="/buscar" method="POST">
            <?php include_once __DIR__.'/../paginas/home/formularioBuscaViaje.php'; ?>
        </form>
    </div>
<div>
    
<?php include_once __DIR__.'/../templates/alertas.php' ?>

<?php include_once __DIR__.'/../paginas/home/validacionBuscarViajes.php' ; ?>

<?php $script .= '<script src="build/js/formularioValidar.js"></script>';
$script .= '<script src="build/js/perfil.js"></script>' ?>