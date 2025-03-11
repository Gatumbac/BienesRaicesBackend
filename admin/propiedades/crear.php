<?php
    require '../../includes/app.php';
    use App\Propiedad;
    use Intervention\Image\Drivers\Gd\Driver;
    use Intervention\Image\ImageManager as Image;

    //Sesión autenticada
    autenticarAdmin();

    $db = conectarDB();

    //Vendedores
    $queryVendedores = "SELECT * FROM VENDEDORES";
    $resultadoVendedores = mysqli_query($db, $queryVendedores);

    //Arreglo de mensajes de error
    $errores = Propiedad::$errores;

    //Variables que almacenan el campo
    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $parqueos = '';
    $vendedorId = '';
    $creado = date('Y/m/d');

    //Luego de que el usuario envía el form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $propiedad = new Propiedad($_POST);

        //Genera un nombre único para las imagenes.
        $nombreImagen = md5( uniqid (rand(), true) ) . ".jpg";

        if($_FILES["imagen"]["tmp_name"]) {
            $manager = new Image(new Driver());
            $imagen = $manager->read($_FILES["imagen"]["tmp_name"])->cover(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        $errores = $propiedad->validar();

        if (empty($errores)) {

            //Imagenes - Crear la carpeta
            if (!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }

            //Mover la imagen subida a la carpeta.
            $imagen->save(CARPETA_IMAGENES . $nombreImagen);

            //Guardar en la base de datos
            $resultado = $propiedad->guardar();

            if($resultado) {
                header("Location: /admin/?resultado=1");
                exit;
            }
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
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo</label>
                <input 
                    type="text" 
                    id="titulo" 
                    name="titulo" 
                    placeholder="Titulo de la Propiedad"
                    value="<?php echo $titulo; ?>"
                >
                
                <label for="precio">Precio</label>
                <input 
                    type="number" 
                    id="precio" 
                    name="precio" 
                    min="1000" 
                    placeholder="Precio de la Propiedad"
                    value="<?php echo $precio; ?>"
                >

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripcion</label>
                <textarea name="descripcion" id="descripcion"><?php echo $descripcion; ?></textarea>   

            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>
                <label for="habitaciones">Habitaciones</label>
                <input 
                    type="number" 
                    id="habitaciones" 
                    name="habitaciones" 
                    min="1" max="9" 
                    placeholder="Ej: 3"
                    value="<?php echo $habitaciones; ?>"
                >

                <label for="wc">Baños</label>
                <input 
                    type="number" 
                    id="wc" 
                    min="1" 
                    name="wc" 
                    max="9" 
                    placeholder="Ej: 3"
                    value="<?php echo $wc; ?>"
                >

                <label for="parqueos">Parqueos</label>
                <input 
                    type="number" 
                    id="parqueos" 
                    name="parqueos" 
                    min="1" max="9" 
                    placeholder="Ej: 3"
                    value="<?php echo $parqueos; ?>"
                >

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor_id" id="vendedores">
                    <option value="" selected>--Seleccione un vendedor--</option>
                    <?php while ($vendedor = mysqli_fetch_assoc($resultadoVendedores)) { ?>
                        <option <?php echo $vendedor['id'] === $vendedorId ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor["nombre"] . " " . $vendedor["apellido"]; ?></option>
                    <?php } ?>
                </select>

            </fieldset>
            
            <input type="submit" value="Crear Propiedad" class="boton-verde">
        </form>

    </main>

    <?php incluirTemplate('footer'); ?>
