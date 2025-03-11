<?php
namespace App;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

class ImagenHandler {
    public static function crearDirectorio($carpetaImagenes = CARPETA_IMAGENES) {
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }
    }

    public static function getNombreAleatorio() {
        return md5( uniqid (rand(), true) ) . ".jpg";
    }

    public static function procesarImagen($file, $nombreImagen) {
        self::crearDirectorio();
        $manager = new Image(new Driver());
        $imagen = $manager->read($file["tmp_name"])->cover(800,600);
        $imagen->save(CARPETA_IMAGENES . $nombreImagen);
    }

    public static function borrarImagen($ruta) {
        if (file_exists($ruta)) {
            unlink($ruta);
        }
    }

}