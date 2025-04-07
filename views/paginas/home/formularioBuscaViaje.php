<div class="campo">
    <label for="origen">Desde:</label>
    <input type="text" id="origen" name="origen" placeholder="¿Desde donde viajas?" value="<?php echo s($viajes->origen); ?>">
</div>
<div class="campo">
    <label for="destino">Hacia:</label>
    <input type="text" id="destino" name="destino" placeholder="¿A donde viajas?" value="<?php echo s($viajes->destino); ?>">
</div>
<div class="campo">
    <label for="fecha">Fecha:</label>
    <input type="date" id="fecha" name="fecha" value="<?php echo $viajes->fecha ? date("Y-m-d", strtotime($viajes->fecha)) : '';?>">
</div>
<div class="campo">
    <label for="plazas">Personas:</label>
    <select name="plazas" id="plazas">
        <option selected value="<?php echo $viajes->plazas ? $viajes->plazas : '';?>"><?php echo $viajes->plazas ? $viajes->plazas : '¿Cuántos';?></option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
</div>
<div class="campo boton-busqueda">
    <input type="submit" value="Buscar">
</div>

<?php $script = '<script src="build/js/formularioValidar.js"></script>'; ?>