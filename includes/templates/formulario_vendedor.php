<?php

?>
<fieldset>
<legend>Información General</legend>

<label for="nombre">Nombre</label>
<input 
    type="text" 
    id="nombre" 
    name="nombre" 
    placeholder="Nombre del Vendedor"
    value="<?php echo s( $vendedor->getNombre() ); ?>"
>

<label for="apellido">Apellido</label>
<input 
    type="text" 
    id="apellido" 
    name="apellido" 
    placeholder="Apellido del Vendedor"
    value="<?php echo s( $vendedor->getApellido() ); ?>"
>
</fieldset>


<fieldset>
<legend>Información Adicional</legend>

<label for="telefono">Teléfono</label>
<input 
    type="tel" 
    id="telefono" 
    name="telefono" 
    placeholder="Telefono del Vendedor"
    value="<?php echo s( $vendedor->getTelefono() ); ?>"
>

</fieldset>