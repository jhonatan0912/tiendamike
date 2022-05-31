<?php
require_once __DIR__ . '/../../controllers/personalAdapter.php';
require_once __DIR__ . '/../../tools/httpTools.php';
if (isset($_POST['dni']) && isset($_POST['password'])) {
  $dni = $_POST['dni'];
  $password = $_POST['password'];

  $personal = new Personal(0, $dni, $password);

  $id = PersonalAdapter::registrarPersonal($personal);
  if ($id) {
    HttpTools::redireccionar('/views/administrador/index.php');
  } else {
    echo "no se pudo crear al personal";
  }
}
