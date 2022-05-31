<?php
require_once __DIR__ . '/../../controllers/platoAdapter.php';
require_once __DIR__ . '/../../tools/httpTools.php';
require_once __DIR__ . '/../../tools/fileTools.php';

$idPlato = $_GET['idPlato'];

if (isset($idPlato)) {
  $plato = PlatoAdapter::obtenerUno($idPlato);
  $respuesta = PlatoAdapter::eliminar($idPlato);
  FileTools::borrarImagen($plato->imagenPlato, "platos");

  if ($respuesta === TRUE) {

    HttpTools::redireccionar('/views/administrador/p-listar-platos.php');
  } else {
    HttpTools::redireccionar('/errores/p403.php');
  }
} else {
  HttpTools::redireccionar('/errores/p403.php');
}
