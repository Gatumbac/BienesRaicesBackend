<?php

    //Autenticación de usuario
    //Conexión
    require 'includes/app.php';
    $db = conectarDB();

    //Arreglo de mensajes de error
    $errores = [];

    //Recolección de datos
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $emailUser = $_POST['email'];
        $passwordUser = $_POST['password'];

        $emailUser = mysqli_real_escape_string($db, filter_var($emailUser, FILTER_VALIDATE_EMAIL));
        $passwordUser = mysqli_real_escape_string($db, $passwordUser);

        if(!$emailUser) {
            $errores[] = 'Email con formato inválido';
        }

        if(empty($passwordUser)) {
            $errores[] = 'La contraseña es obligatoria';
        }

        if(empty($errores)) {
            $query = "SELECT * FROM USUARIOS WHERE email = '{$emailUser}'";
            $resultado = mysqli_query($db, $query);
            if(mysqli_num_rows($resultado) === 0) {
                $errores[] = 'El usuario no existe';
            } else {
                $passwordBD = mysqli_fetch_assoc($resultado)['password'];
                $auth = password_verify($passwordUser, $passwordBD);

                if($auth) {
                    //El usuario está autenticado
                    session_start();

                    //Llenar información de la sesión
                    //Superglobal $_SESSION
                    $_SESSION['usuario'] = $emailUser;
                    $_SESSION['login'] = true;
                    
                    //Redireccionar al usuario
                    header('Location: /admin/');
                    exit;

                } else {
                    $errores[] = 'El password es incorrecto';
                }
            }
        }
    }


    //Header
    incluirTemplate('header');
?>

    <main class="contenedor iniciar-sesion seccion">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error) { ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
        <?php } ?>

        <form method="POST" class="form">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">Email</label>
                <input id="email" type="email" name="email" placeholder="Tu Email">

                <label for="password">Password</label>
                <input id="password" type="password" name="password" placeholder="Tu Contraseña">

            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton-verde">
        </form>
    </main>

    <?php incluirTemplate('footer'); ?>
