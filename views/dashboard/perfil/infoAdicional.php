<?php include_once __DIR__.'/../headerDash.php'; ?>

<div class="contenedor-pf">
    <?php include_once __DIR__.'/../../templates/alertas.php'; ?>
    <form class="formulario-perfil infoad" method="POST">
        <div class="campo">
            <label for="descripcionPersonal">Descripción personal:</label>
            <textarea name="descripcionPersonal" id="descripcionPersonal" rows="5"></textarea>
        </div>
        <div class="multiselect">
            <div class="campo">
            <label for="preferenciaNotificacion">Notificaciones:</label>
                <select-multiple name="preferenciaNotificacion">
                    <option value="email">Email</option>
                    <option value="teléfono">Teléfono</option>
                    <option value="app">App</option>
                </select-multiple>
            </div>
            <div class="campo">
            <label for="idiomas">Idiomas:</label>
            <select-multiple name="idiomas">
                <option value="1">Español</option>
                <option value="2">Inglés</option>
                <option value="3">Francés</option>
                <option value="4">Portugués</option>
            </select-multiple>
            </div>
        </div>
        <div class="acciones">
            <input type="submit" value="Actualizar" class="boton boton-verde">
            <a href="/perfil" class="boton boton-rojo">Volver</a>
        </div>
    </form>
</div>
<?php $script .= '<script src="build/js/select-multiple.js"></script>'; ?>