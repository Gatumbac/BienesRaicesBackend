<?php
    require __DIR__ . '/../config/database.php';
    $db = conectarDB();
    $limite = 3;
    $query = "SELECT * FROM PROPIEDADES ORDER BY id DESC LIMIT {$limite}";

    if(!$inicio) {
        $query = "SELECT * FROM PROPIEDADES ORDER BY id DESC";
    }
    
    $resultado = mysqli_query($db, $query);
?>

<div class="contenedor-anuncios">
    <?php while($anuncio = mysqli_fetch_assoc($resultado)) { ?>
    <div class="anuncio">
        <img src="<?php echo '/imagenes/' . $anuncio['imagen']; ?>" alt="imagen propiedad">
        <div class="contenido-anuncio">
            <h3><?php echo $anuncio['titulo']; ?></h3>
            <p><?php echo $anuncio['descripcion']; ?></p>
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
            <a class="boton" href="anuncio.php?id=<?php echo $anuncio['id']; ?>">Ver Propiedad</a>
        </div>
    </div>
    <?php } ?>
</div>