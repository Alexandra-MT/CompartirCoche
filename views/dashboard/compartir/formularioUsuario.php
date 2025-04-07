<div class="campos">
    <div class="campo">
        <label for="origen">¿Desde donde viajas? *</label>
        <input type="text" id="origen" name="origen" placeholder="Origen" value="<?php echo s($viaje->origen); ?>">
    </div>
    <div class="campo">
        <label for="destino">¿A donde te diriges? *</label>
        <input type="text" id="destino" name="destino" placeholder="Destino" value="<?php echo s($viaje->destino); ?>">
    </div>
    <div class="campo">
        <label for="direccionRecogida">Dirección de recogida de pasageros: *</label>
        <input type="text" id="direccionRecogida" name="direccionRecogida" placeholder="Dirección de recogida" value="<?php echo s($viaje->direccionRecogida); ?>">
    </div>
    <div class="campo">
        <label for="fecha">Fecha del viaje: *</label>
        <input type="date" id="fecha" name="fecha" placeholder="Fecha">
    </div>
    <div class="campo">
        <label for="hora">Hora de salida: *</label>
        <input type="time" id="hora" name="hora" placeholder="Hora" >
    </div>
    <div class="campo">
        <label for="plazas">Número de plazas disponibles: *</label>
        <input type="number" id="plazas" name="plazas" placeholder="Numero de plazas" min="0" value="<?php echo s($viaje->plazas); ?>">
    </div>
    <div class="campo">
        <label for="precio">Precio por plaza: *</label>
        <input type="number" id="precio" name="precio" placeholder="Precio por plaza" min="0" value="<?php echo s($viaje->precio); ?>">
    </div>
    <div class="campo">
    <label for="automatico">Permites la reserva automatica?</label>
        <select id="automatico" name="automatico" required>
            <option value="1" selected>Si</option>
            <option value="0">No</option>
        </select>
    </div> 
    <div class="campo">
    <label for="mascota">¿Se aceptan mascotas?</label>
        <select id="mascota" name="mascota" required>
            <option value="0" selected>No</option>
            <option value="1">Si</option>
        </select>
    </div> 
    <div class="campo">
        <label for="informacion">Más información sobre el viaje:</label>
        <textarea id="informacion" name="informacion"><?php echo s($viaje->informacion); ?></textarea>
    </div>
</div>
<?php $script .= '<script src="build/js/formularioValidar.js"></script>'; ?>

