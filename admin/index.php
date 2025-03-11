<?php
    require '../includes/funciones.php';

    //Sesión autenticada
    autenticarAdmin();

    //Database
    require '../includes/config/database.php';
    $db = conectarDB();
    $query = "SELECT * FROM PROPIEDADES";
    $propiedades = mysqli_query($db, $query);

    //Resultado de agregar una propiedad
    $resultados = [
        '1' => 'Anuncio creado correctamente',
        '2' => 'Anuncio actualizado correctamente',
        '3' => 'Anuncio eliminado correctamente'
    ];

    $resultado = 0;
    if(isset($_GET["resultado"])) {
        $resultado = $_GET["resultado"];
    }

    //Eliminar propiedad
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idPropiedad = $_POST['id'];
        $idPropiedad = filter_var($idPropiedad, FILTER_VALIDATE_INT);

        if(!$idPropiedad) {
            header('Location: /admin');
            exit;
        }

        //Eliminar la imagen
        $queryImagen = "SELECT imagen FROM propiedades WHERE id=$idPropiedad";
        $resultadoQueryImagen = mysqli_query($db, $queryImagen);
        $resultadoImagen = mysqli_fetch_assoc($resultadoQueryImagen);
        $imagenEliminar = $resultadoImagen['imagen'];
        
        $rutaImagen = '../imagenes/' . $imagenEliminar;
        if (file_exists($rutaImagen)) {
            unlink($rutaImagen);
        }

        //Eliminar la propiedad
        $queryEliminacion = "DELETE FROM PROPIEDADES WHERE id=$idPropiedad";
        $resultadoQuery = mysqli_query($db, $queryEliminacion);

        if($resultadoQuery) {
            header("Location: /admin/?resultado=3");
            exit;
        }
    }

    // Incluye el header
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raíces</h1>
        <?php if(isset($resultados[$resultado])) { ?>
            <div class="alerta exito">
                <?php echo $resultados[$resultado]; ?>
            </div>
        <?php } ?>

        <a href="/admin/propiedades/crear.php" class="boton-verde">Nueva Propiedad</a>

        <table class="propiedades-tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($propiedad = mysqli_fetch_assoc($propiedades)) { ?>
                    <tr>
                        <td><?php echo $propiedad["id"] ?></td>
                        <td><?php echo $propiedad["titulo"] ?></td>
                        <td class="imagen-celda"><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad["imagen"] ?>" alt="imagen casa"></td>
                        <td>$ <?php echo $propiedad["precio"] ?></td>
                        <td>
                            <a class="boton-amarillo" href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad["id"] ?>">Actualizar</a>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $propiedad['id'] ?>">
                                <input type="submit" class="boton-rojo boton-eliminar" value="Eliminar">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <?php incluirTemplate('footer'); ?>