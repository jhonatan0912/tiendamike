<?php
require_once __DIR__ . '/../../controllers/recoverPasswordAdapter.php';
require_once __DIR__ . '/../../controllers/clienteAdapter.php';
require_once __DIR__ . '/../../tools/httpTools.php';


$esCorrecto = FALSE;
if (
  isset($_POST['token'])
  && isset($_POST['password'])
  && isset($_POST['rePassword'])
) {
  $token = $_POST['token'];
  $password = $_POST['password'];
  $rePassword = $_POST['rePassword'];

  $correo = RecoverPasswordAdapter::validarToken($token);

  if ($correo != null && $password == $rePassword) {
    RecoverPasswordAdapter::usarToken($token);
    $res = ClienteAdapter::cambiarClave($correo, $password);
    if ($res) {
      $esCorrecto = TRUE;
      HttpTools::redireccionar('/views/plantilla/recoveryPasswordSuccesfull.html');
    } else {
      HttpTools::redireccionar('/views/plantilla/recoveryPasswordFailed.html');
    }
  }
}
