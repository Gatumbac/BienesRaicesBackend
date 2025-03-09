<?php
    require 'includes/config/database.php';
    $db = conectarDB();
    if(!isset($_GET['id'])) {
        header('Location: /anuncios.php');
        exit;
    }

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header('Location: /anuncios.php');
        exit;
    }

    $query = "SELECT * FROM PROPIEDADES WHERE ID = {$id}";
    
    $resultado = mysqli_query($db, $query);

    if(!$resultado || mysqli_num_rows($resultado) === 0) {
        header('Location: /anuncios.php');
        exit;
    }

    $anuncio = mysqli_fetch_assoc($resultado);

    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion anuncio-contenido">
        <h1><?php echo $anuncio['titulo']; ?></h1>
        <img src="<?php echo '/imagenes/' . $anuncio['imagen']; ?>" alt="imagen propiedad">
        <div class="resumen-propiedad">
            <p class="precio"><?php echo '$ '. $anuncio['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                <li class="icono">
                    <img src="src/img/full/icono_wc.svg" alt="icono propiedad">
                    <p><?php echo $anuncio['cantidad_wc']; ?></p>
                </li>
                <li class="icono">
                    <img src="src/img/full/icono_estacionamiento.svg" alt="icono propiedad">
                    <p><?php echo $anuncio['cantidad_parqueos']; ?></p>
                </li>
                <li class="icono">
                    <img src="src/img/full/icono_dormitorio.svg" alt="icono propiedad">
                    <p><?php echo $anuncio['cantidad_habitaciones']; ?></p>
                </li>
            </ul>
        </div>
        <p><?php echo $anuncio['descripcion']; ?></p>
    </main>

    <?php incluirTemplate('footer'); ?>

