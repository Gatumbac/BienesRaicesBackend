<?php
    require 'includes/app.php';
    use App\Propiedad;

    $id = $_GET['id'] ?? '';
    $id = filter_var($id, FILTER_VALIDATE_INT);
    verificarVariable($id, '/anuncios.php');

    $propiedad = Propiedad::find($id);
    verificarVariable($propiedad, '/anuncios.php');

    incluirTemplate('header');
?>

    <main class="contenedor seccion anuncio-contenido">
        <h1><?php echo $propiedad->getTitulo(); ?></h1>
        <img src="<?php echo '/imagenes/' . $propiedad->getImagen(); ?>" alt="imagen propiedad">
        <div class="resumen-propiedad">
            <p class="precio"><?php echo '$ '. $propiedad->getPrecio(); ?></p>
            <ul class="iconos-caracteristicas">
                <li class="icono">
                    <img src="src/img/full/icono_wc.svg" alt="icono propiedad">
                    <p><?php echo $propiedad->getCantidadWc(); ?></p>
                </li>
                <li class="icono">
                    <img src="src/img/full/icono_estacionamiento.svg" alt="icono propiedad">
                    <p><?php echo $propiedad->getCantidadParqueos(); ?></p>
                </li>
                <li class="icono">
                    <img src="src/img/full/icono_dormitorio.svg" alt="icono propiedad">
                    <p><?php echo $propiedad->getCantidadHabitaciones(); ?></p>
                </li>
            </ul>
        </div>
        <p><?php echo $propiedad->getDescripcion(); ?></p>
    </main>

    <?php incluirTemplate('footer'); ?>

