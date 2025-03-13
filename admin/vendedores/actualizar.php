<?php
    require '../../includes/app.php';
    use App\ImagenHandler;
    use App\Propiedad;
    use App\Vendedor;

    autenticarAdmin();

    $errores = Vendedor::getErrores();

    $idVendedor = $_GET['id'] ?? '';
    $idVendedor = filter_var($idVendedor, FILTER_VALIDATE_INT);
    verificarExistencia($idVendedor);

    $vendedor = Vendedor::find($idVendedor);
    verificarExistencia($vendedor);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $vendedor->sincronizar($_POST);    
        $errores = $vendedor->validar();

        if (empty($errores)) {
            $vendedor->guardar();
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar Vendedor</h1>
        <a href="/admin/" class="boton-verde">Volver</a>

        <?php foreach($errores as $error) { ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
        <?php } ?>

        <form action="/admin/vendedores/actualizar.php?id=<?php echo $idVendedor; ?>" class="form" method="POST" enctype="multipart/form-data">
            
            <?php include '../../includes/templates/formulario_vendedor.php' ?>
            
            <input type="submit" value="Guardar Cambios" class="boton-verde">
        </form>

    </main>

    <?php incluirTemplate('footer'); ?>
