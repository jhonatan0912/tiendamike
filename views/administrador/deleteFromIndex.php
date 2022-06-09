<?php
require_once __DIR__ . '/../../controllers/listaIndexAdapter.php';
require_once __DIR__ . '/../../tools/httpTools.php';
require_once __DIR__ . '/../../tools/fileTools.php';
$idImagen = $_GET['id'];
if (isset($idImagen)) {
  $producto = listaIndexAdapter::obtenerUno($idImagen);
  $res = listaIndexAdapter::eliminar($idImagen);
  FileTools::borrarImagen($producto->imagenUrl, "platos");

  if ($res) {
    HttpTools::redireccionar('/views/administrador/imagenesIndex.php');
  } else {
    HttpTools::redireccionar('/views/administrador/imagenesIndex.php');
  }
}
