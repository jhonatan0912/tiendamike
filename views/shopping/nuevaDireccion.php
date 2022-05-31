<?php
require_once __DIR__ . '/../../controllers/direccionAdapter.php';
require_once __DIR__ . '/../../tools/httpTools.php';
if (
  isset($_POST['idCliente'])
  && isset($_POST['direccion'])
) {
  $direccion = new Direccion($_POST['idCliente'], 0, $_POST['direccion']);
  $id = DireccionAdapter::crear($direccion);
  if ($id != FALSE) {
    HttpTools::redireccionar('/views/shopping/checkout.php');
  } else {
    HttpTools::redireccionar('/errores/p500.php');
  }
}
