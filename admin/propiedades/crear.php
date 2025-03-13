<?php
    require '../../includes/app.php';
    use App\ImagenHandler;
    use App\Propiedad;
    use App\Vendedor;

    autenticarAdmin();

    $vendedores = Vendedor::all();

    $errores = Propiedad::getErrores();

    $propiedad = new Propiedad();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $propiedad = new Propiedad($_POST);

        if($_FILES["imagen"]["tmp_name"]) {
            $propiedad->setImagen(ImagenHandler::getNombreAleatorio());
        }

        $errores = $propiedad->validar();

        if (empty($errores)) {
            ImagenHandler::procesarImagen($_FILES["imagen"], $propiedad->getImagen());
            $propiedad->guardar();
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear Propiedad</h1>
        <a href="/admin/" class="boton-verde">Volver</a>

        <?php foreach($errores as $error) { ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
        <?php } ?>

        <form action="/admin/propiedades/crear.php" class="form" method="POST" enctype="multipart/form-data">

            <?php include '../../includes/templates/formulario_propiedad.php' ?>

            <input type="submit" value="Crear Propiedad" class="boton-verde">
        </form>

    </main>

    <?php incluirTemplate('footer'); ?>
