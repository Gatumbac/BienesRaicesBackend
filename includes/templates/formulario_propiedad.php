<?php

?>
<fieldset>
<legend>Información General</legend>

<label for="titulo">Titulo</label>
<input 
    type="text" 
    id="titulo" 
    name="titulo" 
    placeholder="Titulo de la Propiedad"
    value="<?php echo s( $propiedad->getTitulo() ); ?>"
>

<label for="precio">Precio</label>
<input 
    type="number" 
    id="precio" 
    name="precio" 
    min="1000" 
    placeholder="Precio de la Propiedad"
    value="<?php echo s( $propiedad->getPrecio() ); ?>"
>

<label for="imagen">Imagen</label>
<input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

<?php if ($propiedad->getImagen()) { ?>
    <img src="/imagenes/<?php echo $propiedad->getImagen(); ?>" alt="imagen propiedad" class="imagen-small">
<?php } ?>

<label for="descripcion">Descripcion</label>
<textarea name="descripcion" id="descripcion"><?php echo s ($propiedad->getDescripcion()); ?></textarea>   

</fieldset>

<fieldset>
<legend>Información de la Propiedad</legend>
<label for="habitaciones">Habitaciones</label>
<input 
    type="number" 
    id="habitaciones" 
    name="cantidad_habitaciones" 
    min="1" max="9" 
    placeholder="Ej: 3"
    value="<?php echo $propiedad->getCantidadHabitaciones(); ?>"
>

<label for="wc">Baños</label>
<input 
    type="number" 
    id="wc" 
    min="1" 
    name="cantidad_wc" 
    max="9" 
    placeholder="Ej: 3"
    value="<?php echo $propiedad->getCantidadWc(); ?>"
>

<label for="parqueos">Parqueos</label>
<input 
    type="number" 
    id="parqueos" 
    name="cantidad_parqueos" 
    min="1" max="9" 
    placeholder="Ej: 3"
    value="<?php echo $propiedad->getCantidadParqueos(); ?>"
>

</fieldset>

<fieldset>
<legend>Vendedor</legend>

<select name="vendedor_id" id="vendedores">
    <option value="1" selected>--Seleccione un vendedor--</option>
</select>

</fieldset>