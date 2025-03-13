<?php
    require '../../includes/app.php';
    use App\ImagenHandler;
    use App\Propiedad;
    use App\Vendedor;

    autenticarAdmin();

    $vendedores = Vendedor::all();

    $errores = Propiedad::getErrores();

    $idPropiedad = $_GET['id'] ?? '';
    $idPropiedad = filter_var($idPropiedad, FILTER_VALIDATE_INT);
    verificarExistencia($idPropiedad);

    $propiedad = Propiedad::find($idPropiedad);
    verificarExistencia($propiedad);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $propiedad->sincronizar($_POST);    
        $errores = $propiedad->validar();

        if (empty($errores)) {

            if ($_FILES["imagen"]["tmp_name"]) {
                ImagenHandler::borrarImagen(CARPETA_IMAGENES . $propiedad->getImagen());
                $propiedad->setImagen(ImagenHandler::getNombreAleatorio());
                ImagenHandler::procesarImagen($_FILES["imagen"], $propiedad->getImagen());
            }

            $propiedad->guardar();
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>
        <a href="/admin/" class="boton-verde">Volver</a>

        <?php foreach($errores as $error) { ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
        <?php } ?>

        <form action="/admin/propiedades/actualizar.php?id=<?php echo $idPropiedad; ?>" class="form" method="POST" enctype="multipart/form-data">
            
            <?php include '../../includes/templates/formulario_propiedad.php' ?>
            
            <input type="submit" value="Actualizar Propiedad" class="boton-verde">
        </form>

    </main>

    <?php incluirTemplate('footer'); ?>
