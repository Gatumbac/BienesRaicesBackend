<?php

//Conexión
require 'includes/config/database.php';
$db = conectarDB();

//Crear un email y un password
$email = 'correo@correo.com';
$password = '123456';
//Los password hash siempre tendrán extensión de 60
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

//Query
$query = "INSERT INTO USUARIOS(email, password) VALUES ('{$email}', '{$passwordHash}')";

try {
    mysqli_query($db, $query);
} catch (\Throwable $th) {
    var_dump($th->getMessage());
}