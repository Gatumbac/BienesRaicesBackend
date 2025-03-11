<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contacto-pagina">
        <h1>Contacto</h1>
        <picture>
            <source srcset="build/img/full/destacada3.webp" type="image/webp">
            <img src="build/img/full/destacada3.jpg" alt="imagen terraza">
        </picture>
        <h2>Llene el formulario de contacto</h2>
        <form action="" class="form">
            <fieldset>
                <legend>Información Personal</legend>

                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" placeholder="Tu nombre">

                <label for="email">Email</label>
                <input id="email" type="email" placeholder="Tu email">

                <label for="telefono">Teléfono</label>
                <input id="telefono" type="tel" placeholder="Tu teléfono">

                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje" placeholder="Escribe un mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <label for="opciones">Vende o compra</label>
                <select name="opcion compra" id="opciones">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input id="presupuesto" type="number" placeholder="Tu precio o presupuesto" min="1000">

            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <p>¿Cómo desea ser contactado?</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                    <label for="contactar-email">Email</label>
                    <input name="contacto" type="radio" value="email" id="contactar-email">
                </div>

                <p>Si eligió teléfono, elija la fecha y la hora para ser contactado</p>

                <label for="fecha">Fecha</label>
                <input id="fecha" type="date">

                <label for="hora">Hora</label>
                <input id="hora" type="time" min="08:00" max="17:00">
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>

    <?php incluirTemplate('footer'); ?>
