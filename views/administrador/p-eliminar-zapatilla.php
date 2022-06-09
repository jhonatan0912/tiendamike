<?php
require_once __DIR__ . '/../../controllers/zapatillaAdapter.php';
require_once __DIR__ . '/../../tools/httpTools.php';
require_once __DIR__ . '/../../tools/fileTools.php';

$idPlato = $_GET['idPlato'];

if (isset($idPlato)) {
  $plato = ZapatillaAdapter::obtenerUno($idPlato);
  $respuesta = ZapatillaAdapter::eliminar($idPlato);
  FileTools::borrarImagen($plato->imagenZapatilla, "platos");

  if ($respuesta === TRUE) {

    HttpTools::redireccionar('/views/administrador/p-listar-platos.php');
  } else {
    HttpTools::redireccionar('/errores/p403.php');
  }
} else {
  HttpTools::redireccionar('/errores/p403.php');
}
