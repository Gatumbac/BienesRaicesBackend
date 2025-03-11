<?php
    require '../includes/app.php';
    use App\Propiedad;

    //Sesión autenticada
    autenticarAdmin();

    //Metodo para obtener todas las propiedades
    $propiedades = Propiedad::all();

    //Database


    //Resultado de agregar una propiedad
    $resultados = [
        '1' => 'Anuncio creado correctamente',
        '2' => 'Anuncio actualizado correctamente',
        '3' => 'Anuncio eliminado correctamente'
    ];

    //Resultado de operaciones
    $resultado = $_GET["resultado"] ?? null;

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
                <?php foreach($propiedades as $propiedad) { ?>
                    <tr>
                        <td><?php echo $propiedad->getId() ?></td>
                        <td><?php echo $propiedad->getTitulo() ?></td>
                        <td class="imagen-celda"><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->getImagen() ?>" alt="imagen casa"></td>
                        <td>$ <?php echo $propiedad->getPrecio() ?></td>
                        <td>
                            <a class="boton-amarillo" href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->getId() ?>">Actualizar</a>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $propiedad->getId() ?>">
                                <input type="submit" class="boton-rojo boton-eliminar" value="Eliminar">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <?php incluirTemplate('footer'); ?>