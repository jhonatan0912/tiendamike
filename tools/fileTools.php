<?php

class FileTools
{
    /**
     * Funcion para declarar el directorio donde se desea guardar los
     * archivos.
     */
    static function directorioUpload()
    {
        return $_SERVER['DOCUMENT_ROOT']
            . DIRECTORY_SEPARATOR . 'assets'
            . DIRECTORY_SEPARATOR . 'uploads'
            . DIRECTORY_SEPARATOR;
    }
    /**
     * Funcion que devuelve el path del archivo subido
     */
    static function pathUpload()
    {
        return '/assets/uploads/';
    }
    /**
     * Funcion para obtener el mimetype del archivo
     */
    static function extensionDeArchivo($nombre)
    {
        $lista = explode('.', $nombre);
        $extension = $lista[count($lista) - 1];
        return $extension;
    }
    /**
     * Funcion para subir una imagen
     */
    static function subirImagen($imagen, $tipo, $id)
    {
        $destino = FileTools::directorioUpload();
        $destino = $destino . $tipo . DIRECTORY_SEPARATOR;
        $ext = FileTools::extensionDeArchivo($imagen['name']);
        $uuid = uniqid('', true);
        $nombre = "$tipo-$id-$uuid.$ext";
        $destino = $destino . $nombre;
        $res = move_uploaded_file($imagen['tmp_name'], $destino);
        // path
        $path = FileTools::pathUpload() . "$tipo/" . $nombre;
        return $path;
    }

    static function borrarImagen($path, $tipo)
    {
        $destino = FileTools::directorioUpload();
        $destino = $destino . $tipo . DIRECTORY_SEPARATOR;
        $lista = explode('/', $path);
        $nombre = $lista[count($lista) - 1];
        $destino = $destino . $nombre; //ruta fisica del archivo
        echo $destino;
        return unlink($destino);
    }
}
