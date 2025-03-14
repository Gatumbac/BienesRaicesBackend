<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES URL', __DIR__ . '/funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/{$nombre}.php";
}

function autenticarAdmin(): void {
    session_start();
    $auth = $_SESSION['login'] ?? false;
    if(!$auth) {
        header('Location: /');
        exit;
    }
}

function debugear($variable) {
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}

//Escapar el html
function s($html) {
    return htmlspecialchars($html);
}

//Validar variable importante
function verificarExistencia($variable) {
    if (!$variable) {
        header('Location: /admin');
        exit;
    }
}

function verificarVariable($variable, $header) {
    if (!$variable) {
        header('Location: ' . $header);
        exit;
    }
}

function validarTipo($tipo) {
    $tipos = ['vendedor', 'propiedad'];
    $tipoValido = in_array($tipo, $tipos);
    verificarExistencia($tipoValido);
}

function getMensaje($resultado) {
    $resultados = [
        '1' => 'Registro creado correctamente',
        '2' => 'Registro actualizado correctamente',
        '3' => 'Registro eliminado correctamente'
    ];
    return $resultados[$resultado] ?? '';
}
