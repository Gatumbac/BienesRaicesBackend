<?php
    require '../includes/app.php';
    use App\ImagenHandler;
    use App\Propiedad;
    use App\Vendedor;

    autenticarAdmin();

    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    $resultados = [
        '1' => 'Registro creado correctamente',
        '2' => 'Registro actualizado correctamente',
        '3' => 'Registro eliminado correctamente'
    ];

    $resultado = $_GET["resultado"] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? '';
        $id = filter_var($id, FILTER_VALIDATE_INT);
        verificarExistencia($id);

        $tipo = $_POST['tipo'] ?? ''; 
        validarTipo($tipo);

        switch ($tipo) {
            case 'vendedor':
                $vendedor = Vendedor::find($id);
                verificarExistencia($vendedor);
                $vendedor->eliminar();
                break;
            
            case 'propiedad':
                $propiedad = Propiedad::find($id);
                verificarExistencia($propiedad);
                ImagenHandler::borrarImagen(CARPETA_IMAGENES . $propiedad->getImagen());
                $propiedad->eliminar();
                break;
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raíces</h1>
        <?php if(isset($resultados[$resultado])) { ?>
            <div class="alerta exito">
                <?php echo $resultados[$resultado]; ?>
            </div>
        <?php } ?>
        
        <div class="admin-botones">
            <a href="#propiedadesIndice" class="boton-amarilloR">Ver Propiedades</a>
            <a href="/admin/propiedades/crear.php" class="boton-verde">Nueva Propiedad</a>
            <a href="/admin/vendedores/crear.php" class="boton-amarilloR">Nuevo Vendedor</a>
            <a href="#vendedoresIndice" class="boton-verde">Ver Vendedores</a>

        </div>


        
        <h2 id="propiedadesIndice">Propiedades</h2>
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
                                <input type="hidden" name="tipo" value="propiedad">
                                <input type="submit" class="boton-rojo boton-eliminar" value="Eliminar">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h2 id="vendedoresIndice">Vendedores</h2>
        <table class="propiedades-tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($vendedores as $vendedor) { ?>
                    <tr>
                        <td><?php echo $vendedor->getId() ?></td>
                        <td><?php echo $vendedor->getNombre() . " " . $vendedor->getApellido() ?></td>
                        <td><?php echo $vendedor->getTelefono() ?></td>
                        <td>
                            <a class="boton-amarillo" href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->getId() ?>">Actualizar</a>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $vendedor->getId() ?>">
                                <input type="hidden" name="tipo" value="vendedor">
                                <input type="submit" class="boton-rojo boton-eliminar" value="Eliminar">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <?php incluirTemplate('footer'); ?>