<?php
    require '../../includes/app.php';
    use App\Vendedor;

    autenticarAdmin();

    $vendedor = new Vendedor();

    $errores = Vendedor::getErrores();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $vendedor = new Vendedor($_POST);

        $errores = $vendedor->validar();

        if (empty($errores)) {
            $vendedor->guardar();
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear Vendedor/a</h1>
        <a href="/admin/" class="boton-verde">Volver</a>

        <?php foreach($errores as $error) { ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
        <?php } ?>

        <form action="/admin/vendedores/crear.php" class="form" method="POST">

            <?php include '../../includes/templates/formulario_vendedor.php' ?>

            <input type="submit" value="Crear Vendedor" class="boton-verde">
        </form>

    </main>

    <?php incluirTemplate('footer'); ?>
