<?php
    require '../../includes/funciones.php';

    //Sesión autenticada
    $auth = isAuth();
    if(!$auth) {
        header('Location: /');
        exit;
    }

    require '../../includes/config/database.php';
    $db = conectarDB();

    //Vendedores
    $queryVendedores = "SELECT * FROM VENDEDORES";
    $resultadoVendedores = mysqli_query($db, $queryVendedores);

    //Arreglo de mensajes de error
    $errores = [];

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

        $titulo = mysqli_real_escape_string($db, $_POST["titulo"]);
        $precio = mysqli_real_escape_string($db, $_POST["precio"]);
        $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
        $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
        $wc = mysqli_real_escape_string($db, $_POST["wc"]);
        $parqueos = mysqli_real_escape_string($db, $_POST["parqueos"]);
        $vendedorId = mysqli_real_escape_string($db, $_POST["vendedor"]);
        $imagen = $_FILES["imagen"];
        

        if (!$titulo) {
            $errores[] = 'El título es obligatorio';
        }

        if (!$precio) {
            $errores[] = 'El precio es obligatorio';
        }

        if (strlen($descripcion) < 50) {
            $errores[] = 'La descripción es obligatoria y debe tener al menos 50 caracteres';
        }

        if (!$habitaciones || !$wc || !$parqueos) {
            $errores[] = 'Las características de la propiedad son obligatorias';
        }

        if (!$vendedorId) {
            $errores[] = 'Elige un vendedor';
        }

        if (!$imagen['name'] || $imagen['error']) {
            $errores[] = 'La imagen es obligatoria';
        }

        // Elegir peso máximo del archivo 1000KB = 1MB

        $medida = 1000 * 1000;

        if ($imagen['size'] > $medida) {
            $errores[] = 'La imagen es muy pesada. Peso máximo 100 KB';
        }
        
        if (empty($errores)) {

            //Imagenes - Crear la carpeta
            $carpetaImagenes = '../../imagenes/';
            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            //Genera un nombre único para las imagenes.
            $nombreImagen = md5( uniqid (rand(), true) ) . ".jpg";

            //Mover la imagen subida a la carpeta.
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);


            //Inserción 
            $queryProp = "INSERT INTO PROPIEDADES(titulo, precio, imagen, descripcion, cantidad_habitaciones, cantidad_wc, cantidad_parqueos, fecha_creacion, vendedores_id) VALUES ('$titulo', $precio, '$nombreImagen', '$descripcion', $habitaciones, $wc, $parqueos, '$creado', $vendedorId)";

            $resultadoProp = mysqli_query($db, $queryProp);

            if($resultadoProp) {
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

                <select name="vendedor" id="vendedores">
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
