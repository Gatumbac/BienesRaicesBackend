<?php


function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'root', 'bienesraices_crud');
    if ($db->connect_error) {
        die('Connection failed: ' . $db->connect_error);
    }
    return $db;
}
