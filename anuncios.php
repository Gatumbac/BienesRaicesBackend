<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor pagina-anuncios">
        <h1>Casas y Departamentos en Venta</h1>
        <?php
        incluirTemplate('anuncios');
        ?>
    </main>

    <?php incluirTemplate('footer'); ?>
